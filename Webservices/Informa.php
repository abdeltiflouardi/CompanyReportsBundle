<?php

namespace OS\CompanyReportsBundle\Webservices;

/**
 * This class get companies informations
 *
 * @author abdou
 */
use SoapClient,
    SoapVar,
    DOMDocument,
    SimpleXMLElement,
    OS\CompanyReportsBundle\CompanyReports;

class Informa implements \Serializable
{

    /**
     * URL of webservice
     * 
     * @var string $urlWSDL
     */
    private $urlWSDL = 'https://services.informa.es:8243/soap/gps?wsdl';

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
     */
    public function getProduct()
    {
        $this->callWS('getProduct');
    }

    /**
     * 
     */
    public function getTables()
    {
        $this->callWS('getTables');
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
                $options[] = 'getProduct';
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
    public function callWS($func = 'getProduct')
    {
        $client = new SoapClient($this->getUrlWSDL());

        try {
            $this->result = $client->__SoapCall($func, array($this->getData($func)));
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
    public function getData($func = 'getProduct')
    {
        // For product request
        $getProduct = new SoapVar(
                        sprintf('<getProduct>
                <userId>%s</userId>
                <password>%s</password>
                <productCode>ETIQUETA_EMPRESA</productCode>
                <productVersion>1.2</productVersion>
                <parameters>
                    <parameter name="CIF">%s</parameter>
                    <parameter name="FORMATO_PGC">1</parameter>
                    <parameter name="NORMALIZADO">1</parameter>
                    <parameter name="IDIOMA">01</parameter>
                    <parameter name="LITERALES">1</parameter>
                </parameters>
            </getProduct>', $this->companyReports->getLogin(), $this->companyReports->getPassword(), substr($this->companyReports->getTva(), 2)), XSD_ANYXML);

        // For getTables request
        $getTables = new SoapVar(
                        sprintf('<getTables>
                <userId>%s</userId>
                <password>%s</password>
                <languageCode>01</languageCode>
            </getTables>', $this->companyReports->getLogin(), $this->companyReports->getPassword()), XSD_ANYXML);

        return $$func;
    }

    /**
     *
     * @return OS\CompanyReportsBundle\Webservices\Informa
     */
    public function bindData()
    {
        if (!$this->result) {
            return $this;
        }

        $rc = new \ReflectionObject($this->result);
        if (!$rc->hasProperty('errorCode') || $this->result->errorCode != 0) {
            return $this;
        }

        $etiquetaEmpresa = $this->result->product->etiquetaEmpresa;

        // Select report name
        $identity   = $etiquetaEmpresa->identificacionLocalizacion->identificacion;
        $item       = $identity->tipoDenominaciones->tipodenominacion;
        $item       = is_array($item) ? $item[0] : $item;
        $reportName = $item->valor;

        $this->companyReports->setReportName($reportName);

        // Select Company address
        $direccion = $identity->tipoDirecciones->direccion;
        $direccion = is_array($direccion) ? $direccion[0] : $direccion;
        $address   = $direccion->valor;

        $numeroCalle = '';
        $rc          = new \ReflectionObject($direccion);
        if ($rc->hasProperty('numeroCalle')) {
            $numeroCalle = ', ' . $direccion->numeroCalle;
        }

        $this->companyReports->setAddress(sprintf('%s%s', $address, $numeroCalle));

        $zipcode = $direccion->codigoPostal;
        $city    = $direccion->municipio;
        $this->companyReports->setAdditionToAddress(sprintf('%s %s', $zipcode, $city));

        // select company phone
        $rc = new \ReflectionObject($identity);
        if ($rc->hasProperty('tipoContactos')) {
            $contacto = $identity->tipoContactos->contacto;
            $phone    = is_array($contacto) ? $contacto[0] : $contacto;
            $phone    = $phone->valor;

            $this->companyReports->setPhone($phone);

            // select company fax
            $fax = is_array($contacto) ? $contacto[1] : '';
            $fax = $fax ? $fax->valor : '';

            $this->companyReports->setFax($fax);
        }

        // select company forma legal
        $fl = $etiquetaEmpresa->identificacionLocalizacion->caracteristicas->formaLegal;

        $this->companyReports->setLegalStatus($this->getFormaLegal($fl, $reportName));

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

    public function getFormaLegal($formaLegalCode, $company)
    {
        $list = array(
            'A' => 'SOCIEDAD ANONIMA',
            'B' => 'SOCIEDAD LIMITADA',
            'C' => 'SOCIEDAD REGULAR COLECTIVA',
            'D' => 'SOCIEDAD COMANDITARIA',
            'E' => 'COMUNIDAD DE BIENES',
            'F' => 'COOPERATIVA',
            'G' => 'ASOCIACION',
            'H' => 'COMUNIDAD DE PROPIETARIOS',
            'J' => 'SOCIEDAD CIVIL',
            'K' => 'AUTONOMO MENOR DE EDAD',
            'L' => 'AUTONOMO RESIDENCIA EN EL EXTRANJERO',
            'N' => 'ENTIDADES EXTRANJERAS',
            'P' => 'CORPORACION LOCAL',
            'Q' => 'ORGANISMO PÚBLICO',
            'R' => 'CONGREGACIONES E INSTITUCIONES RELIGIOSAS',
            'S' => 'ORGANISMO DE LA ADMINISTRACION DEL ESTADO Y CCAA',
            'T' => 'AUTONOMO EXTRANJERO',
            'TR' => 'AUTONOMO EXTRANJERO',
            'U' => 'UNIONES TEMPORALES DE EMPRESAS',
            'V' => 'OTROS TIPOS NO DEFINIDOS',
            'W' => 'ESTABLECIMIENTO PERMANENTE DE ENTIDAD NO RESIDENTE',
            'X' => 'AUTONOMO EXTRANJERO',
            '0' => 'EMPRESARIO INDIVIDUAL',
            '1' => 'EMPRESARIO INDIVIDUAL',
            '2' => 'EMPRESARIO INDIVIDUAL',
            '3' => 'EMPRESARIO INDIVIDUAL',
            '4' => 'EMPRESARIO INDIVIDUAL',
            '5' => 'EMPRESARIO INDIVIDUAL',
            '6' => 'EMPRESARIO INDIVIDUAL',
            '7' => 'EMPRESARIO INDIVIDUAL',
            '8' => 'EMPRESARIO INDIVIDUAL',
            '9' => 'EMPRESARIO INDIVIDUAL'
        );

        if (array_key_exists($formaLegalCode, $list)) {
            return $list[$formaLegalCode];
        }

        return null;
    }

}

?>
