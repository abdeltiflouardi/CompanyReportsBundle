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
        $xml = $this->getDefaultXMLSchema();
        $this->setXMLSchema($xml);

        return $this->execute()->getXMLResult(false);
    }

    public function getcompanyInformation()
    {
        
    }

    public function execute()
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
    }

    public function getXMLSchema()
    {
        return $this->XMLSchema;
    }

    public function getDefaultXMLSchema()
    {
        $domXML = new DOMDocument();
        $elemXMLRequest = $domXML->createElement('xmlrequest');

        $elemHeader = $domXML->createElement('header');

        $elemUsername = $domXML->createElement('username', $this->getCompanyReports()->getLogin());
        $elemPassword = $domXML->createElement('password', $this->getCompanyReports()->getPassword());
        $elemOperation = $domXML->createElement('operation', 'companysearch');
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

        $elemPackage = $domXML->createElement('package', 'standard');
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
