<?php

namespace App\Controller;

use App\Repository\UsersRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MainController extends AbstractController
{
    #[Route('/', name: 'main')]
    public function index( UsersRepository $usersReop): Response
    {
         
        return $this->render('main/index.html.twig', [
            'users' => $usersReop->findAll(),
        ]);
    }
    #[Route('/mentions-legales', name:'mentions')]

    public function mention(): Response
    {
           return new Response('Ceci est une page de mentions légales');
    }
}
