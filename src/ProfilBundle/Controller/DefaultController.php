<?php

namespace ProfilBundle\Controller;

use ProfilBundle\Form\EntrepriseType;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use ProfilBundle\Entity\User;
use ProfilBundle\Form\UserType;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Security;


class DefaultController extends Controller
{

    public function indexAction(Request $request)
    {
        return $this->render('ProfilBundle:Default:index.html.twig');

    }
    public function inscriptionAction(Request $request)
    {
        $user = new User();
        $form = $this->createForm(UserType::class,$user);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $file=$user->getImage();
            $password = $this->get('security.password_encoder')
                ->encodePassword($user, $user->getPlainPassword());
            if($file != null)
            {
                $fileName = md5(uniqid()) . '.' . $file->guessExtension();
                $path="../web";
                $file->move($path ,$fileName);
                $user->setImage($fileName);
            }

            $em = $this->getDoctrine()->getManager();
            $user->setPassword($password);
            $user->setEnabled(1);
            $user->addRole("ROLE_FREELANCER");
            $em->persist($user);

            $em->flush();
            return $this->redirectToRoute('login');

        }
        return $this->render('ProfilBundle:Default:inscription.html.twig',array('form'=>$form->createView()));
    }
    public function BeforeSignAction(Request $request)
    {
        return $this->render('ProfilBundle:Default:BeforeSignUp.html.twig');
    }
    public function inscriptionEntrepriseAction(Request $request)
    {
        $user = new User();
        $form = $this->createForm(EntrepriseType::class,$user);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $file=$user->getImage();
            $password = $this->get('security.password_encoder')
                ->encodePassword($user, $user->getPlainPassword());
            if($file != null)
            {
                $fileName = md5(uniqid()) . '.' . $file->guessExtension();
                $path="../web";
                $file->move($path ,$fileName);
                $user->setImage($fileName);
            }

            $em = $this->getDoctrine()->getManager();
            $user->setPassword($password);
            $user->addRole("ROLE_ENTREPRISE");
            $user->setEnabled(1);
            $em->persist($user);

            $em->flush();
            return $this->redirectToRoute('login');

        }
        return $this->render('ProfilBundle:Default:inscriptionEntreprise.html.twig',array('form'=>$form->createView()));
    }
    public function LoginAction(Request $request)
    {
        /** @var $session Session */
        $session = $request->getSession();

        $authErrorKey = Security::AUTHENTICATION_ERROR;
        $lastUsernameKey = Security::LAST_USERNAME;

        // get the error if any (works with forward and redirect -- see below)
        if ($request->attributes->has($authErrorKey)) {
            $error = $request->attributes->get($authErrorKey);
        } elseif (null !== $session && $session->has($authErrorKey)) {
            $error = $session->get($authErrorKey);
            $session->remove($authErrorKey);
        } else {
            $error = null;
        }

        if (!$error instanceof AuthenticationException) {
            $error = null; // The value does not come from the security component.
        }

        // last username entered by the user
        $lastUsername = (null === $session) ? '' : $session->get($lastUsernameKey);

        $csrfToken = $this->has('security.csrf.token_manager')
            ? $this->get('security.csrf.token_manager')->getToken('authenticate')->getValue()
            : null;

        return $this->render('ProfilBundle:Default:Login.html.twig',array(
            'last_username' => $lastUsername,
            'error' => $error,
            'csrf_token' => $csrfToken,
        ));

    }

}
