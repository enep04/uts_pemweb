<?php

namespace App\Http\Controllers;

use App\Models\Datagu;
use Illuminate\Http\Request;

class Frontend extends Controller
{
    public function index()
    {
        $guru = Datagu::all();
        return view ('layouts.index', compact('guru'));
    }
}
