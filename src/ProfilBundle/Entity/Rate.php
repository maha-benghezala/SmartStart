<?php

namespace ProfilBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Rate
 *
 * @ORM\Table(name="rate")
 * @ORM\Entity(repositoryClass="ProfilBundle\Repository\RateRepository")
 */
class Rate
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
     * @ORM\Column(name="commantaire", type="string", length=255)
     */
    private $commantaire;

    /**
     * @var float
     *
     * @ORM\Column(name="avis", type="float")
     */
    private $avis;

    /**
     * @ORM\ManyToOne(targetEntity="ProfilBundle\Entity\User")
     * @ORM\JoinColumn(name="id_user",referencedColumnName="id")
     */
    private $iduser;
    /**
     * @ORM\ManyToOne(targetEntity="ProfilBundle\Entity\User")
     * @ORM\JoinColumn(name="id_user_rated",referencedColumnName="id")
     */
    private $iduser_rated;
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
     * Set commantaire.
     *
     * @param string $commantaire
     *
     * @return Rate
     */
    public function setCommantaire($commantaire)
    {
        $this->commantaire = $commantaire;

        return $this;
    }

    /**
     * Get commantaire.
     *
     * @return string
     */
    public function getCommantaire()
    {
        return $this->commantaire;
    }

    /**
     * Set avis.
     *
     * @param float $avis
     *
     * @return Rate
     */
    public function setAvis($avis)
    {
        $this->avis = $avis;

        return $this;
    }

    /**
     * Get avis.
     *
     * @return float
     */
    public function getAvis()
    {
        return $this->avis;
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
     * @return mixed
     */
    public function getIduserRated()
    {
        return $this->iduser_rated;
    }

    /**
     * @param mixed $iduser_rated
     */
    public function setIduserRated($iduser_rated)
    {
        $this->iduser_rated = $iduser_rated;
    }


}
