<?php

namespace OS\CompanyReportsBundle\Webservices;

/**
 * This class get companies informations
 *
 * @author abdou
 */
use SoapClient,
    DOMDocument,
    OS\CompanyReportsBundle\CompanyReports;

class CreditSafe implements \Serializable
{

    private $urlWSDL = "https://www.creditsafe.fr/getdata/service/CSFRServices.asmx?WSDL";
    private $XMLResult;
    private $XMLSchema;
    private $companyReports;

    public function __construct(CompanyReports $companyReports)
    {
        $this->companyReports = $companyReports;
    }

    public function getDirectorInformation()
    {
        
    }

    public function directorSearch()
    {
        
    }

    public function companySearch()
    {
        $xml = $this->getSearchCompanyXMLSchema();

        $this->setXMLSchema($xml)
                ->callWS()
                ->bindData();
    }

    public function getCompanyInformation()
    {
        $xml = $this->getCompanyInformationXMLSchema();

        $this->setXMLSchema($xml)
                ->callWS()
                ->bindData();
    }

    public function execute($options = array())
    {
        if (empty($options))
            $options[] = 'getcompanyinformation';

        foreach ($options as $option)
            $this->{$option}();
    }

    public function callWS()
    {
        $client = new SoapClient($this->getUrlWSDL());

        $result = $client->__SoapCall('GetData', array($this->getData()));

        $this->XMLResult = $result->GetDataResult;

        return $this;
    }

    public function getUrlWSDL()
    {
        return $this->urlWSDL;
    }

    public function getData()
    {
        return array('requestXmlStr' => $this->getXMLSchema());
    }

    public function setXMLSchema($XMLSchema)
    {
        $this->XMLSchema = $XMLSchema;

        return $this;
    }

    public function getXMLSchema()
    {
        return $this->XMLSchema;
    }

    public function getSearchCompanyXMLSchema()
    {
        $xml = $this->getDefaultXMLSchema();

        $domXML = new DOMDocument();
        $domXML->loadXML($xml);

        $domXML->getElementsByTagName('operation')->item(0)->appendChild($domXML->createTextNode('companysearch'));
        $domXML->getElementsByTagName('package')->item(0)->appendChild($domXML->createTextNode('standard'));

        return $domXML->saveXML();
    }

    public function getCompanyInformationXMLSchema()
    {
        $xml = $this->getDefaultXMLSchema();

        $domXML = new DOMDocument();
        $domXML->loadXML($xml);

        $domXML->getElementsByTagName('operation')->item(0)->appendChild($domXML->createTextNode('getcompanyinformation'));
        $domXML->getElementsByTagName('package')->item(0)->appendChild($domXML->createTextNode('standard'));

        return $domXML->saveXML();
    }

    public function getDefaultXMLSchema()
    {
        $domXML = new DOMDocument();
        $elemXMLRequest = $domXML->createElement('xmlrequest');

        $elemHeader = $domXML->createElement('header');

        $elemUsername = $domXML->createElement('username', $this->getCompanyReports()->getLogin());
        $elemPassword = $domXML->createElement('password', $this->getCompanyReports()->getPassword());
        $elemOperation = $domXML->createElement('operation', '');
        $elemLanguage = $domXML->createElement('language', 'FR');
        $elemCountry = $domXML->createElement('country', 'FR');
        $elemChargereference = $domXML->createElement('chargereference');

        $elemHeader->appendChild($elemUsername);
        $elemHeader->appendChild($elemPassword);
        $elemHeader->appendChild($elemOperation);
        $elemHeader->appendChild($elemLanguage);
        $elemHeader->appendChild($elemCountry);
        $elemHeader->appendChild($elemChargereference);

        $elemBody = $domXML->createElement('body');

        $elemPackage = $domXML->createElement('package', '');
        $elemCompanyname = $domXML->createElement('companynumber', $this->getCompanyReports()->getSiren());
        $elemStartPosition = $domXML->createElement('startposition', '1');
        $elemPageSize = $domXML->createElement('pagesize', '25');

        $elemBody->appendChild($elemPackage);
        $elemBody->appendChild($elemCompanyname);
        $elemBody->appendChild($elemStartPosition);
        $elemBody->appendChild($elemPageSize);

        $elemXMLRequest->appendChild($elemHeader);
        $elemXMLRequest->appendChild($elemBody);

        return $domXML->saveXML($elemXMLRequest);
    }

    public function getXMLResult($returnString = true)
    {
        if ($returnString)
            return $this->XMLResult;

        $domXML = new DOMDocument();
        $domXML->loadXML($this->XMLResult);

        return $domXML;
    }

    public function bindData()
    {
        $domXML = $this->getXMLResult(false);

        $mapper = array(
            'CompanyName' => 'name',
            'ActivityCode' => 'activitycode',
            'ActivityDescription' => 'activitydescription',
            'LegalStatus' => 'legalform',
            'RcsNumber' => 'courtregistrynumber',
            'RcsDescription' => 'courtregistrydescription',
            'Phone' => 'telephone',
            'Fax' => 'fax',
            'ShareCapital' => 'sharecapital',
            'Name' => 'name',
            'AdditionToName' => 'additiontoname',
            'Address' => 'address',
            'additionToAddress' => 'additiontoaddress',
            'SpecialDistribution' => 'specialdistribution',
            'DistributionLine' => 'distributionline',
            'RegistrationDate' => 'incorporationdate',
            'Nationality' => 'nationality',
            'Status' => 'status'
        );

        foreach ($mapper as $method => $attr)
            $this->companyReports->{'set' . $method}($domXML->getElementsByTagName($attr)->item(0)->nodeValue);

        return $this;
    }

    public function getCompanyReports()
    {
        return $this->companyReports;
    }

    public function setCompanyReports($companyReports)
    {
        $this->companyReports = $companyReports;
    }

    public function serialize()
    {
        return serialize($this->getXMLResult());
    }

    public function unserialize($data)
    {
        $this->XMLResult = unserialize($data);
    }

}

?>
