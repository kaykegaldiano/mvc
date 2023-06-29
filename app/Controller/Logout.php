<?php

namespace App\Controller;

class Logout
{
    public function handle()
    {
        session_destroy();
        header('Location: /login', response_code: 302);
    }
}