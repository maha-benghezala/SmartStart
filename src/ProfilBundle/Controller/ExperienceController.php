<?php

namespace ProfilBundle\Controller;

use ProfilBundle\Entity\Experience;
use ProfilBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ExperienceController extends Controller
{
    public function AjouterExperienceAction(Request $request)
    {
        $experience = new Experience();

        $em = $this->getDoctrine()->getManager();

        $user = $this->getUser();


        $experience->setIdUser($user);

        $experience->setIntituleposte($request->get("poste"));
        $experience->setNomentreprise($request->get("entreprise"));
        $experience->setLieu($request->get("lieu"));
        $experience->setAnneedebut($request->get("anneedebut"));
        $experience->setAnneefin($request->get("anneefin"));
        $experience->setSecteur($request->get("secteur"));
        $experience->setDescription($request->get("description"));
        $em->persist($experience);
        // ajouter les donnee ala bd
        $em->flush();
        return new Response("success");


    }
    public function updateexperienceAction(Request $request, $id)
    {


        $em = $this->getDoctrine()->getManager();
        $experience = $this->getDoctrine()
            ->getRepository(Experience::class)
            ->find($id);
        $user = $this->getUser();


        $experience->getIdUser($user);

        $experience->setIntituleposte($request->get("poste"));
        $experience->setNomentreprise($request->get("entreprise"));
        $experience->setLieu($request->get("lieu"));
        $experience->setAnneedebut($request->get("anneedebut"));
        $experience->setAnneefin($request->get("anneefin"));
        $experience->setSecteur($request->get("secteur"));
        $experience->setDescription($request->get("description"));

        $em->persist($experience);
        // ajouter les donnee ala bd
        $em->flush();
        return new Response("success");


    }
    public function DeleteExperienceAction($id)
    {
        $em = $this->getDoctrine()->getManager();


        $experience = $this->getDoctrine()->getRepository('ProfilBundle:Experience')->find($id);


        $em->remove($experience);
        $em->flush();
        return $this->redirectToRoute('profil',array('id'=>$this->getUser()->getId()));
    }
    public function AjouterExperienceWSAction(Request $request)
    {
        $experience = new Experience();

        $em = $this->getDoctrine()->getManager();

        $user = $this->getDoctrine()->getRepository(User::class)->find(3);

        $experience->setIdUser($user);

        $experience->setIntituleposte($request->get("poste"));
        $experience->setNomentreprise($request->get("entreprise"));
        $experience->setLieu($request->get("lieu"));
        $experience->setAnneedebut($request->get("anneedebut"));
        if($request->get("anneefin")!="") {
            $experience->setAnneefin($request->get("anneefin"));
        }
        $experience->setSecteur($request->get("secteur"));
        $experience->setDescription($request->get("description"));
        $em->persist($experience);
        // ajouter les donnee ala bd
        $em->flush();
        return new Response("success");


    }
    public function updateexperienceWSAction(Request $request)
    {


        $em = $this->getDoctrine()->getManager();
        $experience = $this->getDoctrine()
            ->getRepository(Experience::class)
            ->find($request->get('id'));


        $experience->setIntituleposte($request->get("poste"));
        $experience->setNomentreprise($request->get("entreprise"));
        $experience->setLieu($request->get("lieu"));
        $experience->setAnneedebut($request->get("anneedebut"));
        if($request->get("anneefin")!="") {
        $experience->setAnneefin($request->get("anneefin"));}
        $experience->setSecteur($request->get("secteur"));
        $experience->setDescription($request->get("description"));

        $em->persist($experience);
        // ajouter les donnee ala bd
        $em->flush();
        return new Response("success");


    }
    public function DeleteExperienceWSAction($id)
    {
        $em = $this->getDoctrine()->getManager();


        $experience = $this->getDoctrine()->getRepository('ProfilBundle:Experience')->find($id);


        $em->remove($experience);
        $em->flush();
        return new Response("success");
    }



}
