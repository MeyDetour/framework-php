<?php

namespace App\Controller;
use Core\View\View;
class HomeController
{
function index(){
    View::render('home/index',[]);
}
}