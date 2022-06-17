<?php

namespace App\Controllers;
use \Core\Controller;

class SeriesController extends Controller
{
    public function index()
    {
        return 'Series index';
    }

    public function serie($slug)
    {
        return 'Series Page for: ' . $slug;
    }

    public function episode($slug, $id)
    {
        return 'Series Page for' . $slug . ' episode ' . $id;
//        return var_dump($_GET);
    }
}