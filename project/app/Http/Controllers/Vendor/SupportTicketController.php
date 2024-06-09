<?php

namespace App\Http\Controllers\Vendor;

use App\Helpers\MediaHelper;
use Illuminate\Http\Request;
use App\Models\SupportTicket;
use App\Models\TicketMessage;
use App\Http\Controllers\Controller;
use App\Http\Resources\MessagesResource;

class SupportTicketController extends Controller
{

    public function __construct()
    {
        if(auth()->user()){
            if(auth()->user()->is_vendor != 1){
                return response()->json(['status' => false, 'data' => [], 'error' => ["message" => "You are not authorized to access this page."]]);
            }
    }
        
    }
    public function index()
    {
        
        $user = auth()->user()->is_vendor==1 ? auth()->user() : null;
        $tickets = SupportTicket::where('user_id',$user->id)->latest()->paginate(15);
        
        return response()->json(['status' => true, 'data' => ['tickets' => $tickets], 'error' => []]);
    }

    public function openTicket(Request $request)
    {
        
        $request->validate(['subject'=>'required' , 'message'=>'required','file'=>'mimes:jpeg,jpg,png,PNG,JPG']);
        $user = auth()->user();

        $tkt = 'TKT'.randNum(8);
        $ticket = new SupportTicket();
        $ticket->ticket_num = $tkt;
        $ticket->user_id = $user->id;
        $ticket->subject = $request->subject;
        $ticket->priority = $request->priority;
        $ticket->status = 0;
        $ticket->save();
        
        $message = new TicketMessage();
        $message->ticket_id = $ticket->id;
        $message->ticket_num = $ticket->ticket_num;
        $message->user_id = $user->id;
        $message->message = $request->message;
        if($request->file){
            $message->file = MediaHelper::handleMakeImage($request->file,null,true);
        }
        $message->save();

        return response()->json(['status' => true, 'data' => ['ticket' => $ticket], 'error' => []]);
    }

    public function show($ticket_num)
    {
        $user = auth()->user();
        $data['user'] =[ 'name' => $user->name, 'photo'=> getPhoto($user->photo)];
        $ticket = SupportTicket::where('ticket_num',$ticket_num)->where('user_id',$user->id)->firstOrFail();
        $msgs = TicketMessage::where('ticket_num',$ticket_num)->latest()->paginate(5);
        $message = MessagesResource::collection($msgs)->response()->getData(true);

        return response()->json(['status' => true, 'data' => ['ticket' => $ticket,'messages' => $message], 'error' => []]);
    }

    public function replyTicket(Request $request,$ticket_num)
    {
        $request->validate(['message'=>'required','file'=>'mimes:pdf,jpeg,jpg,png,PNG,JPG']);
        $user = auth()->user();

        $ticket = SupportTicket::where('ticket_num',$ticket_num)->where('user_id',$user->id)
       ->firstOrFail();
       
        $message = new TicketMessage();
        $message->ticket_id = $ticket->id;
        $message->ticket_num = $ticket->ticket_num;
        $message->user_id = $user->id;
        $message->message = $request->message;
        if($request->file){
            $message->file = MediaHelper::handleMakeImage($request->file,null,true);
        }
        $message->save();

        $ticket->status = 0;
        $ticket->save();
        $msg = 'Your ticket has been replied';
        return response()->json(['status' => true, 'data' => ['message' => $msg, 'tickets'=> $ticket], 'error' => []]);
    }
}


