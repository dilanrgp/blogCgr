<?php

namespace CGR\DGTI\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * TipoContenido
 *
 * @ORM\Table(name="tipo_contenido")
 * @ORM\Entity(repositoryClass="CGR\DGTI\BlogBundle\Repository\TipoContenidoRepository")
 */
class TipoContenido {

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
     * @ORM\Column(name="descripcion", type="string", length=255)
     */
    private $descripcion;

    /**
     * @var bool
     *
     * @ORM\Column(name="publicado", type="boolean")
     */
    private $publicado;

    /**
     * One TipoContenido has Many News.
     * @ORM\OneToMany(targetEntity="News", mappedBy="tipoContenido")
     */
    private $noticias;

    public function __construct() {
        $this->noticias = new ArrayCollection();
    }
    
    public function __toString() {
        return $this->descripcion ;
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set titulo
     *
     * @param string $titulo
     *
     * @return TipoContenido
     */
    public function setTitulo($titulo) {
        $this->titulo = $titulo;

        return $this;
    }

    /**
     * Get titulo
     *
     * @return string
     */
    public function getTitulo() {
        return $this->titulo;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return TipoContenido
     */
    public function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string
     */
    public function getDescripcion() {
        return $this->descripcion;
    }

    /**
     * Set publicado
     *
     * @param boolean $publicado
     *
     * @return TipoContenido
     */
    public function setPublicado($publicado) {
        $this->publicado = $publicado;

        return $this;
    }

    /**
     * Get publicado
     *
     * @return bool
     */
    public function getPublicado() {
        return $this->publicado;
    }

}
