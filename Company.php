<?php

namespace OS\CompanyReportsBundle;

/**
 * This class return all data that you need of an company
 *
 * @author abdou
 */
class Company
{

    /**
     * reportId
     * 
     * @var string $reportId;
     */
    private $reportId;

    /**
     * reportName
     * 
     * @var string $reportName;
     */
    private $reportName;

    /**
     * CompanyName
     * 
     * @var string $companyName;
     */
    private $companyName;

    /**
     * ActivityCode (NAF / APE)
     * 
     * @var string $activityCode
     */
    private $activityCode;

    /**
     * Activity description
     * 
     * @var string $activityDescription
     */
    private $activityDescription;

    /**
     * legal status (SARL, SA ...)
     *  
     * @var string legalStatus
     */
    private $legalStatus;

    /**
     * @var string $registrationCourt
     */
    private $registrationCourt;

    /**
     * court registry number
     * 
     * @var type 
     */
    private $rcsNumber;

    /**
     * court registry description
     * 
     * @var string $rcsDescription
     */
    private $rcsDescription;

    /**
     *
     * @var string $rcNumber
     */
    private $rcNumber;

    /**
     *
     * @var string $vatNumber
     */
    private $vatNumber;

    /**
     *
     * @var type 
     */
    private $phone;

    /**
     *
     * @var type 
     */
    private $fax;

    /**
     *
     * @var string $type 
     */
    private $type;

    /**
     * share capital
     * @var string $shareCapital
     */
    private $shareCapital;

    /**
     * Tva of company
     * 
     * @var string $tva 
     */
    private $tva;

    /**
     * @var string $countryCode (fr, es, it...)
     */
    private $countryCode;

    /**
     * The number informatique of tva
     *
     * @var integer $infoCode
     */
    private $infoCode;

    /**
     * Siren of company
     * 
     * @var integer $siren
     */
    private $siren;

    /**
     * Siret of comapny
     * 
     * @var integer $siret
     */
    private $siret;

    /**
     *
     * @var integer $nic; 
     */
    private $nic;

    /**
     *
     * @var string $registrationDate
     */
    private $registrationDate;

    /**
     *
     * @var string $creationDate
     */
    private $creationDate;

    /**
     *
     * @var string $reasonForFormation
     */
    private $reasonForFormation;

    /**
     *
     * @var string $reasonForClosure
     */
    private $reasonForClosure;

    /**
     *
     * @var string $closureDate
     */
    private $closureDate;

    /**
     * @var string $deregistrationDate
     */
    private $deregistrationDate;

    /**
     *
     * @var string $lastAccountDate
     */
    private $lastAccountDate;

    /**
     *
     * @var string $reactivationDate
     */
    private $reactivationDate;

    /**
     *
     * @var string $productionRole
     */
    private $productionRole;

    /**
     *
     * @var type $nature
     */
    private $nature;

    /**
     *
     * @var string $activityLocation
     */
    private $activityLocation;

    /**
     *
     * @var string $locationSurface
     */
    private $locationSurface;

    /**
     *
     * @var string $seasonality
     */
    private $seasonality;

    /**
     *
     * @var string $professionalText
     */
    private $professionalText;

    /**
     *
     * @var string $name
     */
    private $name;

    /**
     *
     * @var string $additionToName
     */
    private $additionToName;

    /**
     *
     * @var string $address
     */
    private $address;

    /**
     *
     * @var string $additionToAddress
     */
    private $additionToAddress;

    /**
     *
     * @var string $specialDistribution
     */
    private $specialDistribution;

    /**
     *
     * @var string $distributionLine
     */
    private $distributionLine;

    /**
     * @var array tradingAddress
     */
    private $tradingAddress = array();

    /**
     *
     * @var string $nationality
     */
    private $nationality;

    /**
     *
     * @var string $status
     */
    private $status;

    /**
     *
     * @var string $rating
     */
    private $rating;

    /**
     *
     * @var string $creditLimit
     */
    private $creditLimit;

    /**
     *
     * @var array $tradingToDate
     */
    private $tradingToDate = array();

    /**
     *
     * @var string $departmentDescription
     */
    private $departmentDescription;

    /**
     *
     * @var string $department
     */
    private $department;

    /**
     *
     * @var string $region
     */
    private $region;

    /**
     *
     * @var string district
     */
    private $district;

