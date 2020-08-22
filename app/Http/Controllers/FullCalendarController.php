<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FullCalendarController extends Controller
{
    public function index()
    {
        $title = 'Agenda';

        return view('tenants.fullcalendar.master', compact('title'));
    }
}
