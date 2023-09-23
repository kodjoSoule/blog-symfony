<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        // Récupérer l'utilisateur actuellement authentifié
        $user = $this->getUser();

        // Vérifier si un utilisateur est authentifié
        if ($user) {
            $username = $user->getUsername(); // Supposons que le nom d'utilisateur soit stocké dans la propriété "username"
        } else {
            $username = null;
        }

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            // Transmettre le nom d'utilisateur à la vue
            'username' => $username, 
        ]);
    }
}