    /**
     *
     * @var string $area
     */
    private $area;

    /**
     *
     * @var string $municipality
     */
    private $municipality;

    /**
     *
     * @var string $sizeOfUrbanArea
     */
    private $sizeOfUrbanArea;

    /**
     *
     * @var array $branches
     */
    private $branches;

    /**
     *
     * @var int $numberOfBranches
     */
    private $numberOfBranches;

    /**
     *
     * @var type $regionality
     */
    private $regionality;

    /**
     *
     * @var type $monoActivityStatus
     */
    private $monoActivityStatus;

    /**
     *
     * @var array $balanceSheets
     */
    private $balanceSheets;

    /**
     *
     * @var array $previousRatings
     */
    private $previousRatings;

    /**
     *
     * @var array $judgement
     */
    private $judgements;

    /**
     *
     * @var array $leaderships
     */
    private $leaderships;

    /**
     *
     * @var array $publications
     */
    private $publications;

    /**
     *
     * @var array $companyEvents
     */
    private $companyEvents;

    /**
     *
     * @var array $establishmentEvents
     */
    private $establishmentEvents;

    /**
     *
     * @var array $ultimateParents
     */
    private $ultimateParents;

    /**
     *
     * @var integer $numberOfCompanies
     */
    private $numberOfCompanies;

    /**
     *
     * @var string $parentCompanyName
     */
    private $parentCompanyName;

    /**
     *
     * @var string $directorName
     */
    private $directorName;
    
    /**
     *
     * @var string $christianName
     */
    private $christianName;

    /**
     *
     * @return string 
     */
    public function getReportId()
    {
        return $this->reportId;
    }

    /**
     *
     * @param string $reportId 
     */
    public function setReportId($reportId)
    {
        $this->reportId = $reportId;

        return $this;
    }

    /**
     *
     * @return string 
     */
    public function getReportName()
    {
        return $this->reportName;
    }

    /**
     *
     * @param string $reportName 
     */
    public function setReportName($reportName)
    {
        $this->reportName = $reportName;

        return $this;
    }

    /**
     *
     * @return string $compnayName
     */
    public function getCompanyName()
    {
        return $this->companyName;
    }

    /**
     * @param string $companyName
     */
    public function setCompanyName($companyName)
    {
        $this->companyName = $companyName;

        return $this;
    }

    /**
     *
     * @return string 
     */
    public function getActivityCode()
    {
        return $this->activityCode;
    }

    /**
     *
     * @return type 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     *
     * @param type $name 
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     *
     * @return type 
     */
    public function getAdditionToName()
    {
        return $this->additionToName;
    }

    /**
     *
     * @param type $additionToName 
     */
    public function setAdditionToName($additionToName)
    {
        $this->additionToName = $additionToName;

        return $this;
    }

    /**
     *
     * @return type 
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     *
     * @param type $address 
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     *
     * @return type 
     */
    public function getAdditionToAddress()
    {
        return $this->additionToAddress;
    }

    /**
     *
     * @param type $additionToAddress 
     */
    public function setAdditionToAddress($additionToAddress)
    {
        $this->additionToAddress = $additionToAddress;

        return $this;
    }

    /**
     *
     * @return type 
     */
    public function getSpecialDistribution()
    {
        return $this->specialDistribution;
    }

    /**
     *
     * @param type $specialDistribution 
     */
    public function setSpecialDistribution($specialDistribution)
    {
        $this->specialDistribution = $specialDistribution;

        return $this;
    }

    /**
     *
     * @return type 
     */
    public function getDistributionLine()
    {
        return $this->distributionLine;
    }

    /**
     *
     * @param type $distributionLine 
     */
    public function setDistributionLine($distributionLine)
    {
        $this->distributionLine = $distributionLine;

        return $this;
    }

    /**
     *
     * @return string $tradingAddress
     */
    public function getTradingAddress()
    {
        return $this->tradingAddress;
    }

    /**
     *
     * @param string $tradingAddress 
     */
    public function setTradingAddress($tradingAddress)
    {
        $this->tradingAddress = $tradingAddress;

        return $this;
    }

    /**
     *
     * @param string $activityCode 
     */
    public function setActivityCode($activityCode)
    {
        $this->activityCode = $activityCode;

        return $this;
    }

