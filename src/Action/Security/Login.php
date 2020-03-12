<?php

namespace App\Action\Security;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Twig\Environment;

class Login
{
    /**
     * @Route("/login", name="security.login")
     */
    public function __invoke(AuthenticationUtils $authenticationUtils, Environment $twig): Response
    {
        // if ($this->getUser()) {
        //     return $this->redirectToRoute('target_path');
        // }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        $content = $twig->render(
            'security/login.html.twig',
            ['last_username' => $lastUsername, 'error' => $error]
        );

        return new Response($content);
    }
}
