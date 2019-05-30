<?php
/**
 * Created by PhpStorm.
 * User: Maha
 * Date: 16/04/2019
 * Time: 18:05
 */

namespace ProfilBundle\Controller;


use ProfilBundle\Entity\contact;
use ProfilBundle\Entity\User;
use ProfilBundle\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class ContactController extends Controller
{
 public function ajoutcontactaction(Request $request,$id){

 }
    public function contactafficheAction(Request $request,$id) {


        $apropos = $this->getDoctrine()->getRepository(User::class)->findBy(array('id'=>$id));

        $contact = new contact();

        $form = $this->createForm(ContactType::class,$contact);

        $form->handleRequest($request);

        $em=$this->getDoctrine()->getManager();
        if($form->isSubmitted() && $form->isValid())
        {
            $contact->setIduserEnvoyer($this->getUser());
            $contact->setIduserRecepteur($apropos[0]);
            $em->persist($contact);
            $em->flush();
            return $this->redirectToRoute('Afficher_freelancer',array('id'=>$id));
        }
        $p= $em->getRepository(contact::class)->findBy(array('iduser_recepteur'=>$apropos));

        return $this->render('ProfilBundle:Profil:afficherFreelancer.html.twig',array('user'=>$apropos,'form'=>$form->createView()));
    }
    public function jsonContactAction($id)
    {
        $tasks6=$this->getDoctrine()->getManager()->getRepository('ProfilBundle:contact')->findByIduserrecepteur($id);
        $serializer=new Serializer([new ObjectNormalizer()]);
        $formated6=$serializer->normalize($tasks6);
        return new JsonResponse($formated6);

    }
}