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

class Cribis implements \Serializable
{

    /**
     * URL of webservice
     * 
     * @var string $urlWSDL
     */
    private $urlWSDL = 'http://datiufficiali.dnb.it/GWJV2/services/DUProductV2?WSDL';

    /**
     * Result of current search result (xmlresponse)
     * - Text format: xml
     * 
     * @var string $XMLResult
     */
    private $XMLResult;

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
     */
    public function getProductByXML()
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
                $options[] = 'getProductByXML';
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

        $result = $client->__SoapCall('getProductByXML', $this->getData());

        $this->resultToXML($result);

        $this->companyReports->setXmlResult($this->getXMLResult());

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
                'userid'         => $this->getCompanyReports()->getLogin(),
                'password'       => $this->getCompanyReports()->getPassword(),
                'applicationID'  => $this->getCompanyReports()->getCribisApplicationId(),
                'reference'      => $this->getCompanyReports()->getCribisReference(),
                'sessionID'      => '',
                'xmlParameter'   => $this->getXmlParameter(true),
                'productCode'    => $this->getCompanyReports()->getCribisProductCode(),
                'extraParameter' => '',
            );
    }

    /**
     * xml parameter to send to webservice
     * Ex.
     * <?xml version="1.0" encoding="utf-8"?>
     * <PARAMETERS>
     *      <PARAMETER>
     *          <PARAMETER_NAME>fiscalcode</PARAMETER_NAME>
     *          <PARAMETER_VALUE></PARAMETER_VALUE>
     *      </PARAMETER>
     * </PARAMETERS>
     */
    public function getXmlParameter($isString = false)
    {
        // values
        $parameterNameValue = 'fiscalcode';
        $parameterValueValue = sprintf('%s%s', $this->companyReports->getInfoCode(), $this->companyReports->getSiren());        

        $xml = new DOMDocument('1.0', 'utf-8');

        // Create root node <PARAMETERS>
        $parameters     = $xml->createElement('PARAMETERS');
        // Create node <PARAMETER>
        $parameter      = $xml->createElement('PARAMETER');
        // Create node <PARAMETER_NAME>
        $parameterName  = $xml->createElement('PARAMETER_NAME', $parameterNameValue);
        // Create node <PARAMETER_VALUE>
        $parameterValue = $xml->createElement('PARAMETER_VALUE', $parameterValueValue);

        // Append structure
        $parameter->appendChild($parameterName);
        $parameter->appendChild($parameterValue);
        $parameters->appendChild($parameter);

        $xml->appendChild($parameters);

        if ($isString) {
            return $xml->saveXML();
        }

        return $xml;
    }

    /**
     *
     * @param string $res
     * @return DOMDocument 
     */
    public function resultToXML($res)
    {
        // Filter
        if (!mb_strpos($res, '<msg><![CDATA[')) {
            $res = str_replace(array('<msg>', '</msg>'), array('<msg><![CDATA[', ']]></msg>'), $res);
        }

        $dom = new DOMDocument();
        $dom->preserveWhiteSpace = false;
        $dom->loadXML($res);
        $dom->formatOutput = true;

        // Return data
        $this->XMLResult = $dom;
    }

    /**
     *
     * @param bool $isString
     * 
     * @return DOMDocument 
     */
    public function getXMLResult($isString = true)
    {
        if ($isString) {
            return $this->XMLResult->saveXML();
        }

        return $this->XMLResult;
    }

    /**
     *
     * @return OS\CompanyReportsBundle\Webservices\Cribis
     */
    public function bindData()
    {
        $domxml = $this->getXMLResult(false);

        $dbtx = $domxml->getElementsByTagName("dbtx")->item(0);
        $transactionrs = $dbtx->getElementsByTagName("transaction_rs")->item(0);
        $response = $transactionrs->getElementsByTagName("response")->item(0);
        $result = $response->getElementsByTagName("RESULT")->item(0);
        $custprodelem = $result->getElementsByTagName("CUST_PROD")->item(0);

        $candidate = new \stdClass();
        $candidate->duns = $custprodelem->getElementsByTagName("DUNS")->item(0)->nodeValue;
        $candidate->vat = $custprodelem->getElementsByTagName("PIVA")->item(0)->nodeValue;
        $candidate->fiscalCode = $custprodelem->getElementsByTagName("CODICEFISCALE")->item(0)->nodeValue;
        $candidate->chamberOfCommerceProvince = $custprodelem->getElementsByTagName("CCIAAPROV")->item(0)->nodeValue;
        $candidate->chamberCommerceNumber = $custprodelem->getElementsByTagName("CCIAANUM")->item(0)->nodeValue;
        $candidate->name = $custprodelem->getElementsByTagName("RAGSOC")->item(0)->nodeValue;
        $candidate->headOfficeAddress = $custprodelem->getElementsByTagName("INDIRIZZO1")->item(0)->nodeValue;
        $candidate->headOfficeDistrict = $custprodelem->getElementsByTagName("INDIRIZZO2")->item(0)->nodeValue;
        $candidate->headOfficeTown = $custprodelem->getElementsByTagName("LOCALITA")->item(0)->nodeValue;
        $candidate->headOfficePostCode = $custprodelem->getElementsByTagName("CAP")->item(0)->nodeValue;
        $candidate->province = $custprodelem->getElementsByTagName("PROV")->item(0)->nodeValue;
        $candidate->phoneNumber = $custprodelem->getElementsByTagName("TELEFONO")->item(0)->nodeValue;
        $candidate->legalForm = $custprodelem->getElementsByTagName("FORMAGIURIDICA")->item(0)->nodeValue;
        $candidate->tradeStyle = $custprodelem->getElementsByTagName("TRADESTYLE")->item(0)->nodeValue;
        $candidate->registeredOfficeAddress = $custprodelem->getElementsByTagName("LAINDIRIZZO")->item(0)->nodeValue;
        $candidate->registeredOfficeTown = $custprodelem->getElementsByTagName("LALOCALITA")->item(0)->nodeValue;
        $candidate->registeredOfficePostCode = $custprodelem->getElementsByTagName("LACAP")->item(0)->nodeValue;

        $this->companyReports->setReportName($candidate->name);
        $this->companyReports->setReportId($candidate->fiscalCode);
        $this->companyReports->setSiret($candidate->fiscalCode);
        $this->companyReports->setLegalStatus($candidate->legalForm);
        $this->companyReports->setAddress($candidate->headOfficeAddress);
        $this->companyReports->setAdditionToAddress($candidate->headOfficeDistrict);
        $this->companyReports->setPhone($candidate->phoneNumber);
        $this->companyReports->setDistributionLine($candidate->headOfficePostCode . ' ' . $candidate->headOfficeTown);
        
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
        return serialize($this->getXMLResult());
    }

    /**
     * 
     */
    public function unserialize($data)
    {
        $this->XMLResult = unserialize($data);
    }

    /**
     * 
     */
    public function cacheCompanyInfos()
    {
        file_put_contents($this->companyReports->getCacheFile(), $this->getXMLResult(true));
    }

    /**
     * 
     */
    public function getCachedCompanyInfos()
    {   
        $this->resultToXML(file_get_contents($this->companyReports->getCacheFile()));
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
