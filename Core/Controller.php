<?php

namespace Core;

class Controller
{
    public function before()
    {
        echo 'before<br>';
        return true;
    }


    public function after()
    {
        echo '<br>after<br>';
    }
}