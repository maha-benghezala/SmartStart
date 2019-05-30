<?php

namespace ProfilBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Certification
 *
 * @ORM\Table(name="certification")
 * @ORM\Entity(repositoryClass="ProfilBundle\Repository\CertifcationRepository")
 */
class Certification
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
     * @ORM\Column(name="nomcertif", type="string", length=255)
     */
    private $nomcertif;

    /**
     * @var string
     *
     * @ORM\Column(name="organisme", type="string", length=255)
     */
    private $organisme;

    /**
     * @var string
     *
     * @ORM\Column(name="moisd", type="string", length=255)
     */
    private $moisdebut;

    /**
     * @var string
     *
     * @ORM\Column(name="moisf", type="string", length=255)
     */
    private $moisfin;

    /**
     * @var int
     *
     * @ORM\Column(name="anneed", type="integer")
     */
    private $anneedebut;

    /**
     * @var int
     *
     * @ORM\Column(name="anneef", type="integer")
     */
    private $anneefin;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=255)
     */
    private $url;
    /**
     * @ORM\ManyToOne(targetEntity="ProfilBundle\Entity\User")
     * @ORM\JoinColumn(name="id_user",referencedColumnName="id")
     */
    private $iduser;

    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nomcertif.
     *
     * @param string $nomcertif
     *
     * @return Certification
     */
    public function setNomcertif($nomcertif)
    {
        $this->nomcertif = $nomcertif;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getIduser()
    {
        return $this->iduser;
    }

    /**
     * @param mixed $iduser
     */
    public function setIduser($iduser)
    {
        $this->iduser = $iduser;
    }

    /**
     * Get nomcertif.
     *
     * @return string
     */
    public function getNomcertif()
    {
        return $this->nomcertif;
    }

    /**
     * Set organisme.
     *
     * @param string $organisme
     *
     * @return Certification
     */
    public function setOrganisme($organisme)
    {
        $this->organisme = $organisme;

        return $this;
    }

    /**
     * Get organisme.
     *
     * @return string
     */
    public function getOrganisme()
    {
        return $this->organisme;
    }

    /**
     * Set moisdebut.
     *
     * @param string $moisdebut
     *
     * @return Certification
     */
    public function setMoisdebut($moisdebut)
    {
        $this->moisdebut = $moisdebut;

        return $this;
    }

    /**
     * Get moisdebut.
     *
     * @return string
     */
    public function getMoisdebut()
    {
        return $this->moisdebut;
    }

    /**
     * Set moisfin.
     *
     * @param string $moisfin
     *
     * @return Certification
     */
    public function setMoisfin($moisfin)
    {
        $this->moisfin = $moisfin;

        return $this;
    }

    /**
     * Get moisfin.
     *
     * @return string
     */
    public function getMoisfin()
    {
        return $this->moisfin;
    }

    /**
     * Set anneedebut.
     *
     * @param int $anneedebut
     *
     * @return Certification
     */
    public function setAnneedebut($anneedebut)
    {
        $this->anneedebut = $anneedebut;

        return $this;
    }

    /**
     * Get anneedebut.
     *
     * @return int
     */
    public function getAnneedebut()
    {
        return $this->anneedebut;
    }

    /**
     * Set anneefin.
     *
     * @param int $anneefin
     *
     * @return Certification
     */
    public function setAnneefin($anneefin)
    {
        $this->anneefin = $anneefin;

        return $this;
    }

    /**
     * Get anneefin.
     *
     * @return int
     */
    public function getAnneefin()
    {
        return $this->anneefin;
    }

    /**
     * Set url.
     *
     * @param string $url
     *
     * @return Certification
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url.
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }
}
