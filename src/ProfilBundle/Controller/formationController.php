<?php

namespace ProfilBundle\Controller;

use Doctrine\DBAL\Types\TextType;
use FOS\UserBundle\Model\UserInterface;
use ProfilBundle\Entity\formation;
use ProfilBundle\Entity\User;
use ProfilBundle\Form\formationType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Constraints\DateTime;

class formationController extends Controller
{
    public function AjouterformationAction(Request $request)
    {
        $formation = new formation();

        $em = $this->getDoctrine()->getManager();

        $user = $this->getUser();


        $formation->setIdUser($user);

        $formation->setNomecole($request->get("nomecole"));
        $formation->setDomaine($request->get("domaine"));
        $formation->setAnneediplome($request->get("anneediplome"));
        $formation->setDiplome($request->get("diplome"));

        $formation->setDescription($request->get("description"));
        $em->persist($formation);
        // ajouter les donnee ala bd
        $em->flush();
        return new Response("success");


    }

    /* public function viewEducationAction($id) {


         $user=$this->getDoctrine()->getRepository('ProfilBundle:User')
             ->find($id);
         $formation =$this->getDoctrine()->getRepository('ProfilBundle:formation')
             ->findByUser($user);
         return $this->render('ProfilBundle:Apropos:Apropos.html.twig',array('formation'=>$formation,'id'=>$id));


     }*/
    public function updateformationAction(Request $request, $id)
    {


        $em = $this->getDoctrine()->getManager();
        $formation = $this->getDoctrine()
            ->getRepository('ProfilBundle:formation')
            ->find($id);
        $user = $this->getUser();


        $formation->getIdUser($user);

        $formation->setNomecole($request->get("nomecole"));
        $formation->setDomaine($request->get("domaine"));
        $formation->setAnneediplome($request->get("anneediplome"));
        $formation->setDiplome($request->get("diplome"));

        $formation->setDescription($request->get("description"));
        $em->persist($formation);
        // ajouter les donnee ala bd
        $em->flush();
        return new Response("success");


    }

    public function DeleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();


        $formation = $this->getDoctrine()->getRepository('ProfilBundle:formation')->find($id);


        $em->remove($formation);
        $em->flush();
        return $this->redirectToRoute('profil');
    }
    public function AjouterformationWSAction(Request $request)
    {
        $formation = new formation();

        $em = $this->getDoctrine()->getManager();

        $user = $this->getDoctrine()->getRepository(User::class)->find(3);


        $formation->setIdUser($user);

        $formation->setNomecole($request->get("nomecole"));
        $formation->setDomaine($request->get("domaine"));
        $formation->setAnneediplome($request->get("anneediplome"));
        $formation->setDiplome($request->get("diplome"));

        $formation->setDescription($request->get("description"));
        $em->persist($formation);
        // ajouter les donnee ala bd
        $em->flush();
        return new Response("success");


    }
    public function updateformationWSAction(Request $request)
    {


        $em = $this->getDoctrine()->getManager();
        $formation = $this->getDoctrine()
            ->getRepository('ProfilBundle:formation')
            ->find($request->get('id'));
        $user = $this->getDoctrine()->getRepository(User::class)->find(3);


        $formation->getIdUser($user);

        $formation->setNomecole($request->get("nomecole"));
        $formation->setDomaine($request->get("domaine"));
        $formation->setAnneediplome($request->get("anneediplome"));
        $formation->setDiplome($request->get("diplome"));

        $formation->setDescription($request->get("description"));
        $em->persist($formation);
        // ajouter les donnee ala bd
        $em->flush();
        return new Response("success");


    }
    public function DeleteWSAction($id)
    {
        $em = $this->getDoctrine()->getManager();


        $formation = $this->getDoctrine()->getRepository('ProfilBundle:formation')->find($id);


        $em->remove($formation);
        $em->flush();
        return new Response("success");
    }

}
