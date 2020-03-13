<?php

namespace App\Action\Security;

use App\Domain\ApiClient\UnsplashRandomSearch;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Twig\Environment;

class Login
{
    /**
     * @Route("/login", name="security.login")
     */
    public function __invoke(AuthenticationUtils $authenticationUtils, UnsplashRandomSearch $unsplash, Environment $twig): Response
    {
        $randomPhoto = $unsplash->getRandomPhoto();
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        $content = $twig->render(
            'security/login.html.twig',
            ['last_username' => $lastUsername, 'error' => $error, 'randomPhoto' => $randomPhoto]
        );

        return new Response($content);
    }
}
