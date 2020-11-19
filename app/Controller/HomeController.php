<?php


namespace App\Controller;


use Framework\Controller\AbstractController;

class HomeController extends AbstractController
{
    public function index()
    {
        echo $this->get('config_dir');exit;
    }
}