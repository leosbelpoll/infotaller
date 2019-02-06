<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Vehiculo
 *
 * @ORM\Table(name="vehiculo", indexes={@ORM\Index(name="IDX_C9FA16039F720353", columns={"clase_id"}), @ORM\Index(name="IDX_C9FA160381EF0041", columns={"marca_id"}), @ORM\Index(name="IDX_C9FA1603A9276E6C", columns={"tipo_id"}), @ORM\Index(name="IDX_C9FA16039C833003", columns={"grupo_id"}), @ORM\Index(name="IDX_C9FA1603DB38439E", columns={"usuario_id"})})
 * @ORM\Entity(repositoryClass="App\Repository\VehiculoRepository")
 */
class Vehiculo
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
     * @ORM\Column(name="modelo", type="string", length=255, nullable=false)
     */
    private $modelo;

    /**
     * @var string
     *
     * @ORM\Column(name="media", type="string", length=255, nullable=true)
     */
    private $media;

    /**
     * @var string
     *
     * @ORM\Column(name="fecha_inicio", type="string", length=255, nullable=false)
     */
    private $fechaInicio;

    /**
     * @var string
     *
     * @ORM\Column(name="fecha_fin", type="string", length=255, nullable=true)
     */
    private $fechaFin;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="creacion", type="date", nullable=false)
     */
    private $creacion;

    /**
     * @var string
     *
     * @ORM\Column(name="estado", type="string", length=255, nullable=false)
     */
    private $estado;

    /**
     * @var string
     *
     * @ORM\Column(name="canti", type="string", length=255, nullable=true)
     */
    private $canti;

    /**
     * @var string
     *
     * @ORM\Column(name="pagado", type="string", length=255, nullable=true)
     */
    private $pagado;

    /**
     * @var \Marca
     *
     * @ORM\ManyToOne(targetEntity="Marca")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="marca_id", referencedColumnName="id")
     * })
     */
    private $marca;

    /**
     * @var \Grupo
     *
     * @ORM\ManyToOne(targetEntity="Grupo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="grupo_id", referencedColumnName="id")
     * })
     */
    private $grupo;

    /**
     * @var \Clase
     *
     * @ORM\ManyToOne(targetEntity="Clase")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="clase_id", referencedColumnName="id")
     * })
     */
    private $clase;

    /**
     * @var \Tipo
     *
     * @ORM\ManyToOne(targetEntity="Tipo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="tipo_id", referencedColumnName="id")
     * })
     */
    private $tipo;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="usuario_id", referencedColumnName="id")
     * })
     */
    private $usuario;



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
     * Set modelo
     *
     * @param string $modelo
     *
     * @return Vehiculo
     */
    public function setModelo($modelo)
    {
        $this->modelo = $modelo;

        return $this;
    }

    /**
     * Get modelo
     *
     * @return string
     */
    public function getModelo()
    {
        return $this->modelo;
    }

    /**
     * Set media
     *
     * @param string $media
     *
     * @return Vehiculo
     */
    public function setMedia($media)
    {
        $this->media = $media;

        return $this;
    }

    /**
     * Get media
     *
     * @return string
     */
    public function getMedia()
    {
        return $this->media;
    }

    /**
     * Set fechaInicio
     *
     * @param string $fechaInicio
     *
     * @return Vehiculo
     */
    public function setFechaInicio($fechaInicio)
    {
        $this->fechaInicio = $fechaInicio;

        return $this;
    }

    /**
     * Get fechaInicio
     *
     * @return string
     */
    public function getFechaInicio()
    {
        return $this->fechaInicio;
    }

    /**
     * Set fechaFin
     *
     * @param string $fechaFin
     *
     * @return Vehiculo
     */
    public function setFechaFin($fechaFin)
    {
        $this->fechaFin = $fechaFin;

        return $this;
    }

    /**
     * Get fechaFin
     *
     * @return string
     */
    public function getFechaFin()
    {
        return $this->fechaFin;
    }

    /**
     * Set creacion
     *
     * @param \DateTime $creacion
     *
     * @return Vehiculo
     */
    public function setCreacion($creacion)
    {
        $this->creacion = $creacion;

        return $this;
    }

    /**
     * Get creacion
     *
     * @return \DateTime
     */
    public function getCreacion()
    {
        return $this->creacion;
    }

    /**
     * Set estado
     *
     * @param string $estado
     *
     * @return Vehiculo
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return string
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set canti
     *
     * @param string $canti
     *
     * @return Vehiculo
     */
    public function setCanti($canti)
    {
        $this->canti = $canti;

        return $this;
    }

    /**
     * Get canti
     *
     * @return string
     */
    public function getCanti()
    {
        return $this->canti;
    }

    /**
     * Set pagado
     *
     * @param string $pagado
     *
     * @return Vehiculo
     */
    public function setPagado($pagado)
    {
        $this->pagado = $pagado;

        return $this;
    }

    /**
     * Get pagado
     *
     * @return string
     */
    public function getPagado()
    {
        return $this->pagado;
    }

    /**
     * Set marca
     *
     * @param \App\Entity\Marca $marca
     *
     * @return Vehiculo
     */
    public function setMarca(\App\Entity\Marca $marca = null)
    {
        $this->marca = $marca;

        return $this;
    }

    /**
     * Get marca
     *
     * @return \App\Entity\Marca
     */
    public function getMarca()
    {
        return $this->marca;
    }

    /**
     * Set grupo
     *
     * @param \App\Entity\Grupo $grupo
     *
     * @return Vehiculo
     */
    public function setGrupo(\App\Entity\Grupo $grupo = null)
    {
        $this->grupo = $grupo;

        return $this;
    }

    /**
     * Get grupo
     *
     * @return \App\Entity\Grupo
     */
    public function getGrupo()
    {
        return $this->grupo;
    }

    /**
     * Set clase
     *
     * @param \App\Entity\Clase $clase
     *
     * @return Vehiculo
     */
    public function setClase(\App\Entity\Clase $clase = null)
    {
        $this->clase = $clase;

        return $this;
    }

    /**
     * Get clase
     *
     * @return \App\Entity\Clase
     */
    public function getClase()
    {
        return $this->clase;
    }

    /**
     * Set tipo
     *
     * @param \App\Entity\Tipo $tipo
     *
     * @return Vehiculo
     */
    public function setTipo(\App\Entity\Tipo $tipo = null)
    {
        $this->tipo = $tipo;

        return $this;
    }

    /**
     * Get tipo
     *
     * @return \App\Entity\Tipo
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Set usuario
     *
     * @param \App\Entity\User $usuario
     *
     * @return Vehiculo
     */
    public function setUsuario(\App\Entity\User $usuario = null)
    {
        $this->usuario = $usuario;

        return $this;
    }

    /**
     * Get usuario
     *
     * @return \App\Entity\User
     */
    public function getUsuario()
    {
        return $this->usuario;
    }
}
