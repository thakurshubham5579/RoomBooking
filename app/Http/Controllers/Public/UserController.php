<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function home()
    {
        return view('public.home');
    }
}
