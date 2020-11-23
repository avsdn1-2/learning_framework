<?php


namespace App\Controller;


use App\Model\User;
use Framework\Controller\AbstractController;
use Framework\Model\ModelFactory;

class UserController extends AbstractController
{
    public function list()
    {
        /** @var User $user */
        $userModel = ModelFactory::make(User::class, $this->getContainer());

        $users = $userModel->findAll();
        return $this->render('users.html.twig', [
            'users' => $users
        ]);
    }
}