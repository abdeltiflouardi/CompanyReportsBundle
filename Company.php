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
     * court registry number
     * 
     * @var type 
     */
    private $RcsNumber;

    /**
     * court registry description
     * 
     * @var string $RcsDescription
     */
    private $RcsDescription;

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
     * @var type 
     */
    private $name;

    /**
     *
     * @var type 
     */
    private $additionToName;

    /**
     *
     * @var type 
     */
    private $address;

    /**
     *
     * @var type 
     */
    private $additionToAddress;

    /**
     *
     * @var type 
     */
    private $specialDistribution;

    /**
     *
     * @var type 
     */
    private $distributionLine;

    /**
     *
     * @var type 
     */
    private $nationality;

    /**
     *
     * @var type 
     */
    private $status;
    
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
    public function getRcsNumber()
    {
        return $this->RcsNumber;
    }

    /**
     *
     * @param string $RcsNumber 
     */
    public function setRcsNumber($RcsNumber)
    {
        $this->RcsNumber = $RcsNumber;
    }

    /**
     *
     * @return string 
     */
    public function getRcsDescription()
    {
        return $this->RcsDescription;
    }

    /**
     *
     * @param string $RcsDescription 
     */
    public function setRcsDescription($RcsDescription)
    {
        $this->RcsDescription = $RcsDescription;
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
     * @param type $status 
     */
    public function setStatus($status)
    {
        $this->status = $status;
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
