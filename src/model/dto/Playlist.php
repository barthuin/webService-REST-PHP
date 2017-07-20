<?php

namespace model\dto;

use Doctrine\ORM\Mapping as ORM;

/**
 * Playlist
 *
 * @ORM\Table(name="playlist", indexes={@ORM\Index(name="idCanal", columns={"idCanal"})})
 * @ORM\Entity
 */
class Playlist
{
    /**
     * @var string
     *
     * @ORM\Column(name="idYoutube", type="string", length=34, nullable=false)
     */
    private $idYoutube;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="string", length=255, nullable=false)
     */
    private $descripcion;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ingles", type="boolean", nullable=false)
     */
    private $ingles;

    /**
     * @var string
     *
     * @ORM\Column(name="titulo", type="string", length=255, nullable=false)
     */
    private $titulo;

    /**
     * @var string
     *
     * @ORM\Column(name="imagen", type="string", length=255, nullable=false)
     */
    private $imagen;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \Canales
     *
     * @ORM\ManyToOne(targetEntity="Canales")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idCanal", referencedColumnName="Id")
     * })
     */
    private $idcanal;


    /**
     * Class Constructor
     * @param    $idYoutube   
     * @param    $descripcion   
     * @param    $ingles   
     * @param    $titulo   
     * @param    $imagen   
     * @param    $id   
     * @param    $idcanal   
     */
    public function __construct($idYoutube, $descripcion, $ingles, $titulo, $imagen, $idcanal)
    {
        $this->idYoutube = $idYoutube;
        $this->descripcion = $descripcion;
        $this->ingles = $ingles;
        $this->titulo = $titulo;
        $this->imagen = $imagen;
        $this->idcanal = $idcanal;;
    }




    /**
     * Set idYoutube
     *
     * @param string $idYoutube
     * @return Playlist
     */
    public function setIdYoutube($idYoutube)
    {
        $this->idYoutube = $idYoutube;

        return $this;
    }

    /**
     * Get idYoutube
     *
     * @return string 
     */
    public function getIdYoutube()
    {
        return $this->idYoutube;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return Playlist
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string 
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set ingles
     *
     * @param boolean $ingles
     * @return Playlist
     */
    public function setIngles($ingles)
    {
        $this->ingles = $ingles;

        return $this;
    }

    /**
     * Get ingles
     *
     * @return boolean 
     */
    public function getIngles()
    {
        return $this->ingles;
    }

    /**
     * Set titulo
     *
     * @param string $titulo
     * @return Playlist
     */
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;

        return $this;
    }

    /**
     * Get titulo
     *
     * @return string 
     */
    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * Set imagen
     *
     * @param string $imagen
     * @return Playlist
     */
    public function setImagen($imagen)
    {
        $this->imagen = $imagen;

        return $this;
    }

    /**
     * Get imagen
     *
     * @return string 
     */
    public function getImagen()
    {
        return $this->imagen;
    }

    /**
     * Set id
     *
     * @return integer 
     */
    public function setId($id)
    {
        $this->id = $id;
    }

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
     * Set idcanal
     *
     * @param \Canales $idcanal
     * @return Playlist
     */
    public function setIdcanal(\model\dto\Canales $idcanal = null)
    {
        $this->idcanal = $idcanal;

        return $this;
    }

    /**
     * Get idcanal
     *
     * @return \Canales 
     */
    public function getIdcanal()
    {
        return $this->idcanal;
    }
}
