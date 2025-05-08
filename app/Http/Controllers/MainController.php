<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class MainController extends Controller
{

    private $app_data;

    public function __construct()
    {
        $this->app_data = require(app_path('app_data.php'));
    }

    public function showData()
    {
        return response()->json($this->app_data);
    }

    public function startGame():View
    {
        return view('home');
    }

}
