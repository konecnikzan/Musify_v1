<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Message;
use DB;

class ContactsController extends Controller
{
    public function get()
    {            
        //SIDEBAR
        $latestMessages = DB::select("SELECT sender.id AS sender_id , recipient.id AS recipient_id , m.created_at ,m.message, 
                sender.name AS sender_name , recipient.name AS recipient_name, sender.avatar AS sender_avatar , recipient.avatar AS recipient_avatar,
                m.is_read AS is_read
            FROM messages AS m 
            INNER JOIN users AS sender ON sender.id = m.from 
            INNER JOIN users AS recipient ON recipient.id = m.to 
            INNER JOIN ( SELECT MAX(m1.id) AS most_recent_message_id 
                            FROM messages AS m1 
                            GROUP BY CASE WHEN m1.from > m1.to THEN m1.to ELSE m1.from END,CASE WHEN m1.from < m1.to THEN m1.to ELSE m1.from END ) 
                AS T ON T.most_recent_message_id = m.id 
            WHERE m.from = '" . Auth::user()->id . "' OR m.to = '" . Auth::user()->id . "'
            ORDER BY m.created_at DESC");

        return response()->json($latestMessages);
    }
}
