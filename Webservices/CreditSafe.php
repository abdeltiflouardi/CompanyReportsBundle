<?php

namespace OS\CompanyReportsBundle\Webservices;

/**
 * This class get companies informations
 *
 * @author abdou
 */
use OS\CompanyReportsBundle\CompanyReports;

class CreditSafe implements \Serializable
{

    /**
     * URL of webservice
     * 
     * @var string $urlWSDL
     */
    private $urlWSDL = "https://www.creditsafe.fr/getdata/service/CSFRServices.asmx?WSDL";

    /**
     * Result of current search result (xmlresponse)
     * - Text format: xml
     * 
     * @var string $XMLResult
     */
    private $XMLResult;

    /**
     * Schema of current search (xmlrequest)
     * - Text format: xml
     * 
     * @var string $XMLSchema
     */
    private $XMLSchema;

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
    public function getDirectorInformation()
    {
        
    }

    /**
     * 
     */
    public function directorSearch()
    {
        $xml = $this->getDirectorSearchXMLSchema();

        $this->setXMLSchema($xml)
                ->callWS();
    }

    /**
     * 
     */
    public function companySearch()
    {
        $xml = $this->getSearchCompanyXMLSchema();

        $this->setXMLSchema($xml)
                ->callWS();
    }

    /**
     * 
     */
    public function getCompanyInformation()
    {
        $xml = $this->getCompanyInformationXMLSchema();

        $this->setXMLSchema($xml)
                ->callWS();
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
            if (empty($options))
                $options[] = 'getcompanyinformation';

            foreach ($options as $option)
                $this->{$option}();

            if ($this->companyReports->getCacheFile())
                $this->cacheCompanyInfos();
        }

