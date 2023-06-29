<?php

namespace App\Controller;

use App\Helper\TwigViewTrait;

class LoginUser
{
    use TwigViewTrait;

    public function handle()
    {
        if (isset($_SESSION['logged']) && $_SESSION['logged'] === true) {
            header('Location: /list-products', response_code: 302);
            die();
        }
        $title = 'Login';
        echo $this->getTwigFormTemplate('login/form.html.twig', compact('title'));
        if (isset($_SESSION['logged']) && $_SESSION['logged'] === false) {
            unset($_SESSION['logged']);
        }
    }
}