    /**
     *
     * @return string 
     */
    public function getActivityDescription()
    {
        return $this->activityDescription;
    }

    /**
     *
     * @param string $activityDescription 
     */
    public function setActivityDescription($activityDescription)
    {
        $this->activityDescription = $activityDescription;

        return $this;
    }

    /**
     *
     * @return string 
     */
    public function getLegalStatus()
    {
        return $this->legalStatus;
    }

    /**
     *
     * @param string $legalStatus 
     */
    public function setLegalStatus($legalStatus)
    {
        $this->legalStatus = $legalStatus;

        return $this;
    }

    /**
     *
     * @return string 
     */
    public function getRegistrationCourt()
    {
        return $this->registrationCourt;
    }

    /**
     *
     * @param string $registrationCourt 
     */
    public function setRegistrationCourt($registrationCourt)
    {
        $this->registrationCourt = $registrationCourt;

        return $this;
    }

    /**
     *
     * @return string 
     */
    public function getRcsNumber()
    {
        return $this->rcsNumber;
    }

    /**
     *
     * @param string $RcsNumber 
     */
    public function setRcsNumber($rcsNumber)
    {
        $this->rcsNumber = $rcsNumber;

        return $this;
    }

    /**
     *
     * @return string 
     */
    public function getRcsDescription()
    {
        return $this->rcsDescription;
    }

    /**
     *
     * @param string $rcsDescription 
     */
    public function setRcsDescription($rcsDescription)
    {
        $this->rcsDescription = $rcsDescription;

        return $this;
    }

    /**
     *
     * @return string 
     */
    public function getRcNumber()
    {
        return $this->rcNumber;
    }

    /**
     *
     * @param string $rcNumber 
     */
    public function setRcNumber($rcNumber)
    {
        $this->rcNumber = $rcNumber;

        return $this;
    }

    /**
     *
     * @return string $vatNumber
     */
    public function getVatNumber()
    {
        return $this->vatNumber;
    }

    /**
     *
     * @param string $vatNumber 
     */
    public function setVatNumber($vatNumber)
    {
        $this->vatNumber = $vatNumber;

        return $this;
    }

    /**
     *
     * @return string 
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     *
     * @param string $phone 
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     *
     * @return type 
     */
    public function getFax()
    {
        return $this->fax;
    }

    /**
     * 
     */
    public function setFax($fax)
    {
        $this->fax = $fax;

        return $this;
    }

    /**
     *
     * @return string $shareCapital
     */
    public function getShareCapital()
    {
        return $this->shareCapital;
    }

    /**
     *
     * @param string $shareCapital 
     */
    public function setShareCapital($shareCapital)
    {
        $this->shareCapital = $shareCapital;

        return $this;
    }

    /**
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     *
     * @param string $type 
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     *
     * @return string
     */
    public function getTva()
    {
        return $this->tva;
    }

    /**
     *
     * @param string $tva 
     */
    public function setTva($tva)
    {
        $this->tva = $tva;

        $this->tvaToSiren();

        return $this;
    }

    /**
     *
     * @return string $countryCode
     */
    public function getCountryCode()
    {
        return $this->countryCode;
    }

    /**
     *
     * @param string $countryCode 
     */
    public function setCountryCode($countryCode)
    {
        $this->countryCode = $countryCode;

        return $this;
    }

    /**
     *
     * @return integer $infoCode
     */
    public function getInfoCode()
    {
        return $this->infoCode;
    }

    /**
     *
     * @param integer $infoCode 
     */
    public function setInfoCode($infoCode)
    {
        $this->infoCode = $infoCode;

        return $this;
    }

    public function getSiren()
    {
        return $this->siren;
    }

    public function setSiren($siren)
    {
        $this->siren = $siren;

        return $this;
    }

    /**
     *
     * @return integer $siret 
     */
    public function getSiret()
    {
        return $this->siret;
    }

    /**
     *
     * @param integer $siret 
     */
    public function setSiret($siret)
    {
        $this->siret = $siret;

        $this->siretToSiren();

        return $this;
    }

    /**
     *
     * @return integer $nic
     */
    public function getNic()
    {
        return $this->nic;
    }

    /**
     *
     * @param integer $nic 
     */
    public function setNic($nic)
    {
        $this->nic = $nic;

        return $this;
    }

    /**
     *
     * @return string $registrationDate
     */
    public function getRegistrationDate()
    {
        return $this->registrationDate;
    }

