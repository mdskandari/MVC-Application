<?php

namespace App\Controllers;

class SeriesController
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