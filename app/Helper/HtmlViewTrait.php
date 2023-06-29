<?php

namespace App\Helper;

trait HtmlViewTrait
{
    private function getHtmlFromTemplate(string $template, array $data = []): string
    {
        ob_start();
        extract($data);
        require __DIR__ . '/../../resources/view/' . $template;
        return ob_get_clean();
    }
}