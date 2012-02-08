<?php

namespace OS\CompanyReportsBundle\Webservices;

/**
 * This class get companies informations
 *
 * @author abdou
 */
use SoapClient,
    DOMDocument,
    SimpleXMLElement,
    OS\CompanyReportsBundle\CompanyReports;

class Europa implements \Serializable
{

    /**
     * URL of webservice
     * 
     * @var string $urlWSDL
     */
    private $urlWSDL = "http://ec.europa.eu/taxation_customs/vies/services/checkVatService?wsdl";

    /**
     * Result of current search result
     * 
     * @var string $result
     */
    private $result;

    /**
     * Entity company reports
     * 
     * @var CompanyReports $companyReports
     */
    private $companyReports;

    /**
     * Constructor
     * @param CompanyReports $companyReports 
     */
    public function __construct(CompanyReports $companyReports)
    {
        $this->companyReports = $companyReports;
    }

    /**
     *
     * @param string $options 
     */
    public function checkVatApprox()
    {
        $this->callWS();
    }

    /**
     *
     * @param array $options 
     */
    public function execute($options = array())
    {
        if ($this->isCachedCompanyInfos()) {
            $this->getCachedCompanyInfos();
        } else {
            if (empty($options)) {
                $options[] = 'checkVatApprox';
            }

            foreach ($options as $option) {
                $this->{$option}();
            }

            if ($this->companyReports->getCacheFile()) {
                $this->cacheCompanyInfos();
            }
        }

        $this->bindData();
    }

    /**
     * 
     */
    public function callWS()
    {
        $client = new SoapClient($this->getUrlWSDL());

        try {
        $this->result = $client->__SoapCall('checkVatApprox', array($this->getData()));
        } catch (SoapFault $sf) {
            
        }

        $this->companyReports->setResult($this->result);

        return $this;
    }

    /**
     *
     * @return type 
     */
    public function getUrlWSDL()
    {
        return $this->urlWSDL;
    }

    /**
     *
     * @return type 
     */
    public function getData()
    {
        return array(
            'countryCode'          => $this->companyReports->getCountryCode(),
            'vatNumber'            => sprintf('%s%s', $this->companyReports->getInfoCode(), $this->companyReports->getSiren()),
            'requesterCountryCode' => '',
            'requesterVatNumber'   => '',
        );
    }

    /**
     *
     * @return OS\CompanyReportsBundle\Webservices\Europa
     */
    public function bindData()
    {
        if (!$this->result->valid) {
            return $this;
        }

        $name = explode(' ', $this->result->traderName, 2);
        $traderAddress = preg_split ('/$\R?^/m', $this->result->traderAddress);

        $address = count($traderAddress) > 2 ? sprintf('%s %s', $traderAddress[0], $traderAddress[1]) : $traderAddress[0];
        $additionalAddress = end($traderAddress);

        $this->companyReports->setReportName($name[1]);
        $this->companyReports->setLegalStatus($name[0]);
        $this->companyReports->setAddress($address);
        $this->companyReports->setAdditionToAddress($additionalAddress);

        return $this;
    }

    /**
     *
     * @return type 
     */
    public function getCompanyReports()
    {
        return $this->companyReports;
    }

    /**
     *
     * @param type $companyReports 
     */
    public function setCompanyReports($companyReports)
    {
        $this->companyReports = $companyReports;
    }

    /**
     *
     * @return type 
     */
    public function serialize()
    {
        return serialize($this->result);
    }

    /**
     * 
     */
    public function unserialize($data)
    {
        $this->result = unserialize($data);
    }

    /**
     * 
     */
    public function cacheCompanyInfos()
    {
        file_put_contents($this->companyReports->getCacheFile(), serialize($this->result));
    }

    /**
     * 
     */
    public function getCachedCompanyInfos()
    {
        $this->result = unserialize(file_get_contents($this->companyReports->getCacheFile()));

        $this->companyReports->setResult($this->result);
    }

    /**
     *
     * @return type 
     */
    public function isCachedCompanyInfos()
    {
        return file_exists($this->companyReports->getCacheFile());
    }

}

?>
