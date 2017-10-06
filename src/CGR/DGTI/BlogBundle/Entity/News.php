<?php

namespace CGR\DGTI\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * News
 *
 * @ORM\Table(name="news")
 * @ORM\Entity(repositoryClass="CGR\DGTI\BlogBundle\Repository\NewsRepository")
 */
class News
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="titulo", type="string", length=255)
     */
    private $titulo;

    /**
     * @var string
     *
     * @ORM\Column(name="resumen", type="string", length=255)
     */
    private $resumen;

    /**
     * @var string
     *
     * @ORM\Column(name="contenido", type="string", length=255)
     */
    private $contenido;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="date", nullable=true)
     */
    private $fecha;

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=255, unique=true)
     */
    private $slug;

    /**
     * @var string
     *
     * @ORM\Column(name="imagen", type="string", length=255) 
     * @Assert\NotBlank(message="Por favor seleccione una imagen")
     * @Assert\File(mimeTypes={ "image/jpg", "image/jpeg", "image/png" })
     */
    private $imagen;

    /**
     * @var bool
     *
     * @ORM\Column(name="publicado", type="boolean", nullable=true)
     */
    private $publicado;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_insert", type="date")
     */
    private $fechaInsert;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_update", type="date")
     */
    private $fechaUpdate;
    
    
    /**
     * @var \DateTime     *
     * @ORM\Column(name="date", type="date", options={"default":0})
     */
    private $date;
    
    /**
     * Many News a have One UserInsert.
     * @ORM\ManyToOne(targetEntity="User", inversedBy="user_insert")
     * @ORM\JoinColumn(name="users_insert", referencedColumnName="id")
     */
    private $usuarioInsert;

    /**
     * Many News a have One UserUpdate.
     * @ORM\ManyToOne(targetEntity="User", inversedBy="user_update")
     * @ORM\JoinColumn(name="users_update", referencedColumnName="id")
     */
    private $usuarioUpdate;

        
    /**
     * Many New a have One Tipo.
     * @ORM\ManyToOne(targetEntity="TipoContenido", inversedBy="noticias")
     * @ORM\JoinColumn(name="tipo_contenido_id", referencedColumnName="id")
     */
    private $tipoContenido;
    
    

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set titulo
     *
     * @param string $titulo
     *
     * @return News
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
     * Set resumen
     *
     * @param string $resumen
     *
     * @return News
     */
    public function setResumen($resumen)
    {
        $this->resumen = $resumen;

        return $this;
    }

    /**
     * Get resumen
     *
     * @return string
     */
    public function getResumen()
    {
        return $this->resumen;
    }

    /**
     * Set contenido
     *
     * @param string $contenido
     *
     * @return News
     */
    public function setContenido($contenido)
    {
        $this->contenido = $contenido;

        return $this;
    }

    /**
     * Get contenido
     *
     * @return string
     */
    public function getContenido()
    {
        return $this->contenido;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     *
     * @return News
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get fecha
     *
     * @return \DateTime
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return News
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set imagen
     *
     * @param string $imagen
     *
     * @return News
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
     * Set publicado
     *
     * @param boolean $publicado
     *
     * @return News
     */
    public function setPublicado($publicado)
    {
        $this->publicado = $publicado;

        return $this;
    }

    /**
     * Get publicado
     *
     * @return bool
     */
    public function getPublicado()
    {
        return $this->publicado;
    }

    /**
     * Set fechaInsert
     *
     * @param \DateTime $fechaInsert
     *
     * @return News
     */
    public function setFechaInsert($fechaInsert)
    {
        $this->fechaInsert = $fechaInsert;

        return $this;
    }

    /**
     * Get fechaInsert
     *
     * @return \DateTime
     */
    public function getFechaInsert()
    {
        return $this->fechaInsert;
    }

    /**
     * Set fechaUpdate
     *
     * @param \DateTime $fechaUpdate
     *
     * @return News
     */
    public function setFechaUpdate($fechaUpdate)
    {
        $this->fechaUpdate = $fechaUpdate;

        return $this;
    }

    /**
     * Get fechaUpdate
     *
     * @return \DateTime
     */
    public function getFechaUpdate()
    {
        return $this->fechaUpdate;
    }

    /**
     * Set usuarioInsert
     *
     * @param integer $usuarioInsert
     *
     * @return User
     */
    public function setUsuarioInsert($usuarioInsert)
    {
        $this->usuarioInsert = $usuarioInsert;

        return $this;
    }

    /**
     * Get usuarioInsert
     *
     * @return int
     */
    public function getUsuarioInsert()
    {
        return $this->usuarioInsert;
    }

    /**
     * Set usuarioUpdate
     *
     * @param integer $usuarioUpdate
     *
     * @return User
     */
    public function setUsuarioUpdate($usuarioUpdate)
    {
        $this->usuarioUpdate = $usuarioUpdate;

        return $this;
    }

    /**
     * Get usuarioUpdate
     *
     * @return int
     */
    public function getUsuarioUpdate()
    {
        return $this->usuarioUpdate;
    }
    

    /**
     * Set tipoContenido
     *
     * @param integer $tipoContenido
     *
     * @return TipoContenido
     */
    public function setTipoContenido($tipoContenido)
    {
        $this->tipoContenido = $tipoContenido;

        return $this;
    }

    /**
     * Get tipoContenido
     *
     * @return int
     */
    public function getTipoContenido()
    {
        return $this->tipoContenido;
    }
    
    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return News
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }
    
    public function __construct() {
        $this->date = new \DateTime();
    }
}
