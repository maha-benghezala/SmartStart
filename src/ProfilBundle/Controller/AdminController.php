<?php

namespace ProfilBundle\Controller;

use CMEN\GoogleChartsBundle\GoogleCharts\Charts\PieChart;
use ProfilBundle\Entity\Abonnement;
use ProfilBundle\Entity\Rate;
use ProfilBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class AdminController extends Controller
{
    public function indexadminAction()
    {
        $user = $this->getDoctrine()
            ->getRepository(User::class)->findAll();

        $nbfreelancer=0;
        $nbEntreprise=0;
        $rate=$this->getDoctrine()->getRepository(Rate::class)->findAll();
        $nbrate=count($rate);
        $abonnement=$this->getDoctrine()->getRepository(Abonnement::class)->findAll();
        $nbabonnement=count($abonnement);
        foreach($user as $u)
        {
            foreach ($u->getRoles() as $role)
            {
                if($role == "ROLE_FREELANCER")
                {
                    $nbfreelancer=$nbfreelancer+1;
                }
                if($role=="ROLE_ENTREPRISE")
                {
                    $nbEntreprise=$nbEntreprise+1;
                }

            }
        }
        $pieChart = new PieChart();

        $pieChart->getData()->setArrayToDataTable(
            [['type des utilisateurs','Nombre'],
                ['Freelancer',     $nbfreelancer],
                ['Entreprise',      $nbEntreprise]

            ]
        );
        $pieChart->getOptions()->setTitle('Type des utilisateurs');
        $pieChart->getOptions()->setHeight(500);
        $pieChart->getOptions()->setWidth(900);
        $pieChart->getOptions()->getTitleTextStyle()->setBold(true);
        $pieChart->getOptions()->getTitleTextStyle()->setColor('#009900');
        $pieChart->getOptions()->getTitleTextStyle()->setItalic(true);
        $pieChart->getOptions()->getTitleTextStyle()->setFontName('Arial');
        $pieChart->getOptions()->getTitleTextStyle()->setFontSize(20);

        return $this->render('ProfilBundle:Admin:DashboardAdmin.html.twig',array('piechart' => $pieChart,'user'=>$user,'rate'=>$nbrate,'abonnement'=>$nbabonnement,'nbfreelancer'=>$nbfreelancer));

    }
    public function bannirUserAction($id)
    {
        $user = $this->getDoctrine()->getRepository(User::class)->find($id);
        $user->setEnabled(0);
        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();
        return $this->redirectToRoute('dashboard_admin');
    }
    public function approuverUserAction($id)
    {
        $user = $this->getDoctrine()->getRepository(User::class)->find($id);
        $user->setEnabled(1);
        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();
        return $this->redirectToRoute('dashboard_admin');
    }



}
