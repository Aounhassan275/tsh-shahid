<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Chat;
use App\Models\ChatMessage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ChatController extends Controller
{
    public $directory;

    public function __construct()
    {
        $this->directory = 'expert-user-panel';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $messages = ChatMessage::where('user_id',null)->get();
        foreach($messages as $message)
        {
            $message->update([
                'status' => 'Read'
            ]);
        }
        return view($this->directory.'.chat.admin');
        // return view($this->directory.'.chat.index');
    }
    public function getUserChat()
    {

        $chats = Chat::select("chats.*")
            ->join("chat_messages", "chat_messages.chat_id", "chats.id")
            ->whereNotNull("chats.other_user_id")
            ->where('chats.user_id',Auth::user()->id)
            ->orWhere('chats.other_user_id',Auth::user()->id)
            ->orderBy("chat_messages.created_at","DESC")->get();        
        $user_ids = $chats->pluck('user_id')->toArray();
        $other_user_id = $chats->pluck('other_user_id')->toArray();
        $user_ids = array_merge($user_ids,$other_user_id);
        $html = view($this->directory.'.chat.partials.chat_index', compact('chats','user_ids'))->render();
        return response()->json([
            'status' => true,
            'html' => $html,
            'message' => 'success',
        ]);
    }
    public function chatWithAdmin()
    {
        $messages = ChatMessage::where('user_id',null)->get();
        foreach($messages as $message)
        {
            $message->update([
                'status' => 'Read'
            ]);
        }
        return view($this->directory.'.chat.admin');
    }
    public function chatWithUser($id)
    {
        $user = User::find($id);
        return view($this->directory.'.chat.user',compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $chat = Chat::create($request->all());
        $message = ChatMessage::create([
            'message' => $request->message,
            'chat_id' => $chat->id,
            'user_id' => Auth::user()->id
        ]);
        toastr()->success('Message Send Successfully');
        if($request->other_user_id)
        {
            return redirect()->route($this->directory.'.chat.index');   
        }else{
            return redirect()->back();   
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Chat  $chat
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $chat = Chat::find($id);
        $messages = ChatMessage::where('chat_id',$id)->where('other_user_id',null)->where('user_id','!=',Auth::user()->id)->get();
        foreach($messages as $message)
        {
            $message->update([
                'status' => 'Read'
            ]);
        }
        
        return view($this->directory.'.chat.show')->with('chat',$chat);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Chat  $chat
     * @return \Illuminate\Http\Response
     */
    public function edit(Chat $chat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Chat  $chat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Chat $chat)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Chat  $chat
     * @return \Illuminate\Http\Response
     */
    public function destroy(Chat $chat)
    {
        //
    }
}
