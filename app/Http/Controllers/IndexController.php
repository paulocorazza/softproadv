<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        if (request()->getHost() != config('tenant.domain_main')) {
            return redirect()->route('home');
        }

        return view('welcome');
    }
}
