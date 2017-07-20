<?php

namespace model\dto;

use Doctrine\ORM\Mapping as ORM;

/**
 * Videos
 *
 * @ORM\Table(name="videos", indexes={@ORM\Index(name="idPlaylist", columns={"idPlaylist"})})
 * @ORM\Entity
 */
class Videos
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
     * @var \Playlist
     *
     * @ORM\ManyToOne(targetEntity="playlist")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idPlaylist", referencedColumnName="id")
     * })
     */
    private $idPlaylist;

    /**
     * Class Constructor
     * @param    $idYoutube   
     * @param    $titulo   
     * @param    $imagen   
     * @param    $id   
     * @param    $idPlaylist   
     */
    public function __construct($idYoutube, $titulo, $imagen, $idPlaylist)
    {
        $this->idYoutube = $idYoutube;
        $this->titulo = $titulo;
        $this->imagen = $imagen;
        $this->idPlaylist = $idPlaylist;
    }

    /**
     * Set idYoutube
     *
     * @param string $idYoutube
     * @return Videos
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
    public function getIdYouTube()
    {
        return $this->idYoutube;
    }

    /**
     * Set titulo
     *
     * @param string $titulo
     * @return Videos
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
     * @return Videos
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
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set idPlaylist
     *
     * @param \Playlist $idPlaylist
     * @return Videos
     */
    public function setIdplaylist(\Playlist $idPlaylist = null)
    {
        $this->idPlaylist = $idPlaylist;

        return $this;
    }

    /**
     * Get idPlaylist
     *
     * @return \Playlist 
     */
    public function getIdplaylist()
    {
        return $this->idPlaylist;
    }
}