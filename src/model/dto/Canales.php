<?php

namespace model\dto;

use Doctrine\ORM\Mapping as ORM;

/**
 * Canales
 *
 * @ORM\Table(name="Canales")
 * @ORM\Entity
 */
class Canales
{
    /**
     * @var string
     *
     * @ORM\Column(name="Nombre", type="string", length=255, nullable=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="URL", type="string", length=255, nullable=false)
     */
    private $url;

    /**
     * @var string
     *
     * @ORM\Column(name="imagen", type="string", length=255, nullable=false)
     */
    private $imagen;

    /**
     * @var boolean
     *
     * @ORM\Column(name="Ingles", type="boolean", nullable=false)
     */
    private $ingles;

    /**
     * @var integer
     *
     * @ORM\Column(name="Id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * Class Constructor
     */
    /*public function __construct()
    {
        $this->nombre = null;
        $this->url = null;
        $this->imagen = null;
        $this->ingles = null;
        $this->id = null;
    }*/

    /**
     * Class Constructor
     * @param    $nombre   
     * @param    $url   
     * @param    $imagen   
     * @param    $ingles   
     * @param    $id   
     */
    public function __construct($nombre, $url, $imagen, $ingles, $id)
    {
        $this->nombre = $nombre;
        $this->url = $url;
        $this->imagen = $imagen;
        $this->ingles = $ingles;
        $this->id = $id;
    }



    /**
     * Set nombre
     *
     * @param string $nombre
     * @return Canales
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string 
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set url
     *
     * @param string $url
     * @return Canales
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string 
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set imagen
     *
     * @param string $imagen
     * @return Canales
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
     * Set ingles
     *
     * @param boolean $ingles
     * @return Canales
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
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }
}
