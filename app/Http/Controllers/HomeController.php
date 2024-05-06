<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        $data['meta_title'] = 'Tapu Tapi Shop';
        $data['meta_description'] = 'Tapu Tapi Shop';
        $data['meta_keywords'] = 'Tapu Tapi Shop';

        return view('home', $data);
    }
}