    /**
     *
     * @param string $registrationDate 
     */
    public function setRegistrationDate($registrationDate)
    {
        $this->registrationDate = $registrationDate;

        return $this;
    }

    /**
     *
     * @return string 
     */
    public function getCreationDate()
    {
        return $this->creationDate;
    }

    /**
     *
     * @param string $creationDate 
     */
    public function setCreationDate($creationDate)
    {
        $this->creationDate = $creationDate;

        return $this;
    }

    /**
     *
     * @return string $reasonForFormation
     */
    public function getReasonForFormation()
    {
        return $this->reasonForFormation;
    }

    /**
     *
     * @param string $reasonForFormation 
     */
    public function setReasonForFormation($reasonForFormation)
    {
        $this->reasonForFormation = $reasonForFormation;

        return $this;
    }

    /**
     *
     * @return type 
     */
    public function getReasonForClosure()
    {
        return $this->reasonForClosure;
    }

    /**
     *
     * @param type $reasonForClosure 
     */
    public function setReasonForClosure($reasonForClosure)
    {
        $this->reasonForClosure = $reasonForClosure;

        return $this;
    }

    /**
     *
     * @return type 
     */
    public function getClosureDate()
    {
        return $this->closureDate;
    }

    /**
     *
     * @param type $closureDate 
     */
    public function setClosureDate($closureDate)
    {
        $this->closureDate = $closureDate;

        return $this;
    }

    /**
     *
     * @return string $deregistrationDate
     */
    public function getDeregistrationDate()
    {
        return $this->deregistrationDate;
    }

    /**
     *
     * @param string $deregistrationDate 
     */
    public function setDeregistrationDate($deregistrationDate)
    {
        $this->deregistrationDate = $deregistrationDate;

        return $this;
    }

    /**
     *
     * @return string 
     */
    public function getLastAccountDate()
    {
        return $this->lastAccountDate;
    }

    /**
     *
     * @param string $lastAccountDate 
     */
    public function setLastAccountDate($lastAccountDate)
    {
        $this->lastAccountDate = $lastAccountDate;

        return $this;
    }

    /**
     *
     * @return string $reactivationDate
     */
    public function getReactivationDate()
    {
        return $this->reactivationDate;
    }

    /**
     *
     * @param string $reactivationDate 
     */
    public function setReactivationDate($reactivationDate)
    {
        $this->reactivationDate = $reactivationDate;

        return $this;
    }

    /**
     *
     * @return string $productionRole
     */
    public function getProductionRole()
    {
        return $this->productionRole;
    }

    /**
     *
     * @param string $productionRole 
     */
    public function setProductionRole($productionRole)
    {
        $this->productionRole = $productionRole;

        return $this;
    }

    /**
     *
     * @return type 
     */
    public function getNature()
    {
        return $this->nature;
    }

    /**
     *
     * @param type $nature 
     */
    public function setNature($nature)
    {
        $this->nature = $nature;

        return $this;
    }

    /**
     *
     * @return type 
     */
    public function getActivityLocation()
    {
        return $this->activityLocation;
    }

    /**
     *
     * @param type $activityLocation 
     */
    public function setActivityLocation($activityLocation)
    {
        $this->activityLocation = $activityLocation;

        return $this;
    }

    /**
     *
     * @return type 
     */
    public function getLocationSurface()
    {
        return $this->locationSurface;
    }

    /**
     *
     * @param type $locationSurface 
     */
    public function setLocationSurface($locationSurface)
    {
        $this->locationSurface = $locationSurface;

        return $this;
    }

    /**
     *
     * @return type 
     */
    public function getSeasonality()
    {
        return $this->seasonality;
    }

    /**
     *
     * @param type $seasonality 
     */
    public function setSeasonality($seasonality)
    {
        $this->seasonality = $seasonality;

        return $this;
    }

    /**
     *
     * @return string $professionalText
     */
    public function getProfessionalText()
    {
        return $this->professionalText;
    }

    /**
     *
     * @param string $professionalText 
     */
    public function setProfessionalText($professionalText)
    {
        $this->professionalText = $professionalText;

        return $this;
    }

    /**
     *
     * @return type 
     */
    public function getNationality()
    {
        return $this->nationality;
    }

