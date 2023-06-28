<?php

namespace App\Helper;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

trait TwigViewTrait
{
    private function getTwigFormTemplate(string $template, array $data = [])
    {
        $loader = new FilesystemLoader(__DIR__ . '/../../view');
        $twig = new Environment($loader);
        return $twig->render($template, $data);
    }
}