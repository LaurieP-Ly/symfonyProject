<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use App\Repository\HoraireRepository;

use App\Entity\Commandes;
use App\Entity\Sport;
use App\Entity\Horaire;
use App\Entity\Reservations;
use App\Entity\User;


class CartController extends AbstractController
{
    /**
     * @Route("/panier/index", name="panier_index")
     */
    public function index(SessionInterface $session, HoraireRepository $horaireRepository ): Response
    {
        $panier= $session->get('panier', []);

        $panierWithData1 = [];
        if(!empty($panier)){

            foreach($panier as $id => $quantity){
                $panierWithData1[] =[
                    'horaire'=> $horaireRepository->find($id),
                    'quantity'=> $quantity
                ];
            }

        }


        

        return $this->render('cart/index.html.twig', ['items' => $panierWithData1]);
    }


    /**
     * @Route("/panier/{idHoraire}/{idUser}",requirements={"idHoraire":"\d+", "idUser":"\d+" }, name="panier_add")
     */
    public function add($idHoraire, $idUser, SessionInterface $session)
    {

        $panier= $session->get('panier', []);

        if(!empty($panier[$idHoraire])){
            return $this->redirectToRoute('panier_doublon');
        }

        //Vérification de l'existence de l'horaire voulu dans les horaires deja enregistrés
        $CommandesUser = $this->getDoctrine()->getRepository(Commandes::class)->findByIdUser($idUser);
        $ttLesReservations=[];

        if(empty($CommandesUser)){
            $panier[$idHoraire]=1;
        }else{

            foreach($CommandesUser as $commande){
                $ttLesReservations[]=$this->getDoctrine()->getRepository(Reservations::class)->findByIdCommande($commande->getId());
            }

            $trouve=false;
    
            foreach($ttLesReservations as $groupesReservationCommande){
                
                $compteur=0;
                while($compteur < count($groupesReservationCommande) and $trouve==false){
                
                    $val= $groupesReservationCommande[$compteur]->getIdHoraire()->getId();
                    if( strcmp("$val", "$idHoraire") == 0 ){
                        $trouve=true;
                    }
                        
                    $compteur=$compteur+1;
                    
                   
                }
    
            }

            //Vérification de l'existence d'un horaire "même jour, même heure" dans les horaires déjà enregistré et dans le panier
            $trouveJourHeure=false;
            $horaireVoulu= $this->getDoctrine()->getRepository(Horaire::class)->find($idHoraire);
            foreach($ttLesReservations as $groupesReservationCommande){
                
                $compteur2=0;
                while($compteur2 < count($groupesReservationCommande) and $trouveJourHeure==false){
                
                    $horaireCurrent= $groupesReservationCommande[$compteur2]->getIdHoraire();
                    if( strcmp($horaireCurrent->getJour(), $horaireVoulu->getJour()) == 0 and strcmp($horaireCurrent->getHeure(), $horaireVoulu->getHeure()) == 0 ){
                        $trouveJourHeure=true;
                    }
                        
                    $compteur2=$compteur2+1;
                    
                   
                }
    
            }

            foreach($panier as $id=>$quantity){
                $CurrentHoraire= $this->getDoctrine()->getRepository(Horaire::class)->find($id);
                if( strcmp($CurrentHoraire->getJour(), $horaireVoulu->getJour()) == 0 and strcmp($CurrentHoraire->getHeure(), $horaireVoulu->getHeure()) == 0 ){
                    $trouveJourHeure=true;
                }

            }
    
            
    
            if($trouve==false and $trouveJourHeure==false){
                $panier[$idHoraire]=1;
    
            }elseif ($trouve==true) {
                return $this->redirectToRoute('panier_doublon');
            }elseif($trouveJourHeure==true){
                return $this->redirectToRoute('panier_doublonJourHeure');

            }else{

                return $this->redirectToRoute('panier_doublon');

            }
                
            

        }

        $session->set('panier', $panier);

        return $this->redirectToRoute('panier_index');

       
    }


    /**
     * @Route("/panierD", name="panier_doublon")
     */
    public function doublon(): Response
    {
        return $this->render('cart/doublon.html.twig');
    }

    /**
     * @Route("/panierDHJ", name="panier_doublonJourHeure")
     */
    public function doublonJourHeure(): Response
    {
        return $this->render('cart/doublonJourHeure.html.twig');
    }

    

    /**
     * @Route("/panier/remove/{idHoraire}", requirements= {"idHoraire":"\d+"}, name="panier_remove")
     */
    public function remove($idHoraire, SessionInterface $session): Response
    {
        $panier = $session->get("panier", []);

        if(!empty($panier[$idHoraire])){
            unset($panier[$idHoraire]);
        }else{

            return $this->redirectToRoute('home');

        }

        $session->set('panier', $panier);
        return $this->redirectToRoute('panier_index');
    }

    /**
     * @Route("/panier/reserv", name="panier_reservation")
     */
    public function reserv(SessionInterface $session, HoraireRepository $horaireRepository): Response
    {

        $panier= $session->get('panier', []);

        $items = [];

        foreach($panier as $id => $quantity){
            $items[] =[
                'horaire'=> $horaireRepository->find($id),
                'quantity'=> $quantity
            ];
        }
        if(!empty($items)){
            $prixTotal= count($items)*30;
            return $this->render('cart/checkout.html.twig', ['items' => $items, 'prixTotal'=>$prixTotal]);
            

        }else{

            return $this->redirectToRoute('home');

        }

        
    }


    /**
     * @Route("/panier/validation/{idUser}/{prixTotal}", name="panier_validation")
     */
    public function validation($idUser, $prixTotal, SessionInterface $session): Response
    {

        $panier = $session->get("panier", []);
        if(!empty($panier)){

            $user = $this->getDoctrine()->getRepository(User::class)->find($idUser);

            $commande = new Commandes();
            $commande->setIdUser($user);
            $commande->setPrix($prixTotal);
            $commande->setDate( date("d-m-Y--H:i:s"));

            $manager= $this->getDoctrine()->getManager();
            $manager->persist($commande);
            $manager->flush();


            $Commande = $this->getDoctrine()->getRepository(Commandes::class)->findOneBySomeField($idUser, $prixTotal, date("d-m-Y--H:i:s"));
            

            

            foreach($panier as $id => $quantity){
                $horaire = $this->getDoctrine()->getRepository(Horaire::class)->find($id);
               $reservation=new Reservations();
               $reservation->setIdHoraire($horaire);
               $reservation->setIdCommande($Commande);
               $manager->persist($reservation);
               $manager->flush();
            }

            $panier = $session->get("panier", []);
            $panier=[];
            $session->set('panier', $panier);

            

            

        }else{
            return $this->redirectToRoute('home');

        }

        
        return $this->redirectToRoute('profil', array('idUser' => $idUser));

       

        
    }


    


    


}
