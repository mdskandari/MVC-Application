<?php

namespace App\Controllers;

use App\Models\Article;
use App\Models\User;
use Core\Controller;
use Core\View;

class HomeController extends Controller
{
    public function index()
    {

        $article= new Article();
//        $users = $user->selectAll(1);
        var_dump($article->selectAll());die;

//        return View::renderTemplate('index');
    }
}