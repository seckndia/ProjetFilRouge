<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Partenaire;
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

     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder, EntityManagerInterface $entityManager, ValidatorInterface $validator)
    {
        $values = json_decode($request->getContent());
        if(isset($values->username,$values->password)) {
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
                $user->setRoles(['ROLE_ADMIN']);    
            }
            if ($values->role==3) {
                $user->setRoles(['ROLE_CAISIER']);    
            }
            if ($values->role==4) {
                $user->setRoles(['ROLE_USER']);    
            }
            
            $user->setPhoto($values->photo);
            $user->setCni($values->cni);
          

            // $errors = $validator->validate($user);
            // if(count($errors)) {
            //     $errors = $serializer->serialize($errors, 'json');
            //     return new Response($errors, 500, [
            //         'Content-Type' => 'application/json'
            //     ]);
            // }
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
            'message' => 'Vous devez renseigner les clés username et password'
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
     */
    public function ajoutpart(Request $request, UserPasswordEncoderInterface $passwordEncoder, EntityManagerInterface $entityManager, ValidatorInterface $validator)
    {
        $values = json_decode($request->getContent());

         $part = new Partenaire();
         $part->setNom($values->nom);
         $part->setAdresse($values->adresse);
         $part->setNinea($values->ninea);
         $part->setRaisonsocial($values->raisonsocial);
         $part->setStatus('Active');
       
         $user = new User();
            $user->setUsername($values->username);
            $user->setPassword($passwordEncoder->encodePassword($user, $values->password));
            $user->setNom($values->nom1);
            $user->setTel($values->tel);
            $user->setAdresse($values->adresse1);
           
            if ($values->role==1) {
                $user->setRoles(['ROLE_ADMIN']);    
            }
            if ($values->role==2) {
                $user->setRoles(['ROLE_USER']);    
            }
            
            $user->setPhoto($values->photo);
            $user->setCni($values->cni);
        
            $user->setPartenaire($part);
            $entityManager = $this->getDoctrine()->getManager();

            $entityManager->persist($user);
            $entityManager->persist($part);
            $entityManager->flush();
    
            $data = [
                'statu' => 201,
                'messages' => 'Le partenaire a été créé'
            ];

            return new JsonResponse($data, 201);

    }
    /**
     * @Route("/ajoutpartuser", name="ajoutpartuser", methods={"POST"})
     
     */
    public function ajoutpartuser(Request $request, UserPasswordEncoderInterface $passwordEncoder, EntityManagerInterface $entityManager, ValidatorInterface $validator)
    {
        $values = json_decode($request->getContent());
        $user = new User();
            $user->setUsername($values->username);
            $user->setPassword($passwordEncoder->encodePassword($user, $values->password));
            $user->setNom($values->nom1);
            $user->setTel($values->tel);
            $user->setAdresse($values->adresse1);
           
            if ($values->role==1) {
                $user->setRoles(['ROLE_ADMIN']);    
            }
            if ($values->role==2) {
                $user->setRoles(['ROLE_USER']);    
            }
            
            $user->setPhoto($values->photo);
            $user->setCni($values->cni);
            $repo=$this->getDoctrine()->getRepository(Partenaire::class);
            $data=json_decode($request->getContent(),true);
            $partenaires=$repo->find($data['partenaire']);
            $user->setPartenaire($partenaires);

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