    /**
     *
     * @param type $nationality 
     */
    public function setNationality($nationality)
    {
        $this->nationality = $nationality;

        return $this;
    }

    /**
     *
     * @return type 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     *
     * @return type 
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     *
     * @param type $rating 
     */
    public function setRating($rating)
    {
        $this->rating = $rating;

        return $this;
    }

    /**
     *
     * @return type 
     */
    public function getCreditLimit()
    {
        return $this->creditLimit;
    }

    /**
     *
     * @param type $creditLimit 
     */
    public function setCreditLimit($creditLimit)
    {
        $this->creditLimit = $creditLimit;

        return $this;
    }

    /**
     *
     * @param type $status 
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     *
     * @return type 
     */
    public function getTradingToDate()
    {
        return $this->tradingToDate;
    }

    /**
     *
     * @param type $tradingToDate 
     */
    public function setTradingToDate($tradingToDate)
    {
        $this->tradingToDate = $tradingToDate;

        return $this;
    }

    /**
     *
     * @return type 
     */
    public function getDepartmentDescription()
    {
        return $this->departmentDescription;
    }

    /**
     *
     * @param type $departmentDescription 
     */
    public function setDepartmentDescription($departmentDescription)
    {
        $this->departmentDescription = $departmentDescription;

        return $this;
    }

    /**
     *
     * @return type 
     */
    public function getDepartment()
    {
        return $this->department;
    }

    /**
     *
     * @param type $department 
     */
    public function setDepartment($department)
    {
        $this->department = $department;

        return $this;
    }

    /**
     *
     * @return type 
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     *
     * @param type $region 
     */
    public function setRegion($region)
    {
        $this->region = $region;

        return $this;
    }

    /**
     *
     * @return type 
     */
    public function getDistrict()
    {
        return $this->district;
    }

    /**
     *
     * @param type $district 
     */
    public function setDistrict($district)
    {
        $this->district = $district;

        return $this;
    }

    /**
     *
     * @return type 
     */
    public function getArea()
    {
        return $this->area;
    }

    /**
     *
     * @param type $area 
     */
    public function setArea($area)
    {
        $this->area = $area;

        return $this;
    }

    /**
     *
     * @return type 
     */
    public function getMunicipality()
    {
        return $this->municipality;
    }

    /**
     *
     * @param type $municipality 
     */
    public function setMunicipality($municipality)
    {
        $this->municipality = $municipality;

        return $this;
    }

    /**
     *
     * @return type 
     */
    public function getSizeOfUrbanArea()
    {
        return $this->sizeOfUrbanArea;
    }

    /**
     *
     * @param type $sizeOfUrbanArea 
     */
    public function setSizeOfUrbanArea($sizeOfUrbanArea)
    {
        $this->sizeOfUrbanArea = $sizeOfUrbanArea;

        return $this;
    }

    /**
     *
     * @return type 
     */
    public function getBranches()
    {
        return $this->branches;
    }

    /**
     *
     * @param type $branches 
     */
    public function setBranches($branches)
    {
        $this->branches = $branches;

        return $this;
    }

    /**
     *
     * @return string 
     */
    public function getNumberOfBranches()
    {
        return $this->numberOfBranches;
    }

    /**
     *
     * @param string $numberOfBranches 
     */
    public function setNumberOfBranches($numberOfBranches)
    {
        $this->numberOfBranches = $numberOfBranches;

        return $this;
    }

    /**
     *
     * @return type 
     */
    public function getRegionality()
    {
        return $this->regionality;
    }

    /**
     *
     * @param type $regionality 
     */
    public function setRegionality($regionality)
    {
        $this->regionality = $regionality;

        return $this;
    }

    /**
     *
     * @return type 
     */
    public function getMonoActivityStatus()
    {
        return $this->monoActivityStatus;
    }

    /**
     *
     * @param type $monoActivityStatus 
     */
    public function setMonoActivityStatus($monoActivityStatus)
    {
        $this->monoActivityStatus = $monoActivityStatus;

        return $this;
    }

    /**
     *
     * @return array 
     */
    public function getBalanceSheets()
    {
        return $this->balanceSheets;
    }

    /**
     *
     * @param array $balanceSheets 
     */
    public function setBalanceSheets($balanceSheets)
    {
        $this->balanceSheets = $balanceSheets;

        return $this;
    }

