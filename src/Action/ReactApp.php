<?php

namespace App\Action;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class ReactApp
{
    /**
     * @Route("/app")
     */
    public function __invoke(Environment $twig)
    {
        return new Response($twig->render('page/react-app.html.twig'));
    }
}
