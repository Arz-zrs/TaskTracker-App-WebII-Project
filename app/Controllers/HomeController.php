<?php

namespace App\Controllers;

class HomeController extends BaseController
{
    public function index()
    {
        if (session()->get('user_id')) {
            return redirect()->to('/dashboard');
        }

        return view('landingpage/landing');
    }
}
