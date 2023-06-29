<?php

namespace App\Helper;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

trait TwigViewTrait
{
    private function getTwigFormTemplate(string $template, array $data = [])
    {
        $loader = new FilesystemLoader(__DIR__ . '/../../resources/view');
        $twig = new Environment($loader);
        $twig->addGlobal('session', $_SESSION);
        return $twig->render($template, $data);
    }
}