    /**
     *
     * @return type 
     */
    public function getPreviousRatings()
    {
        return $this->previousRatings;
    }

    /**
     *
     * @param type $previousRatings 
     */
    public function setPreviousRatings($previousRatings)
    {
        $this->previousRatings = $previousRatings;

        return $this;
    }

    /**
     *
     * @return type 
     */
    public function getJudgements()
    {
        return $this->judgements;
    }

    /**
     *
     * @param type $judgements 
     */
    public function setJudgements($judgements)
    {
        $this->judgements = $judgements;

        return $this;
    }

    /**
     *
     * @return array $leaderships
     */
    public function getLeaderships()
    {
        return $this->leaderships;
    }

    /**
     *
     * @param array $leaderships 
     */
    public function setLeaderships($leaderships)
    {
        $this->leaderships = $leaderships;

        return $this;
    }

    /**
     *
     * @return array $publications
     */
    public function getPublications()
    {
        return $this->publications;
    }

    /**
     *
     * @param array $publications 
     */
    public function setPublications($publications)
    {
        $this->publications = $publications;

        return $this;
    }

    /**
     *
     * @return array 
     */
    public function getCompanyEvents()
    {
        return $this->companyEvents;
    }

    /**
     *
     * @param array $companyEvents 
     */
    public function setCompanyEvents($companyEvents)
    {
        $this->companyEvents = $companyEvents;

        return $this;
    }

    /**
     *
     * @return array $establishmentEvents
     */
    public function getEstablishmentEvents()
    {
        return $this->establishmentEvents;
    }

    /**
     *
     * @param array $establishmentEvents 
     */
    public function setEstablishmentEvents($establishmentEvents)
    {
        $this->establishmentEvents = $establishmentEvents;

        return $this;
    }

    /**
     *
     * @return array 
     */
    public function getUltimateParents()
    {
        return $this->ultimateParents;
    }

    /**
     *
     * @param array $ultimateParents 
     */
    public function setUltimateParents($ultimateParents)
    {
        $this->ultimateParents = $ultimateParents;

        return $this;
    }

    /**
     *
     * @return integer $numberOfCompanies
     */
    public function getNumberOfCompanies()
    {
        return $this->numberOfCompanies;
    }

    /**
     *
     * @param integer $numberOfCompanies 
     */
    public function setNumberOfCompanies($numberOfCompanies)
    {
        $this->numberOfCompanies = $numberOfCompanies;

        return $this;
    }

    /**
     *
     * @return string $parentCompanyName
     */
    public function getParentCompanyName()
    {
        return $this->parentCompanyName;
    }

    /**
     *
     * @param string $parentCompanyName 
     */
    public function setParentCompanyName($parentCompanyName)
    {
        $this->parentCompanyName = $parentCompanyName;

        return $this;
    }

    /**
     *
     * @return string $directorName
     */
    public function getDirectorName()
    {
        return $this->directorName;
    }

    /**
     *
     * @param string $directorName 
     */
    public function setDirectorName($directorName)
    {
        $this->directorName = $directorName;
    }
    
    /**
     *
     * @return type 
     */
    public function getChristianName()
    {
        return $this->christianName;
    }

    /**
     *
     * @param type $christianName 
     */
    public function setChristianName($christianName)
    {
        $this->christianName = $christianName;
    }

    /**
     * Convert tva number to siren
     */
    public function tvaToSiren()
    {
        if (preg_match('/([A-Z]{2})([0-9]{2})([0-9]{9})/i', $this->getTva(), $matches)) {
            $this->setCountryCode($matches[1]);
            $this->setInfoCode($matches[2]);
            $this->setSiren($matches[3]);
        }

        return $this;
    }

    /**
     * Convert siret to siren
     */
    public function siretToSiren()
    {
        if (preg_match('/([0-9]{9})([0-9]{5})/i', $this->getSiret(), $matches)) {
            $this->setSiren($matches[1]);
            $this->setNic($matches[2]);
        }

        return $this;
    }

    /**
     * Generate tva number from siren and countryCode
     */
    public function generateTva()
    {
        $infoCode = (12 + 3 * ($this->getSiren() % 97)) % 97;
        $this->setInfoCode($infoCode);
        $this->setTva(sprintf('%s%s%s', $this->getCountryCode(), $this->getInfoCode(), $this->getSiren()));

        return $this;
    }

}

?>
