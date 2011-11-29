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
     * @var string $professionalText
     */
    private $professionalText;

    /**
     *
     * @var type $name
     */
    private $name;

    /**
     *
     * @var type $additionToName
     */
    private $additionToName;

    /**
     *
     * @var type $address
     */
    private $address;

    /**
     *
     * @var type $additionToAddress
     */
    private $additionToAddress;

    /**
     *
     * @var type $specialDistribution
     */
    private $specialDistribution;

    /**
     *
     * @var type $distributionLine
     */
    private $distributionLine;

    /**
     * @var array tradingAddress
     */
    private $tradingAddress = array();

    /**
     *
     * @var type $nationality
     */
    private $nationality;

    /**
     *
     * @var type $status
     */
    private $status;

    /**
     *
     * @var type $rating
     */
    private $rating;

    /**
     *
     * @var type $creditLimit
     */
    private $creditLimit;

    /**
     *
     * @var type $tradingToDate
     */
    private $tradingToDate = array();

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
    }

    /**
     *
     * @param string $activityCode 
     */
    public function setActivityCode($activityCode)
    {
        $this->activityCode = $activityCode;
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
    }

    public function getSiren()
    {
        return $this->siren;
    }

    public function setSiren($siren)
    {
        $this->siren = $siren;
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
    }

    /**
     *
     * @param type $status 
     */
    public function setStatus($status)
    {
        $this->status = $status;
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
