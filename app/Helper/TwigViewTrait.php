<?php

namespace App\Helper;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use Twig\TwigFunction;

trait TwigViewTrait
{
    private function getTwigFormTemplate(string $template, array $data = [])
    {
        $loader = new FilesystemLoader(__DIR__ . '/../../view');
        $twig = new Environment($loader);
        $twig->addGlobal('session', $_SESSION);
        $function = new TwigFunction('unsetMsg', function () {
            unset($_SESSION['msgType']);
            unset($_SESSION['msg']);
        });
        $twig->addFunction($function);
        return $twig->render($template, $data);
    }
}