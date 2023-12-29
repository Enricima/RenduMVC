<?php

namespace App\Controller;

use App\Entity\Newsletter;
use App\Routing\Attribute\Route;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class NewsletterController extends AbstractController
{
    #[Route('/newsletter/subscribe', 'newsletter_subscribe')]
    public function subscribe(Request $request): string
    {
        return $this->twig->render('newsletter/subscribe.html.twig');
    }

    #[Route('/newsletter/register', 'newsletter_register', 'POST')]
    public function register(Request $request, EntityManager $em): void
    {
        if (!isset($_POST['email'])) {
            $this->redirect('/newsletter/subscribe');
        }

        $email = $request->request->get('email');

        if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
            $this->redirect('/newsletter/subscribe');
        }

        $newsletterEmail = new Newsletter();
        $newsletterEmail->setEmail($email);

        $em->persist($newsletterEmail);
        $em->flush();

        $this->redirect('/newsletter/confirm');
    }

    #[Route('/newsletter/confirm', 'newsletter_confirm')]
    public function confirm(): string
    {
        return $this->twig->render('newsletter/confirm.html.twig');
    }
}
