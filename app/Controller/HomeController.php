<?php


namespace App\Controller;


use Framework\Controller\AbstractController;

class HomeController extends AbstractController
{
    public function index()
    {
        return $this->render('index.html.twig', [
            'title' => 'title',
            'heading' => '<a href="#">Heading</a>',
            'message' => 'Test Message'
        ]);
    }
}