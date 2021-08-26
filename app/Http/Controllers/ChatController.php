<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Models\Message;
use App\Models\User;
use App\Notifications\UserLinkedMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function __construct(
        private Message $message,
        private User $user
    )
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

    public function contacts()
    {
        return $this->user
            ->select('name', 'uuid', 'id', 'image')
            ->advogados()
            ->where('id', '<>', Auth::user()->id)->get();
    }

    public function sendMessage(Request $request)
    {
        $user = Auth::user();

        $message = $user->messages()->create([
            'message' => $request->input('message')
        ]);

        $this->notifyUsers($request, $message);

        return response()->json($message->load('user'));
    }

    /**
     * @param Request $request
     * @param $message
     */
    private function notifyUsers(Request $request, $message): mixed
    {
        if ($request->has('users')) {
          return collect($request->get('users'))->each(function ($user) use ($message) {
                $this->user->findOrFail($user['id'])->notify(new UserLinkedMessage($user['uuid'], $message));
            });
        }


        return $this->user
                ->select('uuid', 'id')
                ->advogados()
                ->where('id', '<>', Auth::user()->id)
                ->get()
                ->each(function ($user) use ($message) {
                    $user->notify(new UserLinkedMessage($user->uuid, $message));
                });
    }
}
