<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\MessageSent;
use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class ChatController extends Controller
{
    public function index(Request $request)
    {
        return view('chat.index', ['user' => $request->user(), 'users' => User::all()]);
    }

    public function store()
    {
        $validator = Validator::make(['message' => request('message')], [
            'message' => 'required|no_bad_words|string'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->first('message'), 422);
        }

        $time = now();

        Message::create([
            'user_id' => auth()->user()->id,
            'to_user' => request('to_user'),
            'message' => request('message'),
            'created_at' => $time
        ]);

        event(new MessageSent(request('message'), auth()->user()->id, date('d M Y H:i')));
    }

    public function show()
    {
        return response()->json(['messages' =>
        Message::where(function ($query) {
            $query->where('user_id', auth()->user()->id)->where('to_user', request('to_user'));
        })->orWhere(function ($query) {
            $query->where('user_id', request('to_user'))->where('to_user', auth()->user()->id);
        })->get()]);
    }
}