        $this->bindData();
    }

    /**
     * 
     */
    public function callWS()
    {
        $client = new \SoapClient($this->getUrlWSDL());

        $result = $client->__SoapCall('GetData', array($this->getData()));

        $this->XMLResult = $result->GetDataResult;

        $this->companyReports->setXmlResult($this->XMLResult);

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
        return array('requestXmlStr' => $this->getXMLSchema());
    }

    /**
     *
     * @param type $XMLSchema
     * @return \OS\CompanyReportsBundle\Webservices\CreditSafe 
     */
    public function setXMLSchema($XMLSchema)
    {
        $this->XMLSchema = $XMLSchema;

        return $this;
    }

    /**
     *
     * @return type 
     */
    public function getXMLSchema()
    {
        return $this->XMLSchema;
    }

    /**
     * 
     */
    public function getDirectorSearchXMLSchema()
    {
        $xml = $this->getDefaultXMLSchema();

        $domXML = new \DOMDocument();
        $domXML->loadXML($xml);

        $domXML->getElementsByTagName('operation')->item(0)->appendChild($domXML->createTextNode('directorsearch'));
        $domXML->getElementsByTagName('package')->item(0)->appendChild($domXML->createTextNode('standard'));

        $element       = $domXML->getElementsByTagName('companynumber')->item(0);
        $parentElement = $element->parentNode;

        $parentElement->removeChild($element);

        $elemCompanyname = $domXML->createElement('name', $this->getCompanyReports()->getDirectorName());
        $parentElement->appendChild($elemCompanyname);

        if ($this->getCompanyReports()->getChristianName()) {
            $elemCompanyname = $domXML->createElement('christian_name', $this->getCompanyReports()->getChristianName());
            $parentElement->appendChild($elemCompanyname);
        }

        $elemCompanyname = $domXML->createElement('namesearchmode', 'contain');
        $parentElement->appendChild($elemCompanyname);

        return $domXML->saveXML();
    }

    /**
     * 
     */
    public function getSearchCompanyXMLSchema()
    {
        $xml = $this->getDefaultXMLSchema();

        $domXML = new \DOMDocument();
        $domXML->loadXML($xml);

        $domXML->getElementsByTagName('operation')->item(0)->appendChild($domXML->createTextNode('companysearch'));
        $domXML->getElementsByTagName('package')->item(0)->appendChild($domXML->createTextNode('standard'));

        return $domXML->saveXML();
    }

    /**
     *
     * @return type 
     */
    public function getCompanyInformationXMLSchema()
    {
        $xml = $this->getDefaultXMLSchema();

        $domXML = new \DOMDocument();
        $domXML->loadXML($xml);

        $domXML->getElementsByTagName('operation')->item(0)->appendChild($domXML->createTextNode('getcompanyinformation'));
        $domXML->getElementsByTagName('package')->item(0)->appendChild($domXML->createTextNode('standard'));

        return $domXML->saveXML();
    }

    /**
     *
     * @return type 
     */
    public function getDefaultXMLSchema()
    {
        $domXML         = new \DOMDocument();
        $elemXMLRequest = $domXML->createElement('xmlrequest');

        $elemHeader = $domXML->createElement('header');

        $elemUsername        = $domXML->createElement('username', $this->getCompanyReports()->getLogin());
        $elemPassword        = $domXML->createElement('password', $this->getCompanyReports()->getPassword());
        $elemOperation       = $domXML->createElement('operation', '');
        $elemLanguage        = $domXML->createElement('language', 'FR');
        $elemCountry         = $domXML->createElement('country', 'FR');
        $elemChargereference = $domXML->createElement('chargereference');

        $elemHeader->appendChild($elemUsername);
        $elemHeader->appendChild($elemPassword);
        $elemHeader->appendChild($elemOperation);
        $elemHeader->appendChild($elemLanguage);
        $elemHeader->appendChild($elemCountry);
        $elemHeader->appendChild($elemChargereference);

        $elemBody = $domXML->createElement('body');

        $elemPackage       = $domXML->createElement('package', '');
        $elemCompanyname   = $domXML->createElement('companynumber', $this->getCompanyReports()->getSiren());
        $elemStartPosition = $domXML->createElement('startposition', '1');
        $elemPageSize      = $domXML->createElement('pagesize', '25');

        $elemBody->appendChild($elemPackage);
        $elemBody->appendChild($elemCompanyname);
        $elemBody->appendChild($elemStartPosition);
        $elemBody->appendChild($elemPageSize);

        $elemXMLRequest->appendChild($elemHeader);
        $elemXMLRequest->appendChild($elemBody);

        return $domXML->saveXML($elemXMLRequest);
    }

    /**
     *
     * @param type $returnString
     * @return DOMDocument 
     */
    public function getXMLResult($returnString = true)
    {
        if ($returnString)
            return $this->XMLResult;

        $domXML = new \DOMDocument();
        $domXML->loadXML($this->XMLResult);

        return $domXML;
    }

    /**
     *
     * @return OS\CompanyReportsBundle\Webservices\CreditSafe 
     */
    public function bindData()
    {
        $domXML = $this->getXMLResult(false);

        if ($domXML->getElementsByTagName('errors')->length > 0)
            return;

        $mapper = array(
            'ReportId'              => 'reportid',
            'ReportName'            => 'reportname',
            'CompanyName'           => 'name',
            'ActivityCode'          => 'activitycode',
            'ActivityDescription'   => 'activitydescription',
            'LegalStatus'           => 'legalform',
            'RegistrationCourt'     => 'registrationcourt',
            'RcsNumber'             => 'courtregistrynumber',
            'RcsDescription'        => 'courtregistrydescription',
            'Phone'                 => 'telephone',
            'Fax'                   => 'fax',
            'ShareCapital'          => 'sharecapital',
            'Name'                  => 'name',
            'AdditionToName'        => 'additiontoname',
            'Address'               => 'address',
            'additionToAddress'     => 'additiontoaddress',
            'SpecialDistribution'   => 'specialdistribution',
            'DistributionLine'      => 'distributionline',
            'TradingAddress'        => 'tradingaddress',
            'RegistrationDate'      => 'incorporationdate',
            'ProfessionalText'      => 'professionaltext',
            'CreationDate'          => 'formationdate',
            'ReasonForFormation'    => 'reasonforformation',
            'ClosureDate'           => 'closuredate',
            'ReasonForClosure'      => 'reasonforclosure',
            'DeregistrationDate'    => 'deregistrationdate',
            'LastAccountDate'       => 'lastaccountdate',
            'ReactivationDate'      => 'reactivationdate',
            'ProductionRole'        => 'productionrole',
            'Nationality'           => 'nationality',
            'Status'                => 'status',
            'Rating'                => 'rating',
            'CreditLimit'           => 'creditlimit',
            'VatNumber'             => 'vatnumber',
            'Type'                  => 'type',
            'Nature'                => 'nature',
            'ActivityLocation'      => 'activitylocation',
            'LocationSurface'       => 'locationsurface',
            'Seasonality'           => 'seasonality',
            'DepartmentDescription' => 'departmentdescription',
            'Department'            => 'department',
            'Region'                => 'region',
            'District'              => 'district',
            'Area'                  => 'area',
            'Municipality'          => 'municipality',
            'SizeOfUrbanArea'       => 'sizeofurbanarea',
            'NumberOfBranches'      => 'numberofbranches',
            'MonoActivityStatus'    => 'monoactivitystatus',
            'Regionality'           => 'regionality',
            'NumberOfCompanies'     => 'numberofcompanies',
        );

        foreach ($mapper as $method => $attr)
            if ($domXML->getElementsByTagName($attr)->length)
                $this->companyReports->{'set' . $method}($domXML->getElementsByTagName($attr)->item(0)->nodeValue);

        // Return trading to date of the last 3 months
        $i       = 0;
        $tarding = array();
        foreach ($domXML->getElementsByTagName('tradingtodate') as $parent) {
            foreach ($parent->childNodes as $child) {
                if ($child->nodeName{0} == '#')
                    continue;

                $tarding[$i][$child->nodeName] = $child->nodeValue;
            }
            $i++;
        }
        $this->companyReports->setTradingToDate($tarding);

        // courtregistrynumber
        if ($domXML->getElementsByTagName('courtregistrynumber')->item(1))
            $this->companyReports->setRcNumber($domXML->getElementsByTagName('courtregistrynumber')->item(1)->nodeValue);

        // Branches
        $i        = 0;
        $branches = array();
        foreach ($domXML->getElementsByTagName('branch') as $parent) {
            foreach ($parent->childNodes as $child) {
                if ($child->nodeName{0} == '#')
                    continue;

                $branches[$i][$child->nodeName] = $child->nodeValue;
            }
            $i++;
        }
        $this->companyReports->setBranches($branches);

        // Bilan actif/passif/results
        $balanceSheets = array();
        $sx = new \SimpleXMLElement($domXML->saveXML());

        // Balancesheet
        if ($sx->body->company->balancesynthesis)
            foreach ($sx->body->company->balancesynthesis->balancesheet as $balancesheet) {
                $balanceSheets[] = $this->nodeToArray($balancesheet);
            }
        $this->companyReports->setBalanceSheets($balanceSheets);

        // Previous rating
        $previousRatings = array();
        if ($sx->body->company->ratings)
            foreach ($sx->body->company->ratings->previousratings->previousrating as $previousrating) {
                $previousRatings[] = $this->nodeToArray($previousrating);
            }
        $this->companyReports->setPreviousRatings($previousRatings);

        // Judgement
        $judgements = array();
        if ($sx->body->company->judgements)
            foreach ($sx->body->company->judgements->judgement as $judgement) {
                $judgements[] = $this->nodeToArray($judgement);
            }
        $this->companyReports->setJudgements($judgements);

        // Directors
        $leaderships = array();
        if ($sx->body->company->directors)
            foreach ($sx->body->company->directors->director as $director) {
                $leaderships[] = $this->nodeToArray($director);
            }
        $this->companyReports->setLeaderships($leaderships);

        // Publications
        $publications = array();
        if ($sx->body->company->eventhistory)
            foreach ($sx->body->company->eventhistory->gazette->publication as $publication) {
                $publications[] = $this->nodeToArray($publication);
            }
        $this->companyReports->setPublications($publications);

        // companyEvents 
        $companyEvents = array();
        if ($sx->body->company->eventhistory)
            foreach ($sx->body->company->eventhistory->companyhistory->company as $companyEvent) {
                $companyEvents[] = $this->nodeToArray($companyEvent);
            }
        $this->companyReports->setCompanyEvents($companyEvents);

        // establishmentEvents 
        $establishmentEvents = array();
        if ($sx->body->company->eventhistory)
            foreach ($sx->body->company->eventhistory->establishmenthistory->establishment as $establishmentEvent) {
                $establishmentEvents[] = $this->nodeToArray($establishmentEvent);
            }
        $this->companyReports->setEstablishmentEvents($establishmentEvents);

        // Ultimate parents
        $ultimateParents = array();
        if ($sx->body->company->groupstructure)
            foreach ($sx->body->company->groupstructure->ultimateparents->ultimateparent as $ultimateParent) {
                $ultimateParents[] = $this->nodeToArray($ultimateParent);
            }
        $this->companyReports->setUltimateParents($ultimateParents);

        // Direct parent company name
        $rcsNumber = $this->companyReports->getRcsNumber();
        $childs    = $domXML->getElementsByTagName('child');
        foreach ($childs as $child) {
            $number = $child->getElementsByTagName('companynumber')->item(0)->nodeValue;

            if ($rcsNumber == $number) {
                if ($child->parentNode)
                    if ($child->parentNode->parentNode)
                        if ($child->parentNode->parentNode->getElementsByTagName('name')->item(0)->nodeValue)
                            if ($child->parentNode->parentNode->getElementsByTagName('name')->length)
                                $this->companyReports->setParentCompanyName($child->parentNode->parentNode->getElementsByTagName('name')->item(0)->nodeValue);
            }
        }

        // Ultimate parents
        $results = array();
        if ($sx->body->results)
            foreach ($sx->body->results->result as $result) {
                $results[] = $this->nodeToArrayV2($result);
            }
        $this->companyReports->setResult($results);

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
        $this->XMLResult = file_get_contents($this->companyReports->getCacheFile());
    }

    /**
     *
     * @return type 
     */
    public function isCachedCompanyInfos()
    {
        return file_exists($this->companyReports->getCacheFile());
    }

    /**
     *
     * @param type $node
     * @return type 
     */
    function nodeToArray($node)
    {
        $array = array();
        foreach ($node->children() as $child) {
            if (!$child->children())
                $array[$child->getName()]   = $child;
            else
                $array[$child->getName()][] = $this->nodeToArray($child);
        }
        return $array;
    }

    /**
     *
     * @param type $node
     * @return type 
     */
    function nodeToArrayV2($node)
    {
        $array = array();
        foreach ($node->children() as $child) {
            if ($child[0])
                $array[$child->getName()]   = (string) $child[0];
            else
                $array[$child->getName()][] = $this->nodeToArrayV2($child);
        }
        return $array;
    }

}

?>
