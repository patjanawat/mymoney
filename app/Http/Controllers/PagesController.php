<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index(){
        return view('pages/index');
    }

    // public function income(){
    //     return view('pages/income');
    // }

    public function expense(){
        return view('pages/expense');
    }

    public function about(){
        return view('pages/about');
    }
}
