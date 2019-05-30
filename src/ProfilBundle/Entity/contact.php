<?php

namespace ProfilBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * contact
 *
 * @ORM\Table(name="contact")
 * @ORM\Entity(repositoryClass="ProfilBundle\Repository\contactRepository")
 */
class contact
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
     * @ORM\Column(name="email", type="string", length=255)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="message", type="string", length=255)
     */
    private $message;
    /**
     * @ORM\ManyToOne(targetEntity="ProfilBundle\Entity\User")
     * @ORM\JoinColumn(name="id_user_recepteur",referencedColumnName="id")
     */
    private $iduserrecepteur;
    /**
     * @ORM\ManyToOne(targetEntity="ProfilBundle\Entity\User")
     * @ORM\JoinColumn(name="id_user_envoyer",referencedColumnName="id")
     */
    private $iduserenvoyer;

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
     * Set email.
     *
     * @param string $email
     *
     * @return contact
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email.
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set message.
     *
     * @param string $message
     *
     * @return contact
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get message.
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @return mixed
     */
    public function getIduserrecepteur()
    {
        return $this->iduserrecepteur;
    }

    /**
     * @param mixed $iduserrecepteur
     */
    public function setIduserrecepteur($iduserrecepteur)
    {
        $this->iduserrecepteur = $iduserrecepteur;
    }

    /**
     * @return mixed
     */
    public function getIduserenvoyer()
    {
        return $this->iduserenvoyer;
    }

    /**
     * @param mixed $iduserenvoyer
     */
    public function setIduserenvoyer($iduserenvoyer)
    {
        $this->iduserenvoyer = $iduserenvoyer;
    }







}
