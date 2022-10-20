<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Laravel\Lumen\Routing\Controller as BaseController;

class AuthController extends BaseController
{
    public function getLogin(){
        return \view('login');
    }
}
