<?php

namespace EvenementBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Event
 *
 * @ORM\Table(name="event")
 * @ORM\Entity(repositoryClass="EvenementBundle\Repository\EventRepository")
 */
class Event
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
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="dateorgaisation", type="string", length=255)
     */
    private $dateorgaisation;

    /**
     * @var string
     *
     * @ORM\Column(name="capacite", type="string", length=255)
     */
    private $capacite;

    /**
     * @var string
     *
     * @ORM\Column(name="localisation", type="string", length=255)
     */
    private $localisation;

    /**
     * @var int
     *
     * @ORM\Column(name="fraisparticipation", type="integer")
     */
    private $fraisparticipation;


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
     * Set nom.
     *
     * @param string $nom
     *
     * @return Event
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom.
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set dateorgaisation.
     *
     * @param string $dateorgaisation
     *
     * @return Event
     */
    public function setDateorgaisation($dateorgaisation)
    {
        $this->dateorgaisation = $dateorgaisation;

        return $this;
    }

    /**
     * Get dateorgaisation.
     *
     * @return string
     */
    public function getDateorgaisation()
    {
        return $this->dateorgaisation;
    }

    /**
     * Set capacite.
     *
     * @param string $capacite
     *
     * @return Event
     */
    public function setCapacite($capacite)
    {
        $this->capacite = $capacite;

        return $this;
    }

    /**
     * Get capacite.
     *
     * @return string
     */
    public function getCapacite()
    {
        return $this->capacite;
    }

    /**
     * Set localisation.
     *
     * @param string $localisation
     *
     * @return Event
     */
    public function setLocalisation($localisation)
    {
        $this->localisation = $localisation;

        return $this;
    }

    /**
     * Get localisation.
     *
     * @return string
     */
    public function getLocalisation()
    {
        return $this->localisation;
    }

    /**
     * Set fraisparticipation.
     *
     * @param int $fraisparticipation
     *
     * @return Event
     */
    public function setFraisparticipation($fraisparticipation)
    {
        $this->fraisparticipation = $fraisparticipation;

        return $this;
    }

    /**
     * Get fraisparticipation.
     *
     * @return int
     */
    public function getFraisparticipation()
    {
        return $this->fraisparticipation;
    }
}
