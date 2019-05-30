<?php

namespace ProfilBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * formation
 *
 * @ORM\Table(name="formation")
 * @ORM\Entity(repositoryClass="ProfilBundle\Repository\formationRepository")
 */
class formation
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
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @ORM\ManyToOne(targetEntity="ProfilBundle\Entity\User")
     * @ORM\JoinColumn(name="id_user",referencedColumnName="id")
     */
    private $iduser;

    /**
     * @var string
     *
     * @ORM\Column(name="nomecole", type="string", length=255, nullable=true)
     */
    private $nomecole;
    /**
     * @var string
     *
     * @ORM\Column(name="domaine", type="string", length=255, nullable=true)
     */
    private $domaine;
    /**
     * @var int
     *
     * @ORM\Column(name="anneediplome", type="integer", length=4, nullable=true)
     */
    private $anneediplome;
    /**
 * @var string
 *
 * @ORM\Column(name="diplome", type="string", length=255, nullable=true)
 */
    private $diplome;
    /**
 * @var string
 *
 * @ORM\Column(name="description", type="string", length=255, nullable=true)
 */
    private $description;



    /**
     * @return string
     */
    public function getNomecole()
    {
        return $this->nomecole;
    }

    /**
     * @param string $nomecole
     */
    public function setNomecole($nomecole)
    {
        $this->nomecole = $nomecole;
    }


    /**
     * @return string
     */
    public function getDomaine()
    {
        return $this->domaine;
    }

    /**
     * @param string $domaine
     */
    public function setDomaine($domaine)
    {
        $this->domaine = $domaine;
    }




    /**
     * @return string
     */
    public function getDiplome()
    {
        return $this->diplome;
    }

    /**
     * @param string $diplome
     */
    public function setDiplome($diplome)
    {
        $this->diplome = $diplome;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
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
     * @return int
     */
    public function getAnneediplome()
    {
        return $this->anneediplome;
    }

    /**
     * @param int $anneediplome
     */
    public function setAnneediplome($anneediplome)
    {
        $this->anneediplome = $anneediplome;
    }



}
