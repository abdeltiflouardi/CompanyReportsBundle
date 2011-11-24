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
