<?php

namespace ProfilBundle\Controller;

use Knp\Bundle\SnappyBundle\Snappy\Response\PdfResponse;
use Knp\Snappy\Pdf;
use ProfilBundle\Entity\Abonnement;
use ProfilBundle\Entity\Certification;
use ProfilBundle\Entity\Competence;
use ProfilBundle\Entity\contact;
use ProfilBundle\Entity\Experience;
use ProfilBundle\Entity\formation;
use ProfilBundle\Entity\Langue;
use ProfilBundle\Entity\Rate;
use ProfilBundle\Entity\User;
use ProfilBundle\Form\ContactType;
use ProfilBundle\Form\formationType;
use ProfilBundle\Form\ImageType;
use ProfilBundle\Form\ReviewType;
use ProfilBundle\Form\uploadType;
use ProfilBundle\ProfilBundle;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\ResetType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class AproposController extends Controller
{
    public function indexAction(Request $request)
    {
        return $this->render('ProfilBundle:Profil:Apropos.html.twig');

    }

    public function viewAction(Request $request) {

       $user=$this->getUser();
       $id=$user->getId();

        $i =0;
        $form=$this->createForm(ImageType::class,$user);
        $apropos = $this->getDoctrine()->getRepository(User::class)->findBy(array('id'=>$id));
        foreach ($apropos as $a){
            $i=$i+1 ;
        }
        $formation = $this->getDoctrine()->getRepository(formation::class)->findAll();
        $exprience = $this->getDoctrine()->getRepository(Experience::class)->findAll();
        $certificat = $this->getDoctrine()->getRepository(Certification::class)->findAll();
        $langue= $this->getDoctrine()->getRepository(Langue::class)->findAll();
        $competence = $this->getDoctrine()->getRepository(Competence::class)->findAll();
        if (!$apropos){
            throw $this->createNotFoundException(
                'There are no user with the following : '
            );
        }
        $form->handleRequest($request);
        if($form ->isSubmitted()) {

            $file = $user->getImage();

            if ($file != null) {
                $fileName = md5(uniqid()) . '.' . $file->guessExtension();
                $path = "../web";
                $file->move($path, $fileName);
                $user->setImage($fileName);
            }

            $em = $this->getDoctrine()->getManager();

            $em->persist($user);

            $em->flush();
            return $this->redirectToRoute('profil');
        }
        else{
            return $this->render('ProfilBundle:Profil:Apropos.html.twig',
                array('user'=>$apropos,'i'=>$i,'formation' => $formation,'experience' => $exprience
                ,'certification'=>$certificat,'langue'=>$langue,'competence'=>$competence,'form'=>$form->createView()));
        }



    }

    public function updateAction(Request $request, $id) {

        $em = $this->getDoctrine()->getManager();
        $userr = $this->getDoctrine()
            ->getRepository('ProfilBundle:user')
            ->find($id);
        $user = $this->getUser();


        $userr->getId($user);

        $userr->setPrenom($request->get("Prenom"));
        $userr->setNom($request->get("nom"));
        $userr->setPoste($request->get("poste"));
        $userr->setAdresse($request->get("adresse"));
        $userr->setEmail($request->get("email"));
        $userr->setVille($request->get("ville"));
        $userr->setDescription($request->get("description"));
        $em->persist($userr);
        // ajouter les donnee ala bd
        $em->flush();
        return new Response("success");


    }
   /* public function deleteAction($id) {
        $em = $this->getDoctrine()->getManager();
        $article = $em->getRepository('AppBundle:Article')->find($id);
        if (!$article) {
            throw $this->createNotFoundException(
                'There are no articles with the following id: ' . $id
            );
        }
        $em->remove($article);
        $em->flush();
        return $this->redirect('/show-articles');
    }*/

    public function afficherformationAction(Request $request)
    {


        $em = $this->getDoctrine()->getManager();

        //$form = $em->getRepository('ProfilBundle\formation')->findAll();
        $formation = $this->getDoctrine()->getRepository(formation::class)->findAll();

        if($formation != null){

            return $this->render('ProfilBundle:Profil:Apropos.html.twig', array('formation' => $formation));

        }
        else {
            return new Response("hhhh");        }
    }
    public function PdfAction()
    {
        $user=$this->getUser();
        $id=$user->getId();
        $apropos = $this->getDoctrine()->getRepository(User::class)->findBy(array('id'=>$id));
        $formation = $this->getDoctrine()->getRepository(formation::class)->findAll();
        $exprience = $this->getDoctrine()->getRepository(Experience::class)->findAll();
        $certificat = $this->getDoctrine()->getRepository(Certification::class)->findAll();
        $langue= $this->getDoctrine()->getRepository(Langue::class)->findAll();
        $competence = $this->getDoctrine()->getRepository(Competence::class)->findAll();
        $name = $fileName = md5(uniqid());
        $html = $this->renderView('ProfilBundle:Profil:Pdf.html.twig',  array('user'=>$apropos,'formation' => $formation,'experience' => $exprience
        ,'certification'=>$certificat,'langue'=>$langue,'competence'=>$competence));

        return new PdfResponse(
            $this->get('knp_snappy.pdf')->getOutputFromHtml($html),
            $name.'.pdf'
        );
        /**$this->get('knp_snappy.pdf')->generateFromHtml(
            $this->renderView(
                'ProfilBundle:Profil:Pdf.html.twig',
                array('user'=>$apropos,'formation' => $formation,'experience' => $exprience
                ,'certification'=>$certificat,'langue'=>$langue,'competence'=>$competence)
            ),
            '../web/'.$name.'.pdf'
        );**/



    }

    public function uploadPdfAction(Request $request)
    {
        $user=$this->getUser();
        $form=$this->createForm(uploadType::class,$user);
        $form->handleRequest($request);
        if($form ->isSubmitted())
        {

            $file=$user->getCv();

            if($file != null)
            {
                $fileName = md5(uniqid()) . '.' . $file->guessExtension();
                $path="../web";
                $file->move($path ,$fileName);
                $user->setCv($fileName);
            }

            $em = $this->getDoctrine()->getManager();

            $em->persist($user);

            $em->flush();
            return $this->redirectToRoute('profil');
        }
        return $this->render('ProfilBundle:Profil:upload.html.twig', array('form' => $form->createView()));

    }
    public function dashEntrepriseAction(Request $request)

    {
        $user=$this->getUser();
        $id=$user->getId();
        $form=$this->createForm(ImageType::class,$user);
        $apropos = $this->getDoctrine()->getRepository(User::class)->findBy(array('id'=>$id));
        $form->handleRequest($request);
        if($form ->isSubmitted())
        {

            $file=$user->getImage();

            if($file != null)
            {
                $fileName = md5(uniqid()) . '.' . $file->guessExtension();
                $path="../web";
                $file->move($path ,$fileName);
                $user->setImage($fileName);
            }

            $em = $this->getDoctrine()->getManager();

            $em->persist($user);

            $em->flush();
            return $this->redirectToRoute('profil_entreprise');

        }
        else{
            return $this->render('ProfilBundle:Profil:dashboard_Entreprise.html.twig',
                array('userr'=>$apropos,'form'=>$form->createView()));
        }



    }
    public function afficherEntrepriseAction($id,Request $request) {


        $apropos = $this->getDoctrine()->getRepository(User::class)->findBy(array('id'=>$id));
        $avis = new Rate();
        $form = $this->createForm(ReviewType::class,$avis);
        $form->handleRequest($request);
        $em=$this->getDoctrine()->getManager();
        $contact=new contact();
        $form2 = $this->createForm(ContactType::class,$contact);
        $apropos = $this->getDoctrine()->getRepository(User::class)->findBy(array('id'=>$id));
        $form2->handleRequest($request);
        if ($form2->isSubmitted() && $form2->isValid()) {


            $contact->setIduserenvoyer($this->getUser());
            $contact->setIduserrecepteur($apropos[0]);
            $em = $this->getDoctrine()->getManager();
            $em->persist($contact);
            $em->flush();
        }
        if($form->isSubmitted() && $form->isValid())
        {




            $avis->setIdUser($this->getUser());
            $avis->setIduserRated($apropos[0]);
            $em->persist($avis);
            $em->flush();
            return $this->redirectToRoute('Afficher_entreprise',array('id'=>$id));
        }
        $p= $em->getRepository(Rate::class)->findBy(array('iduser_rated'=>$apropos));
        $somme =0 ;
        $moyenne = 0;
        if($p != null){
            foreach ($p as $rate){
                $somme = $somme + $rate->getAvis();
            }
            $moyenne = $somme / count($p);
        }


        return $this->render('ProfilBundle:Profil:afficherEntreprise.html.twig',array('userr'=>$apropos,'form'=>$form->createView(),'p'=>$moyenne,'form2'=>$form2->createView()));
    }
    public function updateEntrepriseAction(Request $request, $id) {

        $em = $this->getDoctrine()->getManager();
        $userr = $this->getDoctrine()
            ->getRepository('ProfilBundle:user')
            ->find($id);
        $user = $this->getUser();


        $userr->getId($user);


        $userr->setNomsc($request->get("nomsc"));
        $userr->setSpecialite($request->get("specialite"));
        $userr->setAdresse($request->get("adresse"));
        $userr->setEmail($request->get("email"));
        $userr->setDescription($request->get("description"));
        $em->persist($userr);
        // ajouter les donnee ala bd
        $em->flush();
        return new Response("success");


    }
    public function afficherFreelancerAction(Request $request,$id) {


        $apropos = $this->getDoctrine()->getRepository(User::class)->findBy(array('id'=>$id));
        $formation = $this->getDoctrine()->getRepository(formation::class)->findAll();
        $exprience = $this->getDoctrine()->getRepository(Experience::class)->findAll();
        $certificat = $this->getDoctrine()->getRepository(Certification::class)->findAll();
        $langue= $this->getDoctrine()->getRepository(Langue::class)->findAll();
        $competence = $this->getDoctrine()->getRepository(Competence::class)->findAll();

        $avis = new Rate();
        $contact=new contact();
        $form2 = $this->createForm(ContactType::class,$contact);
        $apropos = $this->getDoctrine()->getRepository(User::class)->findBy(array('id'=>$id));
        $form2->handleRequest($request);
        if ($form2->isSubmitted() && $form2->isValid()) {


            $contact->setIduserenvoyer($this->getUser());
            $contact->setIduserrecepteur($apropos[0]);
            $em = $this->getDoctrine()->getManager();
            $em->persist($contact);
            $em->flush();
        }


        $form = $this->createForm(ReviewType::class,$avis);

        $form->handleRequest($request);

        $em=$this->getDoctrine()->getManager();
        if($form->isSubmitted() && $form->isValid())
        {
            $avis->setIdUser($this->getUser());
            $avis->setIduserRated($apropos[0]);
            $em->persist($avis);
            $em->flush();
            return $this->redirectToRoute('Afficher_freelancer',array('id'=>$id));
        }
        $p= $em->getRepository(Rate::class)->findBy(array('iduser_rated'=>$apropos));
        $somme =0 ;
        $moyenne = 0;
        if($p != null){
            foreach ($p as $rate){
                $somme = $somme + $rate->getAvis();
            }
            $moyenne = $somme / count($p);
        }

        return $this->render('ProfilBundle:Profil:afficherFreelancer.html.twig',array('user'=>$apropos,'formation' => $formation,'experience' => $exprience
        ,'certification'=>$certificat,'langue'=>$langue,'competence'=>$competence,'form'=>$form->createView(),'p'=>$moyenne,'form2'=>$form2->createView()));
    }
    public function dashFreelancerAction(Request $request) {
        $apropos = $this->getDoctrine()->getRepository(User::class)->findAll();
        return $this->render('ProfilBundle:Profil:dashFreelancer.html.twig',array('user'=>$apropos));
    }
    public function dashEntreAction(Request $request) {
        return $this->render('ProfilBundle:Profil:dashboard.html.twig');
    }
    public function listeEntreAction(Request $request) {

        $apropos = $this->getDoctrine()->getRepository(User::class)->findAll();
        $abonnement = $this->getDoctrine()->getRepository(Abonnement::class)->findBy(array('iduser'=>$this->getUser()));
        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $apropos,
            $request->query->get('page', 1)/*le numéro de la page à afficher*/,
            5/*nbre d'éléments par page*/
        );


        return $this->render('ProfilBundle:Profil:ListeEntreprise.html.twig',array('user'=>$pagination,'abonnement'=>$abonnement));
    }
    public function listefreelancerAction(Request $request) {


        $apropos = $this->getDoctrine()->getRepository(User::class)->findAll();
        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $apropos,
            $request->query->get('page', 1)/*le numéro de la page à afficher*/,
            5/*nbre d'éléments par page*/
        );
        return $this->render('ProfilBundle:Profil:ListeFreelancer.html.twig',array('user'=>$pagination));
    }
    public function abonnerAction($id) {
        $entreprise = $this->getDoctrine()->getRepository(User::class)->find($id);
        $abonner=new Abonnement();
        $abonnements = $this->getDoctrine()
            ->getRepository('ProfilBundle:Abonnement')
            ->findBy(array('identreprise'=>$entreprise,'iduser'=>$this->getUser()));
        if($abonnements == null){
            $em=$this->getDoctrine()->getManager();
            $abonner->setIdentreprise($entreprise);
            $abonner->setIduser($this->getUser());
            $em->persist($abonner);
            $em->flush();
            return $this->redirectToRoute('Liste_entreprise');
        }
        else{
            echo('<script>alert("Vous Etes Déja Abonnée")</script>');
        }
    }
    public function messageAction() {
      $contact =$this->getDoctrine()->getRepository(contact::class)->findAll();

        return $this->render('ProfilBundle:Profil:message.html.twig',array('message'=>$contact));
    }
    public function showCVAction(){
        return $this->render('ProfilBundle:Profil:cv.html.twig');
    }
    public function jsonFormationAction($id)
    {

        $formation=$this->getDoctrine()->getManager()->getRepository('ProfilBundle:formation')->findByIduser($id);
        $encoders = array(new XmlEncoder(),new JsonEncoder());
        $normalizer = array(new ObjectNormalizer());
        $serializer = new Serializer($normalizer,$encoders);
        $json_object = $serializer->serialize(array('formation'=>$formation),'json');
        return new Response($json_object);


    }
    public function jsonExperienceAction($id)
    {

        $tasks1=$this->getDoctrine()->getManager()->getRepository('ProfilBundle:Experience')->findByIduser($id);
        $encoders = array(new XmlEncoder(),new JsonEncoder());
        $normalizer = new ObjectNormalizer();
        $normalizer->setCircularReferenceLimit(2);
// Add Circular reference handler
        $normalizer->setCircularReferenceHandler(function ($object) {
            return $object->getId();
        });
        $normalizers = array($normalizer);
        $serializer = new Serializer($normalizers,$encoders);
        $formatted = $serializer->normalize(['experience' => $tasks1]);
        return new JsonResponse($formatted);

    }
    public function jsonCertificationAction($id)
    {

        $tasks1=$this->getDoctrine()->getManager()->getRepository('ProfilBundle:Certification')->findByIduser($id);
        $encoders = array(new XmlEncoder(),new JsonEncoder());
        $normalizer = new ObjectNormalizer();
        $normalizer->setCircularReferenceLimit(2);
// Add Circular reference handler
        $normalizer->setCircularReferenceHandler(function ($object) {
            return $object->getId();
        });
        $normalizers = array($normalizer);
        $serializer = new Serializer($normalizers,$encoders);
        $formatted = $serializer->normalize(['certificat' => $tasks1]);
        return new JsonResponse($formatted);


    }
    public function jsonCompetenceAction($id)
    {

        $tasks3=$this->getDoctrine()->getManager()->getRepository('ProfilBundle:Competence')->findByIduser($id);

        $encoders = array(new XmlEncoder(),new JsonEncoder());
        $normalizer = array(new ObjectNormalizer());
        $serializer = new Serializer($normalizer,$encoders);
        $json_object = $serializer->serialize(array('competence'=>$tasks3),'json');
        return new Response($json_object);

    }
    public function jsonAbonnementAction($id)
    {

        $tasks4=$this->getDoctrine()->getManager()->getRepository('ProfilBundle:Abonnement')->findByIduser($id);
        $serializer=new Serializer([new ObjectNormalizer()]);
        $formated4=$serializer->normalize($tasks4);

        return new JsonResponse($formated4);

    }  public function jsonLangueAction($id)
{
    $tasks5=$this->getDoctrine()->getManager()->getRepository('ProfilBundle:Langue')->findByIduser($id);

    $encoders = array(new XmlEncoder(),new JsonEncoder());
    $normalizer = array(new ObjectNormalizer());
    $serializer = new Serializer($normalizer,$encoders);
    $json_object = $serializer->serialize(array('langue'=>$tasks5),'json');
    return new Response($json_object);

}
    public function jsonRateAction($id)
    {
        $tasks6=$this->getDoctrine()->getManager()->getRepository('ProfilBundle:Rate')->findByIduser($id);
        $serializer=new Serializer([new ObjectNormalizer()]);
        $formated6=$serializer->normalize($tasks6);
        return new JsonResponse($formated6);

    }
    public function viewWSAction() {

        $tasks5=$this->getDoctrine()->getManager()->getRepository('ProfilBundle:User')->find('3');

        $encoders = array(new XmlEncoder(),new JsonEncoder());
        $normalizer = array(new ObjectNormalizer());
        $serializer = new Serializer($normalizer,$encoders);
        $json_object = $serializer->serialize(array('user'=>$tasks5),'json');
        return new Response($json_object);
   }

    public function updateWSAction(Request $request) {

        $em = $this->getDoctrine()->getManager();
        $userr = $this->getDoctrine()
            ->getRepository('ProfilBundle:user')
            ->find($request->get('id'));


        $userr->setPrenom($request->get("Prenom"));
        $userr->setNom($request->get("nom"));
        $userr->setPoste($request->get("poste"));
        $userr->setAdresse($request->get("adresse"));
        $userr->setEmail($request->get("email"));
        $userr->setVille($request->get("ville"));
        $userr->setDescription($request->get("description"));
        $em->persist($userr);
        // ajouter les donnee ala bd
        $em->flush();
        return new Response("success");


    }
    public function listeEntreWSAction() {
        $user = $this->getDoctrine()->getRepository(User::class)->findAll();
        $entreprise = [];
        foreach ($user as $u){
            foreach ($u->getRoles() as $r){
                if($r =="ROLE_ENTREPRISE"){
                    array_push($entreprise,$u);
                }
            }
        }
        $encoders = array(new XmlEncoder(),new JsonEncoder());
        $normalizer = array(new ObjectNormalizer());
        $serializer = new Serializer($normalizer,$encoders);
        $json_object = $serializer->serialize(array('entreprise'=>$entreprise),'json');
        return new Response($json_object);



    }
    public function listefreelancerWSAction(Request $request) {


        $apropos = $this->getDoctrine()->getRepository(User::class)->findAll();
        $encoders = array(new XmlEncoder(),new JsonEncoder());
        $normalizer = array(new ObjectNormalizer());
        $serializer = new Serializer($normalizer,$encoders);
        $json_object = $serializer->serialize(array('freelancer'=>$apropos),'json');
        return new Response($json_object);

    }
    public function LogAction($username){
        $user = $this->getDoctrine()->getRepository(User::class)->findOneBy(array('username'=>$username));
        if($user != null){
            $encoders = array(new XmlEncoder(), new JsonEncoder());
            $normalizer = new ObjectNormalizer();
            $normalizer->setCircularReferenceLimit(0);
            // Add Circular reference handler
            $normalizer->setCircularReferenceHandler(function ($object) {
                return $object->getId();
            });
            $normalizers = array($normalizer);
            $serializer = new Serializer($normalizers, $encoders);

            return new \Symfony\Component\HttpFoundation\Response(
                $serializer->serialize($user,'json')
            );
        }
        else{
            return new Response("null");
        }
    }
    public function AjouterRateAction(Request $request){
        $user = $this->getDoctrine()->getRepository(User::class)->find($request->get('iduser'));
        $userRated = $this->getDoctrine()->getRepository(User::class)->find(4);
        $rate = new Rate();
        $rate->setIduser($user);
        $rate->setIduserRated($userRated);
        $rate->setAvis($request->get('avis'));
        $rate->setCommantaire($request->get('comm'));
        $em = $this->getDoctrine()->getManager();
        $em->persist($rate);
        $em->flush();
        return new Response("success");
    }
    public function changeImageAction(Request $request){
        $user = $this->getDoctrine()->getRepository(User::class)->find($request->get('user'));
        $user->setImage($request->get('image'));
        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();
        return new Response("success");
    }
    public function AfficherRateAction($id){
        $user = $this->getDoctrine()->getRepository(User::class)->find($id);
        $rate = $this->getDoctrine()->getRepository(Rate::class)->findBy(array('iduser_rated'=>$user));
        $somme =0 ;
        if($rate){
        foreach ($rate as $x){
            $somme = $somme + $x->getAvis();
        }
        $moy = $somme/count($rate);
        return new Response($moy);}
        else{
            return new Response(0.0);
        }

    }

}
