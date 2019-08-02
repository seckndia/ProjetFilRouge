<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Compt;
use App\Entity\Partenaire;
use App\Entity\Depots;
use App\Entity\User;
use App\Repository\PartenaireRepository;
use App\Repository\UserRepository;

use App\Repository\ComptRepository;
use App\Repository\DepotsRepository;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Form\DepotType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class PartenaireController extends AbstractController
{
    /**
     * @Route("/partenaire", name="partenaire")
     */
    public function index()
    {
        return $this->render('partenaire/index.html.twig', [
            'controller_name' => 'PartenaireController',
        ]);
    }
    /**
     * @Route("/compt", name="compt")
     
     */
    //-----------AjoutCompt--------------///////////
    public function ajoutcompt(Request $request, EntityManagerInterface $entityManager, ValidatorInterface $validator) 
    {          
         $values = json_decode($request->getContent());

          $compt = new Compt();
          // Enregistrons les informations de date dans des variables

        $jours = date('d');
        $mois = date('m');
        $annee = date('Y');

         $heure = date('H');
         $minute = date('i');
         $seconde= date('s');
       $test = $jours.$mois.$annee.$heure.$minute.$seconde;
          $compt->setNumcompt($test);
          $compt->setSolde($values->solde);
          $repo=$this->getDoctrine()->getRepository(Partenaire::class);
          $data=json_decode($request->getContent(),true);
          $partenaires=$repo->find($data['partenaire']);
          $compt->setPartenaire($partenaires);
          $entityManager = $this->getDoctrine()->getManager();

          $entityManager->persist($compt);
          $entityManager->flush();
          $data = [
            'statu' => 201,
            'messages' => 'L compt a été créé'
        ];

        return new JsonResponse($data, 201);

    }
    //-------Faire un dépots---------//////

    /**
     * @Route("/depot", name="depot", methods={"POST"})
     
     */
    public function depot(Request $request,EntityManagerInterface $entityManager,DepotsRepository $repo ): Response
    {
        $values = json_decode($request->getContent());

        $depot = new Depots();
        $depot->setDateDepot(new \DateTime());
        $depot->setMontant($values->montant);
        
        $data=json_decode($request->getContent(),true);
        $repo=$this->getDoctrine()->getRepository(Compt::class);
        $compt=$repo->find($data["compt"]);
        
        $compt->setSolde($compt->getSolde()+$depot->getMontant());
        $depot->setCompt($compt);
        $repo=$this->getDoctrine()->getRepository(User::class);

        $caissier=$repo->find($data['caissier']);
        $depot->setCaissier($caissier);
         
        $depot->setSoldeInitial($compt->getSolde());


            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($depot);
            $entityManager->persist($compt);

            $entityManager->flush();
        
        return new Response('Le depot a été effectuer',Response::HTTP_CREATED);
    }
}
