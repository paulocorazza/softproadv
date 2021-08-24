<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function __construct(private Message $message)
    {
    }

    public function index()
    {
       return view('tenants.messages.index');
    }


    public function fetchMessages()
    {
        return $this->message::with('user')->latest()->get();
    }

    public function sendMessage(Request $request)
    {
        $user = Auth::user();

        $message = $user->messages()->create([
            'message' => $request->input('message')
        ]);

        $uuidCompany = session()->has('company') ? session('company')['uuid'] : '';

        broadcast(new MessageSent($message->load('user'), $uuidCompany))->toOthers();

        return response()->json($message->load('user'));
    }
}
