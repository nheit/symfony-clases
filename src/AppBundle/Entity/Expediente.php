<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
/**

 * @ORM\Table(name="expediente")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ExpedienteRepository")
 */
class Expediente {
    /**
    * @ORM\Column(type="integer")
    * @ORM\Id
    * @ORM\GeneratedValue(strategy="AUTO")
    */
    private $id;
    /**
    * @ORM\Column(type="integer", name="numero")
    */
    private $numero;
    /**
    * @ORM\Column(type="integer", name="anio")
    */
    private $anio;
    /**
    * @ORM\Column(type="string", name="caratula")
    */
    private $caratula;
    
    function getId() {
        return $this->id;
    }

    function getNumero() {
        return $this->numero;
    }

    function getAnio() {
        return $this->anio;
    }

    function getCaratula() {
        return $this->caratula;
    }

    function setId($id) {
        $this->id = $id;
        return $this;
    }

    function setNumero($numero) {
        $this->numero = $numero;
        return $this;
    }

    function setAnio($anio) {
        $this->anio = $anio;
        return $this;
    }

    function setCaratula($caratula) {
        $this->caratula = $caratula;
        return $this;
    }
}
