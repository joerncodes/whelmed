<?php

namespace App\Action\Security;

use Symfony\Component\Routing\Annotation\Route;

class Logout
{
    /**
     * @Route("/logout", name="security.logout")
     */
    public function logout()
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}
