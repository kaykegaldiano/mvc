<?php

namespace App\Controller;

use App\Infra\EntityManagerCreator;
use App\Model\User;
use DateTime;

class PersistUser
{
    public function handle()
    {
        $entityManager = (new EntityManagerCreator())->getEntityManager();
        $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $document = filter_input(INPUT_POST, 'document', FILTER_SANITIZE_SPECIAL_CHARS);
        $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_SPECIAL_CHARS);
        $birthDate = filter_input(INPUT_POST, 'date', FILTER_SANITIZE_SPECIAL_CHARS);
        $password = filter_input(INPUT_POST, 'confirmPassword');

        $user = new User();
        $user->setName($name);
        $user->setEmail($email);
        $user->setDocument(str_replace(['.', '-'], '', $document));
        $user->setPhone(str_replace(['+', ' ', '-'], '', $phone));
        $user->setPassword($password);
        $user->setBirthDate(new DateTime(str_replace('/', '-', $birthDate)));
        $entityManager->persist($user);
        $entityManager->flush();
        header('Location: /login', response_code: 302);
    }
}