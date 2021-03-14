<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Sport;
use App\Entity\Horaire;
use App\Entity\User;
use App\Entity\Commandes;
use App\Entity\Reservations;

use Symfony\Component\HttpFoundation\Session\SessionInterface;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index( SessionInterface $session): Response
    {
        $panier= $session->get('panier', []);
        return $this->render('default/index.html.twig');
    }


    /**
     * @Route("/sports", name="AllSports")
     */
    public function AllSports()
    {
        $AllSports = $this->getDoctrine()->getRepository(Sport::class)->findAll();
        return $this->render('default/sports.html.twig', [
            'AllSports' => $AllSports,
        ]);
    }

   

     /**
     *@Route("/planning/{id}",requirements={"id":"\d"}, name="planning")
     */
    public function planning($id)
    {
        $horaires = $this->getDoctrine()->getRepository(Horaire::class)->findByIdSport($id);
        $sport = $this->getDoctrine()->getRepository(Sport::class)->find($id);
        return $this->render('default/planning.html.twig', [
            'horaires' => $horaires,
            'sport'=> $sport,
        ]);
    }


    /**
     *@Route("/profil/{idUser}",requirements={"idUser":"\d"}, name="profil")
     */
    public function profil($idUser)
    {
        $user = $this->getDoctrine()->getRepository(User::class)->find($idUser);
        $CommandeUser = $this->getDoctrine()->getRepository(Commandes::class)->findByIdUser($idUser);
        $ttLesReservations=[];
        foreach($CommandeUser as $commande){
            $ttLesReservations[]=$this->getDoctrine()->getRepository(Reservations::class)->findByIdCommande($commande->getId());
        }
        return $this->render('default/profil.html.twig', [
            'user' => $user,
            'reservations'=> $ttLesReservations,
            'commandes'=>$CommandeUser
        ]);
    }


     
}
