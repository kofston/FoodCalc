<?php

namespace App\Http\Controllers;

use App\Login;
use Illuminate\Database\Eloquent\Model;
use Request;
use DB;
use Singletondatabase;
use App\Models;

class LoginController extends Controller
{

    public function index()
    {
        $db = Models\Singletondatabase::getConnectionWithDatabase();
        return view("header").view("login").view("footer");
    }

}
