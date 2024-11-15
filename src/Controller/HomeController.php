<?php

namespace App\Controller;
use Core\View\View;
class HomeController
{

    public function index()
    {
        View::render('home/index',[
            "message"=>"coucou"
        ] );
    }
}