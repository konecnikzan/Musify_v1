<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\User;
use App\Message;
use Twilio\Rest\Client;

class MessagesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($id)
    {
        $users = User::where('id', '!=', Auth::user()->id)->get();

        return view('chat', compact('users'));
    }

}