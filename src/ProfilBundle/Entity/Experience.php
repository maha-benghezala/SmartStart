<?php

namespace ProfilBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Experience
 *
 * @ORM\Table(name="experience")
 * @ORM\Entity(repositoryClass="ProfilBundle\Repository\ExperienceRepository")
 */
class Experience
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
     * @ORM\Column(name="intituleposte", type="string", length=255)
     */
    private $intituleposte;

    /**
     * @var string
     *
     * @ORM\Column(name="nomentreprise", type="string", length=255)
     */
    private $nomentreprise;

    /**
     * @var string
     *
     * @ORM\Column(name="lieu", type="string", length=255)
     */
    private $lieu;



    /**
     * @var int
     *
     * @ORM\Column(name="anneedebut",type="integer")
     */
    private $anneedebut;

    /**
     * @var int
     *
     * @ORM\Column(name="anneefin",type="integer",nullable=true)
     */
    private $anneefin;

    /**
     * @var string
     *
     * @ORM\Column(name="secteur", type="string", length=255)
     */
    private $secteur;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

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
     * Set intituleposte.
     *
     * @param string $intituleposte
     *
     * @return Experience
     */
    public function setIntituleposte($intituleposte)
    {
        $this->intituleposte = $intituleposte;

        return $this;
    }

    /**
     * Get intituleposte.
     *
     * @return string
     */
    public function getIntituleposte()
    {
        return $this->intituleposte;
    }

    /**
     * Set nomentreprise.
     *
     * @param string $nomentreprise
     *
     * @return Experience
     */
    public function setNomentreprise($nomentreprise)
    {
        $this->nomentreprise = $nomentreprise;

        return $this;
    }

    /**
     * Get nomentreprise.
     *
     * @return string
     */
    public function getNomentreprise()
    {
        return $this->nomentreprise;
    }

    /**
     * Set lieu.
     *
     * @param string $lieu
     *
     * @return Experience
     */
    public function setLieu($lieu)
    {
        $this->lieu = $lieu;

        return $this;
    }

    /**
     * Get lieu.
     *
     * @return string
     */
    public function getLieu()
    {
        return $this->lieu;
    }

    /**
     * @return int
     */
    public function getAnneedebut()
    {
        return $this->anneedebut;
    }

    /**
     * @param int $anneedebut
     */
    public function setAnneedebut($anneedebut)
    {
        $this->anneedebut = $anneedebut;
    }

    /**
     * @return int
     */
    public function getAnneefin()
    {
        return $this->anneefin;
    }

    /**
     * @param int $anneefin
     */
    public function setAnneefin($anneefin)
    {
        $this->anneefin = $anneefin;
    }


    /**
     * Set secteur.
     *
     * @param string $secteur
     *
     * @return Experience
     */
    public function setSecteur($secteur)
    {
        $this->secteur = $secteur;

        return $this;
    }

    /**
     * Get secteur.
     *
     * @return string
     */
    public function getSecteur()
    {
        return $this->secteur;
    }

    /**
     * Set description.
     *
     * @param string $description
     *
     * @return Experience
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description.
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
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




}
