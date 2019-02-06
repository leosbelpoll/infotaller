<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Fcoches
 *
 * @ORM\Table(name="fcoches", indexes={@ORM\Index(name="IDX_5ED946D825F7D575", columns={"vehiculo_id"})})
 * @ORM\Entity
 */
class Fcoches
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="idioma", type="string", length=255, nullable=false)
     */
    private $idioma;

    /**
     * @var string
     *
     * @ORM\Column(name="pocision_motor", type="string", length=255, nullable=true)
     */
    private $pocisionMotor;

    /**
     * @var string
     *
     * @ORM\Column(name="distribucion", type="string", length=255, nullable=true)
     */
    private $distribucion;

    /**
     * @var string
     *
     * @ORM\Column(name="numero_cilindros", type="string", length=255, nullable=true)
     */
    private $numeroCilindros;

    /**
     * @var string
     *
     * @ORM\Column(name="valvula_cilindro", type="string", length=255, nullable=true)
     */
    private $valvulaCilindro;

    /**
     * @var string
     *
     * @ORM\Column(name="cilindrada", type="string", length=255, nullable=true)
     */
    private $cilindrada;

    /**
     * @var string
     *
     * @ORM\Column(name="potencia_maxima", type="string", length=255, nullable=true)
     */
    private $potenciaMaxima;

    /**
     * @var string
     *
     * @ORM\Column(name="par_motor_maxima", type="string", length=255, nullable=true)
     */
    private $parMotorMaxima;

    /**
     * @var string
     *
     * @ORM\Column(name="diametro_carrera", type="string", length=255, nullable=true)
     */
    private $diametroCarrera;

    /**
     * @var string
     *
     * @ORM\Column(name="alimentacion", type="string", length=255, nullable=true)
     */
    private $alimentacion;

    /**
     * @var string
     *
     * @ORM\Column(name="caja_cambio", type="string", length=255, nullable=true)
     */
    private $cajaCambio;

    /**
     * @var string
     *
     * @ORM\Column(name="desarrollos", type="string", length=255, nullable=true)
     */
    private $desarrollos;

    /**
     * @var string
     *
     * @ORM\Column(name="marcha_atras", type="string", length=255, nullable=true)
     */
    private $marchaAtras;

    /**
     * @var string
     *
     * @ORM\Column(name="grupo_final", type="string", length=255, nullable=true)
     */
    private $grupoFinal;

    /**
     * @var string
     *
     * @ORM\Column(name="traccion", type="string", length=255, nullable=true)
     */
    private $traccion;

    /**
     * @var string
     *
     * @ORM\Column(name="suspension_delantera", type="string", length=255, nullable=true)
     */
    private $suspensionDelantera;

    /**
     * @var string
     *
     * @ORM\Column(name="suspension_trasera", type="string", length=255, nullable=true)
     */
    private $suspensionTrasera;

    /**
     * @var string
     *
     * @ORM\Column(name="frenos_delanteros", type="string", length=255, nullable=true)
     */
    private $frenosDelanteros;

    /**
     * @var string
     *
     * @ORM\Column(name="frenos_traseros", type="string", length=255, nullable=true)
     */
    private $frenosTraseros;

    /**
     * @var string
     *
     * @ORM\Column(name="neumaticos", type="string", length=255, nullable=true)
     */
    private $neumaticos;

    /**
     * @var string
     *
     * @ORM\Column(name="llantas", type="string", length=255, nullable=true)
     */
    private $llantas;

    /**
     * @var string
     *
     * @ORM\Column(name="tipo_direccion", type="string", length=255, nullable=true)
     */
    private $tipoDireccion;

    /**
     * @var string
     *
     * @ORM\Column(name="radio_giro", type="string", length=255, nullable=true)
     */
    private $radioGiro;

    /**
     * @var string
     *
     * @ORM\Column(name="vueltas_volante_tope", type="string", length=255, nullable=true)
     */
    private $vueltasVolanteTope;

    /**
     * @var string
     *
     * @ORM\Column(name="largo", type="string", length=255, nullable=true)
     */
    private $largo;

    /**
     * @var string
     *
     * @ORM\Column(name="ancho", type="string", length=255, nullable=true)
     */
    private $ancho;

    /**
     * @var string
     *
     * @ORM\Column(name="alto", type="string", length=255, nullable=true)
     */
    private $alto;

    /**
     * @var string
     *
     * @ORM\Column(name="distancia_ejes", type="string", length=255, nullable=true)
     */
    private $distanciaEjes;

    /**
     * @var string
     *
     * @ORM\Column(name="via_delantera", type="string", length=255, nullable=true)
     */
    private $viaDelantera;

    /**
     * @var string
     *
     * @ORM\Column(name="via_trasera", type="string", length=255, nullable=true)
     */
    private $viaTrasera;

    /**
     * @var string
     *
     * @ORM\Column(name="peso", type="string", length=255, nullable=true)
     */
    private $peso;

    /**
     * @var string
     *
     * @ORM\Column(name="capacidad_maletero", type="string", length=255, nullable=true)
     */
    private $capacidadMaletero;

    /**
     * @var string
     *
     * @ORM\Column(name="deposito_combustible", type="string", length=255, nullable=true)
     */
    private $depositoCombustible;

    /**
     * @var string
     *
     * @ORM\Column(name="velocidad_maxima", type="string", length=255, nullable=true)
     */
    private $velocidadMaxima;

    /**
     * @var string
     *
     * @ORM\Column(name="aceleracion", type="string", length=255, nullable=true)
     */
    private $aceleracion;

    /**
     * @var string
     *
     * @ORM\Column(name="consumo_urbano", type="string", length=255, nullable=true)
     */
    private $consumoUrbano;

    /**
     * @var string
     *
     * @ORM\Column(name="consumo_extraurbano", type="string", length=255, nullable=true)
     */
    private $consumoExtraurbano;

    /**
     * @var string
     *
     * @ORM\Column(name="consumo_medio", type="string", length=255, nullable=true)
     */
    private $consumoMedio;

    /**
     * @var string
     *
     * @ORM\Column(name="emisiones", type="string", length=255, nullable=true)
     */
    private $emisiones;

    /**
     * @var string
     *
     * @ORM\Column(name="combustible", type="string", length=255, nullable=true)
     */
    private $combustible;

    /**
     * @var \Vehiculo
     *
     * @ORM\ManyToOne(targetEntity="Vehiculo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="vehiculo_id", referencedColumnName="id")
     * })
     */
    private $vehiculo;



    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set idioma
     *
     * @param string $idioma
     *
     * @return Fcoches
     */
    public function setIdioma($idioma)
    {
        $this->idioma = $idioma;

        return $this;
    }

    /**
     * Get idioma
     *
     * @return string
     */
    public function getIdioma()
    {
        return $this->idioma;
    }

    /**
     * Set pocisionMotor
     *
     * @param string $pocisionMotor
     *
     * @return Fcoches
     */
    public function setPocisionMotor($pocisionMotor)
    {
        $this->pocisionMotor = $pocisionMotor;

        return $this;
    }

    /**
     * Get pocisionMotor
     *
     * @return string
     */
    public function getPocisionMotor()
    {
        return $this->pocisionMotor;
    }

    /**
     * Set distribucion
     *
     * @param string $distribucion
     *
     * @return Fcoches
     */
    public function setDistribucion($distribucion)
    {
        $this->distribucion = $distribucion;

        return $this;
    }

    /**
     * Get distribucion
     *
     * @return string
     */
    public function getDistribucion()
    {
        return $this->distribucion;
    }

    /**
     * Set numeroCilindros
     *
     * @param string $numeroCilindros
     *
     * @return Fcoches
     */
    public function setNumeroCilindros($numeroCilindros)
    {
        $this->numeroCilindros = $numeroCilindros;

        return $this;
    }

    /**
     * Get numeroCilindros
     *
     * @return string
     */
    public function getNumeroCilindros()
    {
        return $this->numeroCilindros;
    }

    /**
     * Set valvulaCilindro
     *
     * @param string $valvulaCilindro
     *
     * @return Fcoches
     */
    public function setValvulaCilindro($valvulaCilindro)
    {
        $this->valvulaCilindro = $valvulaCilindro;

        return $this;
    }

    /**
     * Get valvulaCilindro
     *
     * @return string
     */
    public function getValvulaCilindro()
    {
        return $this->valvulaCilindro;
    }

    /**
     * Set cilindrada
     *
     * @param string $cilindrada
     *
     * @return Fcoches
     */
    public function setCilindrada($cilindrada)
    {
        $this->cilindrada = $cilindrada;

        return $this;
    }

    /**
     * Get cilindrada
     *
     * @return string
     */
    public function getCilindrada()
    {
        return $this->cilindrada;
    }

    /**
     * Set potenciaMaxima
     *
     * @param string $potenciaMaxima
     *
     * @return Fcoches
     */
    public function setPotenciaMaxima($potenciaMaxima)
    {
        $this->potenciaMaxima = $potenciaMaxima;

        return $this;
    }

    /**
     * Get potenciaMaxima
     *
     * @return string
     */
    public function getPotenciaMaxima()
    {
        return $this->potenciaMaxima;
    }

    /**
     * Set parMotorMaxima
     *
     * @param string $parMotorMaxima
     *
     * @return Fcoches
     */
    public function setParMotorMaxima($parMotorMaxima)
    {
        $this->parMotorMaxima = $parMotorMaxima;

        return $this;
    }

    /**
     * Get parMotorMaxima
     *
     * @return string
     */
    public function getParMotorMaxima()
    {
        return $this->parMotorMaxima;
    }

    /**
     * Set diametroCarrera
     *
     * @param string $diametroCarrera
     *
     * @return Fcoches
     */
    public function setDiametroCarrera($diametroCarrera)
    {
        $this->diametroCarrera = $diametroCarrera;

        return $this;
    }

    /**
     * Get diametroCarrera
     *
     * @return string
     */
    public function getDiametroCarrera()
    {
        return $this->diametroCarrera;
    }

    /**
     * Set alimentacion
     *
     * @param string $alimentacion
     *
     * @return Fcoches
     */
    public function setAlimentacion($alimentacion)
    {
        $this->alimentacion = $alimentacion;

        return $this;
    }

    /**
     * Get alimentacion
     *
     * @return string
     */
    public function getAlimentacion()
    {
        return $this->alimentacion;
    }

    /**
     * Set cajaCambio
     *
     * @param string $cajaCambio
     *
     * @return Fcoches
     */
    public function setCajaCambio($cajaCambio)
    {
        $this->cajaCambio = $cajaCambio;

        return $this;
    }

    /**
     * Get cajaCambio
     *
     * @return string
     */
    public function getCajaCambio()
    {
        return $this->cajaCambio;
    }

    /**
     * Set desarrollos
     *
     * @param string $desarrollos
     *
     * @return Fcoches
     */
    public function setDesarrollos($desarrollos)
    {
        $this->desarrollos = $desarrollos;

        return $this;
    }

    /**
     * Get desarrollos
     *
     * @return string
     */
    public function getDesarrollos()
    {
        return $this->desarrollos;
    }

    /**
     * Set marchaAtras
     *
     * @param string $marchaAtras
     *
     * @return Fcoches
     */
    public function setMarchaAtras($marchaAtras)
    {
        $this->marchaAtras = $marchaAtras;

        return $this;
    }

    /**
     * Get marchaAtras
     *
     * @return string
     */
    public function getMarchaAtras()
    {
        return $this->marchaAtras;
    }

    /**
     * Set grupoFinal
     *
     * @param string $grupoFinal
     *
     * @return Fcoches
     */
    public function setGrupoFinal($grupoFinal)
    {
        $this->grupoFinal = $grupoFinal;

        return $this;
    }

    /**
     * Get grupoFinal
     *
     * @return string
     */
    public function getGrupoFinal()
    {
        return $this->grupoFinal;
    }

    /**
     * Set traccion
     *
     * @param string $traccion
     *
     * @return Fcoches
     */
    public function setTraccion($traccion)
    {
        $this->traccion = $traccion;

        return $this;
    }

    /**
     * Get traccion
     *
     * @return string
     */
    public function getTraccion()
    {
        return $this->traccion;
    }

    /**
     * Set suspensionDelantera
     *
     * @param string $suspensionDelantera
     *
     * @return Fcoches
     */
    public function setSuspensionDelantera($suspensionDelantera)
    {
        $this->suspensionDelantera = $suspensionDelantera;

        return $this;
    }

    /**
     * Get suspensionDelantera
     *
     * @return string
     */
    public function getSuspensionDelantera()
    {
        return $this->suspensionDelantera;
    }

    /**
     * Set suspensionTrasera
     *
     * @param string $suspensionTrasera
     *
     * @return Fcoches
     */
    public function setSuspensionTrasera($suspensionTrasera)
    {
        $this->suspensionTrasera = $suspensionTrasera;

        return $this;
    }

    /**
     * Get suspensionTrasera
     *
     * @return string
     */
    public function getSuspensionTrasera()
    {
        return $this->suspensionTrasera;
    }

    /**
     * Set frenosDelanteros
     *
     * @param string $frenosDelanteros
     *
     * @return Fcoches
     */
    public function setFrenosDelanteros($frenosDelanteros)
    {
        $this->frenosDelanteros = $frenosDelanteros;

        return $this;
    }

    /**
     * Get frenosDelanteros
     *
     * @return string
     */
    public function getFrenosDelanteros()
    {
        return $this->frenosDelanteros;
    }

    /**
     * Set frenosTraseros
     *
     * @param string $frenosTraseros
     *
     * @return Fcoches
     */
    public function setFrenosTraseros($frenosTraseros)
    {
        $this->frenosTraseros = $frenosTraseros;

        return $this;
    }

    /**
     * Get frenosTraseros
     *
     * @return string
     */
    public function getFrenosTraseros()
    {
        return $this->frenosTraseros;
    }

    /**
     * Set neumaticos
     *
     * @param string $neumaticos
     *
     * @return Fcoches
     */
    public function setNeumaticos($neumaticos)
    {
        $this->neumaticos = $neumaticos;

        return $this;
    }

    /**
     * Get neumaticos
     *
     * @return string
     */
    public function getNeumaticos()
    {
        return $this->neumaticos;
    }

    /**
     * Set llantas
     *
     * @param string $llantas
     *
     * @return Fcoches
     */
    public function setLlantas($llantas)
    {
        $this->llantas = $llantas;

        return $this;
    }

    /**
     * Get llantas
     *
     * @return string
     */
    public function getLlantas()
    {
        return $this->llantas;
    }

    /**
     * Set tipoDireccion
     *
     * @param string $tipoDireccion
     *
     * @return Fcoches
     */
    public function setTipoDireccion($tipoDireccion)
    {
        $this->tipoDireccion = $tipoDireccion;

        return $this;
    }

    /**
     * Get tipoDireccion
     *
     * @return string
     */
    public function getTipoDireccion()
    {
        return $this->tipoDireccion;
    }

    /**
     * Set radioGiro
     *
     * @param string $radioGiro
     *
     * @return Fcoches
     */
    public function setRadioGiro($radioGiro)
    {
        $this->radioGiro = $radioGiro;

        return $this;
    }

    /**
     * Get radioGiro
     *
     * @return string
     */
    public function getRadioGiro()
    {
        return $this->radioGiro;
    }

    /**
     * Set vueltasVolanteTope
     *
     * @param string $vueltasVolanteTope
     *
     * @return Fcoches
     */
    public function setVueltasVolanteTope($vueltasVolanteTope)
    {
        $this->vueltasVolanteTope = $vueltasVolanteTope;

        return $this;
    }

    /**
     * Get vueltasVolanteTope
     *
     * @return string
     */
    public function getVueltasVolanteTope()
    {
        return $this->vueltasVolanteTope;
    }

    /**
     * Set largo
     *
     * @param string $largo
     *
     * @return Fcoches
     */
    public function setLargo($largo)
    {
        $this->largo = $largo;

        return $this;
    }

    /**
     * Get largo
     *
     * @return string
     */
    public function getLargo()
    {
        return $this->largo;
    }

    /**
     * Set ancho
     *
     * @param string $ancho
     *
     * @return Fcoches
     */
    public function setAncho($ancho)
    {
        $this->ancho = $ancho;

        return $this;
    }

    /**
     * Get ancho
     *
     * @return string
     */
    public function getAncho()
    {
        return $this->ancho;
    }

    /**
     * Set alto
     *
     * @param string $alto
     *
     * @return Fcoches
     */
    public function setAlto($alto)
    {
        $this->alto = $alto;

        return $this;
    }

    /**
     * Get alto
     *
     * @return string
     */
    public function getAlto()
    {
        return $this->alto;
    }

    /**
     * Set distanciaEjes
     *
     * @param string $distanciaEjes
     *
     * @return Fcoches
     */
    public function setDistanciaEjes($distanciaEjes)
    {
        $this->distanciaEjes = $distanciaEjes;

        return $this;
    }

    /**
     * Get distanciaEjes
     *
     * @return string
     */
    public function getDistanciaEjes()
    {
        return $this->distanciaEjes;
    }

    /**
     * Set viaDelantera
     *
     * @param string $viaDelantera
     *
     * @return Fcoches
     */
    public function setViaDelantera($viaDelantera)
    {
        $this->viaDelantera = $viaDelantera;

        return $this;
    }

    /**
     * Get viaDelantera
     *
     * @return string
     */
    public function getViaDelantera()
    {
        return $this->viaDelantera;
    }

    /**
     * Set viaTrasera
     *
     * @param string $viaTrasera
     *
     * @return Fcoches
     */
    public function setViaTrasera($viaTrasera)
    {
        $this->viaTrasera = $viaTrasera;

        return $this;
    }

    /**
     * Get viaTrasera
     *
     * @return string
     */
    public function getViaTrasera()
    {
        return $this->viaTrasera;
    }

    /**
     * Set peso
     *
     * @param string $peso
     *
     * @return Fcoches
     */
    public function setPeso($peso)
    {
        $this->peso = $peso;

        return $this;
    }

    /**
     * Get peso
     *
     * @return string
     */
    public function getPeso()
    {
        return $this->peso;
    }

    /**
     * Set capacidadMaletero
     *
     * @param string $capacidadMaletero
     *
     * @return Fcoches
     */
    public function setCapacidadMaletero($capacidadMaletero)
    {
        $this->capacidadMaletero = $capacidadMaletero;

        return $this;
    }

    /**
     * Get capacidadMaletero
     *
     * @return string
     */
    public function getCapacidadMaletero()
    {
        return $this->capacidadMaletero;
    }

    /**
     * Set depositoCombustible
     *
     * @param string $depositoCombustible
     *
     * @return Fcoches
     */
    public function setDepositoCombustible($depositoCombustible)
    {
        $this->depositoCombustible = $depositoCombustible;

        return $this;
    }

    /**
     * Get depositoCombustible
     *
     * @return string
     */
    public function getDepositoCombustible()
    {
        return $this->depositoCombustible;
    }

    /**
     * Set velocidadMaxima
     *
     * @param string $velocidadMaxima
     *
     * @return Fcoches
     */
    public function setVelocidadMaxima($velocidadMaxima)
    {
        $this->velocidadMaxima = $velocidadMaxima;

        return $this;
    }

    /**
     * Get velocidadMaxima
     *
     * @return string
     */
    public function getVelocidadMaxima()
    {
        return $this->velocidadMaxima;
    }

    /**
     * Set aceleracion
     *
     * @param string $aceleracion
     *
     * @return Fcoches
     */
    public function setAceleracion($aceleracion)
    {
        $this->aceleracion = $aceleracion;

        return $this;
    }

    /**
     * Get aceleracion
     *
     * @return string
     */
    public function getAceleracion()
    {
        return $this->aceleracion;
    }

    /**
     * Set consumoUrbano
     *
     * @param string $consumoUrbano
     *
     * @return Fcoches
     */
    public function setConsumoUrbano($consumoUrbano)
    {
        $this->consumoUrbano = $consumoUrbano;

        return $this;
    }

    /**
     * Get consumoUrbano
     *
     * @return string
     */
    public function getConsumoUrbano()
    {
        return $this->consumoUrbano;
    }

    /**
     * Set consumoExtraurbano
     *
     * @param string $consumoExtraurbano
     *
     * @return Fcoches
     */
    public function setConsumoExtraurbano($consumoExtraurbano)
    {
        $this->consumoExtraurbano = $consumoExtraurbano;

        return $this;
    }

    /**
     * Get consumoExtraurbano
     *
     * @return string
     */
    public function getConsumoExtraurbano()
    {
        return $this->consumoExtraurbano;
    }

    /**
     * Set consumoMedio
     *
     * @param string $consumoMedio
     *
     * @return Fcoches
     */
    public function setConsumoMedio($consumoMedio)
    {
        $this->consumoMedio = $consumoMedio;

        return $this;
    }

    /**
     * Get consumoMedio
     *
     * @return string
     */
    public function getConsumoMedio()
    {
        return $this->consumoMedio;
    }

    /**
     * Set emisiones
     *
     * @param string $emisiones
     *
     * @return Fcoches
     */
    public function setEmisiones($emisiones)
    {
        $this->emisiones = $emisiones;

        return $this;
    }

    /**
     * Get emisiones
     *
     * @return string
     */
    public function getEmisiones()
    {
        return $this->emisiones;
    }

    /**
     * Set combustible
     *
     * @param string $combustible
     *
     * @return Fcoches
     */
    public function setCombustible($combustible)
    {
        $this->combustible = $combustible;

        return $this;
    }

    /**
     * Get combustible
     *
     * @return string
     */
    public function getCombustible()
    {
        return $this->combustible;
    }

    /**
     * Set vehiculo
     *
     * @param \App\Entity\Vehiculo $vehiculo
     *
     * @return Fcoches
     */
    public function setVehiculo(\App\Entity\Vehiculo $vehiculo = null)
    {
        $this->vehiculo = $vehiculo;

        return $this;
    }

    /**
     * Get vehiculo
     *
     * @return \App\Entity\Vehiculo
     */
    public function getVehiculo()
    {
        return $this->vehiculo;
    }
}
