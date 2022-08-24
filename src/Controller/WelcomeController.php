<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WelcomeController extends AbstractController
{
    #[Route('/welcome', name: 'welcome')]
    public function index(): Response
    {
        $entityManager = $this->getDoctrine()->getManager();

//        $user = new User();
//        $user->setName('adam');
//        $user2 = new User();
//        $user2->setName('Jennifer saki');
//        $user3 = new User();
//        $user3->setName('master bin');
//        $user4 = new User();
//        $user4->setName('john');
//        $user5 = new User();
//        $user5->setName('fredrick');
//        $user6 = new User();
//        $user6->setName('suzane');
//
//        $entityManager->persist($user);
//        $entityManager->persist($user2);
//        $entityManager->persist($user3);
//        $entityManager->persist($user4);
//        $entityManager->persist($user5);
//        $entityManager->persist($user6);
//
//        $entityManager->flush();

//        return new Response('added');




        return $this->render('welcome/index.html.twig', [
            'controller_name' => 'WelcomeController',
        ]);
    }
}
