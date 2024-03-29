<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Partenaire;
use App\Entity\Compt;
use App\Repository\ComptRepository;

use App\Repository\PartenaireRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * @Route("/api")
 */
class SecurityController extends AbstractController
{
    /**
     * @Route("/register", name="register", methods={"POST"})
     * @IsGranted("ROLE_SUPERADMIN")

     */

    //-------Ajout d'un SupertUser et Caissier----/////
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder, EntityManagerInterface $entityManager, ValidatorInterface $validator)
    {
        $values = json_decode($request->getContent());
        $a=$this->controlespace($values->nom);
        if(!empty($values->username)&& !empty($values->password) && $a==true && !empty($values->nom) && !empty($values->tel) 
        && !empty($values->adresse) && !empty($values->cni)) {
            $user = new User();
            $user->setUsername($values->username);
            $user->setPassword($passwordEncoder->encodePassword($user, $values->password));
            $user->setNom($values->nom);
            $user->setTel($values->tel);
            $user->setAdresse($values->adresse);
           
            if ($values->role==1) {
                $user->setRoles(['ROLE_SUPERADMIN']);    
            }
           
            if ($values->role==2) {
                $user->setRoles(['ROLE_CAISSIER']);    
            }
           
            
            $user->setPhoto($values->photo);
            $user->setCni($values->cni);
          

            $entityManager->persist($user);
            $entityManager->flush();

            $data = [
                'status' => 201,
                'message' => 'L\'utilisateur a été créé'
            ];

            return new JsonResponse($data, 201);
        }
        $data = [
            'status' => 500,
            'message' => 'Vous devez renseigner toutes les champs'
        ];
        return new JsonResponse($data, 500);
        
    }

    /**
     * @Route("/login", name="login", methods={"POST"})
     
     */
    public function login(Request $request)
    {
        $user = $this->getUser();
        return $this->json([
            'username' => $user->getUsername(),
            'roles' => $user->getRoles()
        ]);
    }
    /**
     *@Route("/ajoutpart", name="ajoutpart", methods={"POST"}) 
     *@IsGranted("ROLE_SUPERADMIN")
     */
     //-------Ajout d'un Partenaire et son Admin et Compt ----/////
    public function ajoutpart(Request $request, UserPasswordEncoderInterface $passwordEncoder, EntityManagerInterface $entityManager , ValidatorInterface $validator)
    {
        $values = json_decode($request->getContent());
   if(!empty($values->nom) && !empty($values->adresse) && !empty($values->ninea) && !empty($values->raisonsocial))
     {
         $part = new Partenaire();
         $part->setNom($values->nom);
         $part->setAdresse($values->adresse);
         $part->setNinea($values->ninea);
         $part->setRaisonsocial($values->raisonsocial);
         $part->setStatus('Active');
          
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
                   $compt->setPartenaire($part);
         
       
         $user = new User();
            $user->setUsername($values->username);
            $user->setPassword($passwordEncoder->encodePassword($user, $values->password));
            $user->setNom($values->nom1);
            $user->setTel($values->tel);
            $user->setAdresse($values->adresse1);
        
            if ($values->role==3) {
                $user->setRoles(['ROLE_ADMIN']);    
            }
          
            if ($values->role==4) {
                $user->setRoles(['ROLE_USER']);    
            }
            
            $user->setPhoto($values->photo);
            $user->setCni($values->cni);
            $user->setPartenaire($part);
            $user->setNumcompt($compt);
           
            $entityManager = $this->getDoctrine()->getManager();

            $entityManager->persist($user);
            $entityManager->persist($part);
            $entityManager->persist($compt);
            $entityManager->flush();
    
            $data = [
                'statu' => 201,
                'messages' => 'Le partenaire a été créé'
            ];

            return new JsonResponse($data, 201);

    }
}
    /**
     * @Route("/ajoutpartuser", name="ajoutpartuser", methods={"POST"})
     * @IsGranted("ROLE_ADMIN")
     
     */
     //-------Ajout des users d'un partenaire  ----/////
    public function ajoutpartuser(Request $request, UserPasswordEncoderInterface $passwordEncoder, EntityManagerInterface $entityManager, ValidatorInterface $validator)
    {
        $values = json_decode($request->getContent());
        if(!empty($values->username) && !empty($values->password) && !empty($values->nom1) && !empty($values->tel) && !empty($values->cni)
        ){

  
        $user = new User();

            $user->setUsername($values->username);
            $user->setPassword($passwordEncoder->encodePassword($user, $values->password));
            $user->setNom($values->nom1);
            $user->setTel($values->tel);
            $user->setAdresse($values->adresse1);
           
            if ($values->role==3) {
                $user->setRoles(['ROLE_ADMIN']);    
            }
           
            if ($values->role==4) {
                $user->setRoles(['ROLE_USER']);    
            }
            
            $user->setPhoto($values->photo);
            $user->setCni($values->cni);
            $repo=$this->getDoctrine()->getRepository(Partenaire::class);
            $data=json_decode($request->getContent(),true);
            $partenaires=$repo->find($data['partenaire']);
            $user->setPartenaire($partenaires);

            $repo=$this->getDoctrine()->getRepository(Compt::class);
            $compt=$repo->find($values->compt);
            $user->setNumcompt($compt);

            $entityManager = $this->getDoctrine()->getManager();

            $entityManager->persist($user);
            $entityManager->flush();
            $data = [
                'statu' => 201,
                'messages' => 'Lutilisateur a été créé'
            ];

            return new JsonResponse($data, 201);

    }
}
    public function controlespace($test)
    {
      $taill= strlen($test);
      $result=true;
      for ($i=0; $i <$taill ; $i++) { 
          if ($test[$i]== " ") {
              $result=false;
          }
          else {
              $result=true;break;
          }
      }
      return $result;

    }

}