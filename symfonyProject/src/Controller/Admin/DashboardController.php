<?php

namespace App\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Horaire;
use App\Entity\Sport;
use App\Entity\User;
use App\Entity\Commandes;
use App\Entity\Reservations;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        $sports =$this->getDoctrine()->getRepository(Sport::class)->findAll();
        $horaires =$this->getDoctrine()->getRepository(Horaire::class)->findAll();
        $commandes =$this->getDoctrine()->getRepository(Commandes::class)->findAll();
        $reservations =$this->getDoctrine()->getRepository(Reservations::class)->findAll();
        $users =$this->getDoctrine()->getRepository(User::class)->findAll();
        return $this->render('admin/dashboard.html.twig', ['sports'=>$sports, 'horaires'=>$horaires, 'commandes'=>$commandes, 'reservations'=>$reservations, 'users'=>$users]);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()

            ->setTitle('SymfonyProject');

    }
    

    public function configureMenuItems(): iterable
    {
        return [
            MenuItem::linkToDashboard('Dashboard', 'fa fa-home'),

            MenuItem::section('Entity'),
            MenuItem::linkToCrud('Sports', 'fa fa-tags', Sport::class),
            MenuItem::linkToCrud('Horaires', 'fa fa-file-text', Horaire::class),
            MenuItem::linkToCrud('Users', 'fa fa-file-text', User::class),
            MenuItem::linkToCrud('Commandes', 'fa fa-file-text', Commandes::class),
            MenuItem::linkToCrud('Reservations', 'fa fa-file-text', Reservations::class),
        ];
    }
}
