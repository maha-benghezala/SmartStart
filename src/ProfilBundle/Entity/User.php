<?php
/**
 * Created by PhpStorm.
 * User: Maha
 * Date: 08/03/2019
 * Time: 11:13
 */

namespace ProfilBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    /**
     * @ORM\ManyToMany(targetEntity="Abonnement", cascade={"persist"})
     */
    private $friend;

    public function __construct()
    {
        parent::__construct();
        // your own logic
    }
    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255, nullable=true)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=255, nullable=true)
     */
    private $prenom;
    /**
     * @var integer
     *
     * @ORM\Column(name="tel", type="integer", nullable=true)
     */
    private $telephone;
    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="string", length=255, nullable=true)
     */
    private $adresse;
    /**
     * @var string
     *
     * @ORM\Column(name="nomSC", type="string", length=255, nullable=true)
     */
    private $nomsc;
    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=255, nullable=true)
     */
    private $image;
    /**
     * @var string
     *
     * @ORM\Column(name="specialite", type="string", length=255, nullable=true)
     */
    private $specialite;


    /**
     *
     * @var string
     *
     * @ORM\Column(name="poste", type="string", length=255, nullable=true)
     */
    private $poste;
    /**
     * @var string
     *
     * @ORM\Column(name="ville", type="string", length=255, nullable=true)
     */
    private $ville;
    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=true)
     */
    private $description;
    /**
     * @var string
     *
     * @ORM\Column(name="visible", type="string", length=255, nullable=true)
     */
    private $visible;
    /**
     * @var string
     *
     * @ORM\Column(name="disponible", type="string", length=255, nullable=true)
     */
    private $disponible;
    /**
     * @var string
     *
     * @ORM\Column(name="cv", type="string", length=255, nullable=true)
     */
    private $cv;
    /**
     * @return string
     */

    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * @param string $adresse
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;
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
    public function getFriend()
    {
        return $this->friend;
    }

    /**
     * @param mixed $friend
     */
    public function setFriend($friend)
    {
        $this->friend = $friend;
    }


    /**
     * @return string
     */
    public function getDisponible()
    {
        return $this->disponible;
    }

    /**
     * @param string $disponible
     */
    public function setDisponible($disponible)
    {
        $this->disponible = $disponible;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * @param string $prenom
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }

    /**
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param string $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }

    /**
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param string $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    /**
     * @return string
     */
    public function getNomsc()
    {
        return $this->nomsc;
    }

    /**
     * @param string $nomsc
     */
    public function setNomsc($nomsc)
    {
        $this->nomsc = $nomsc;
    }

    /**
     * @return int
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * @param int $telephone
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;
    }

    /**
     * @return string
     */
    public function getSpecialite()
    {
        return $this->specialite;
    }

    /**
     * @param string $specialite
     */
    public function setSpecialite($specialite)
    {
        $this->specialite = $specialite;
    }

    /**
     * @return string
     */
    public function getPoste()
    {
        return $this->poste;
    }

    /**
     * @param string $poste
     */
    public function setPoste($poste)
    {
        $this->poste = $poste;
    }

    /**
     * @return string
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * @param string $ville
     */
    public function setVille($ville)
    {
        $this->ville = $ville;
    }

    /**
     * @return string
     */
    public function getVisible()
    {
        return $this->visible;
    }

    /**
     * @param string $visible
     */
    public function setVisible($visible)
    {
        $this->visible = $visible;
    }
    /**
     * Add friend
     *
     * @param \ProfilBundle\Entity\Abonnement  $friend
     *
     * @return User
     */
    public function addFriend(\ProfilBundle\Entity\Abonnement $friend)
    {
        $this->friend[] = $friend;
        return $this;
    }
    /**
     * Remove friend
     *
     * @param \ProfilBundle\Entity\Abonnement $friend
     */
    public function removeFriend(\ProfilBundle\Entity\Abonnement $friend)
    {
        $this->friend->removeElement($friend);
    }

    /**
     * @return string
     */
    public function getCv()
    {
        return $this->cv;
    }

    /**
     * @param string $cv
     */
    public function setCv($cv)
    {
        $this->cv = $cv;
    }

    /**
     * Get friends
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFriends()
    {
        return $this->friend;
    }


}