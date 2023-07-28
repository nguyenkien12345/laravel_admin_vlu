<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\ApiExternal\ApiCrm;

class HomeController extends Controller
{
    public $apiCrm;

    public function __construct()
    {
        $this->apiCrm = new ApiCrm();
    }

    public function index()
    {
        // dd($this->apiCrm->searchProfiles('362459089'));
        // return view('Home.index');
    }
}
