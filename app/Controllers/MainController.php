<?php

namespace App\Controllers;

class MainController extends BaseController
{
    public function search(): string
    {
        return view('busqueda');
    }

}