<?php

namespace App\Helper;

trait FlashMessageTrait
{
    private function defineMessage(string $type, string $message): void
    {
        $_SESSION['msgType'] = $type;
        $_SESSION['msg'] = $message;
    }
}