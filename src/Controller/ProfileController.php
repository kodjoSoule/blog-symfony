<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class ProfileController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/profile', name: 'app_profile')]
    #[IsGranted("ROLE_USER")]
    public function index(Request $request): Response
    {
        // Récupérez les informations du profil de l'utilisateur actuellement authentifié
        $user = $this->getUser();

        // Exemple de création d'un formulaire pour l'édition du profil
        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);
        try {
            if ($form->isSubmitted() && $form->isValid()) {
                // Enregistrez les modifications du profil dans la base de données
                $this->entityManager->flush();

                // Ajoutez une notification de succès
                $this->addFlash('success', 'Les modifications ont été enregistrées avec succès.');

                // Redirigez l'utilisateur vers la page du profil après l'édition
                return $this->redirectToRoute('app_profile');
            }
        } catch (Exception $exception) {
            // Gérer l'erreur en conséquence, par exemple, afficher un message d'erreur
            $this->addFlash('error', 'Une erreur est survenue lors de l\'enregistrement des modifications.');
        }

        return $this->render('profile/index.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }
}
