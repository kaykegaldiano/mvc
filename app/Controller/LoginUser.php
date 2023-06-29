<?php

namespace App\Controller;

use App\Helper\TwigViewTrait;

class LoginUser
{
    use TwigViewTrait;

    public function handle()
    {
        $title = 'Login';
        echo $this->getTwigFormTemplate('login/form.html', compact('title'));
        if (isset($_SESSION['logged']) && $_SESSION['logged'] === false) {
            unset($_SESSION['logged']);
        }
    }
}