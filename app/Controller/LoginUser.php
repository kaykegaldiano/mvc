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
    }
}