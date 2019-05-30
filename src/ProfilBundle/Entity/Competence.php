<?php

namespace ProfilBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Competence
 *
 * @ORM\Table(name="competence")
 * @ORM\Entity(repositoryClass="ProfilBundle\Repository\CompetenceRepository")
 */
class Competence
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
     * @ORM\ManyToOne(targetEntity="ProfilBundle\Entity\User")
     * @ORM\JoinColumn(name="id_user",referencedColumnName="id")
     */
    private $iduser;
    /**
     * @var string
     *
     * @ORM\Column(name="nomcompetence", type="string", length=255)
     */
    private $nomcompetence;


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
     * Set nomcompetence.
     *
     * @param string $nomcompetence
     *
     * @return Competence
     */
    public function setNomcompetence($nomcompetence)
    {
        $this->nomcompetence = $nomcompetence;

        return $this;
    }

    /**
     * Get nomcompetence.
     *
     * @return string
     */
    public function getNomcompetence()
    {
        return $this->nomcompetence;
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
