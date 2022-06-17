<?php

namespace App\Controllers;

use \Core\Controller;
use Core\View;

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
//        return View::render("series/episode", [
//            'slug' => $slug,
//            'id' => $id
//        ]);
        return View::renderTemplate('series.episode', [
            'slug' => $slug,
            'id' => $id,
        ]);

    }
}