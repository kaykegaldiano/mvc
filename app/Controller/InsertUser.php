<?php

namespace App\Controller;

use App\Helper\TwigViewTrait;
use App\Model\User;

class InsertUser
{
    use TwigViewTrait;

    public function handle()
    {
        $user = new User();
        $title = 'Sign Up';
        echo $this->getTwigFormTemplate('signup/form.html.twig', compact('user', 'title'));
    }
}