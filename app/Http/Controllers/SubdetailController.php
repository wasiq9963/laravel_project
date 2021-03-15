<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Vegetable;
use App\Sauce;

class SubdetailController extends Controller
{
    public function index(Request $req)
    {
        $vegetable = Vegetable::all();
        $sauce = Sauce::all();

        return view('subdetail.subdetailinfo',['vegetable' => $vegetable,'sauce' => $sauce]);
    }
}
