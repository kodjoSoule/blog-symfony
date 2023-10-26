<?php

namespace App\Controller;

use App\Form\ContactFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function index(Request $request, MailerInterface $mailer): Response
    {
        // Exemple de création d'un formulaire simple
        $contactForm = $this->createForm(ContactFormType::class);

        // Gérez la soumission du formulaire
        //cette clase va gerer le formulaires du contact
        $contactForm->handleRequest($request);

        if ($contactForm->isSubmitted() && $contactForm->isValid()) {
            // Récupérez les données du formulaire
            $formData = $contactForm->getData();
            // Récupérez le destinataire de l'e-mail (vous pouvez le définir selon vos besoins)
            $recipientEmail = 'blog@blog-books.com';
            $senderEmail = $formData->getEmail();
            $message = $formData->getMessage();


            // Construisez le message e-mail
            $email = (new Email())
                ->subject('Nouveau message de contact')
                ->from($senderEmail)
                ->to($recipientEmail)
                ->text($message)

                // ->html($this->renderView(
                // 'emails/contact_notification.html.twig',
                // ['message' => $formData['message']]
                // ))
            ;


            // Envoyez l'e-mail
            $mailer->send($email);

            // Redirigez l'utilisateur vers une page de confirmation
            return $this->redirectToRoute('app_thank_you', [
                'contact_page' => 'active',
            ]);
        }


        return $this->render('contact/index.html.twig', [
            'contactForm' => $contactForm->createView(),
            'contact_page' => 'active',
        ]);
    }

    #[Route('/contact/thank-you', name: 'app_thank_you')]
    public function thankYou(): Response
    {
        // Affichez une page de confirmation après l'envoi du message
        return $this->render('contact/thank_you.html.twig', [
            'contact_page' => 'active',
        ]);
    }
}
