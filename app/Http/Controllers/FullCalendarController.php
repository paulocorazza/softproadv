<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Http\Request;

class FullCalendarController extends Controller
{
    /**
     * @var UserRepositoryInterface
     */
    private $user;

    public function __construct(UserRepositoryInterface $user)
    {

        $this->user = $user;
    }


    public function index()
    {
        $title = 'Agenda';

        $users = $this->user->getAdvogados();

        return view('tenants.fullcalendar.master', compact('title', 'users'));
    }
}
