@extends('expert-user-panel.layout.index')

@section('title')
Chat 
@endsection
@section('styles')
@endsection

@section('content')
@if(Auth::user()->chats->count() == 0)
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            
            <div class="chat_list">
                <ul class="user_list list-unstyled mb-0 mt-3">
                    <li class="active">
                        <a href="javascript:void(0);">
                            <img src="{{asset('expert-user-panel-template/assets/images/xs/avatar2.jpg')}}" alt="avatar" />
                            <div class="about">
                                <div class="name">Admin</div>
                                <div class="status me"> <i class="zmdi zmdi-circle"></i> online </div>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="chat_window body">
                <div class="chat-header">
                    <div class="user">
                        <img src="{{asset('expert-user-panel-template/assets/images/xs/avatar2.jpg')}}" alt="avatar" />
                        <div class="chat-about">
                            <div class="chat-with">Admin</div>
                            {{-- <div class="chat-num-messages">already 8 messages</div> --}}
                        </div>
                    </div>
                    <a href="javascript:void(0);" class="list_btn btn btn-info btn-round float-md-right"><i class="zmdi zmdi-comments"></i></a>
                </div>
                <hr>
                <div class="chat-box">
                    
                    <form action="{{route('user.chat.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="user_id" value="{{Auth::user()->id}}"  placeholder="Enter Course Price" class="form-control" required>
                        <input type="text" name="message" class="form-control" placeholder="Enter text here..." required>
                        
                        <button type="submit" class="btn btn-primary">
                            Send <i class="zmdi zmdi-mail-send"></i>
                        </button>
                        
                    </form>                                                          
                </div>
            </div>
        </div>
    </div>
</div>
@else 
    @foreach(Auth::user()->adminChat() as $chat) 
    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card">
                
                <div class="chat_list">
                    <ul class="user_list list-unstyled mb-0 mt-3">
                        <li class="active">
                            <a href="javascript:void(0);">
                                <img src="{{asset('expert-user-panel-template/assets/images/xs/avatar2.jpg')}}" alt="avatar" />
                                <div class="about">
                                    <div class="name">Admin</div>
                                    <div class="status me"> <i class="zmdi zmdi-circle"></i> online </div>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="chat_window body">
                    <div class="chat-header">
                        <div class="user">
                            <img src="{{asset('expert-user-panel-template/assets/images/xs/avatar2.jpg')}}" alt="avatar" />
                            <div class="chat-about">
                                <div class="chat-with">Admin</div>
                                {{-- <div class="chat-num-messages">already 8 messages</div> --}}
                            </div>
                        </div>
                        <a href="javascript:void(0);" class="list_btn btn btn-info btn-round float-md-right"><i class="zmdi zmdi-comments"></i></a>
                    </div>
                    <hr>
                    <ul class="chat-history">
                        @foreach($chat->messages as $message)
                            @if($message->admin_id)
                                
                                <li>
                                    <div class="status message-data">
                                        <span class="name">Admin</span>
                                        <span class="time">{{$message->created_at->format('M d,Y h:i A')}}</span>
                                    </div>
                                    <div class="message my-message">
                                        <p>
                                            {{$message->message}}
                                        </p>
                                    </div>
                                </li>    

                            @else 
                                <li class="clearfix">
                                    <div class="status online message-data text-right">
                                        <span class="time">{{$message->created_at->format('M d,Y h:i A')}}</span>
                                        <span class="name">You</span>
                                        @if($message->status == "Unread")

                                        <i class="zmdi zmdi-circle me" style="color:red;"></i>
                                        @else 
                                        <i class="zmdi zmdi-circle me"></i>
                                        @endif
                                    </div>
                                    <div class="message other-message float-right"> 
                                        {{$message->message}}
                                    </div>
                                </li>

                            @endif
                        @endforeach                    
                        {{-- <li>
                            <div class="status message-data">
                                <span class="name">Aiden</span>
                                <span class="time">10:31 AM, Today</span>
                            </div>
                            <i class="zmdi zmdi-circle" style="color: #04BE5B; font-size: 10px;"></i>
                            <i class="zmdi zmdi-circle" style="color: #83d0a7; font-size: 10px;"></i>
                            <i class="zmdi zmdi-circle" style="color:#DAE9DA; font-size: 10px;"></i>
                        </li> --}}
                    </ul>
                    <div class="chat-box">
                        
                        <form action="{{route('user.chatmessage.store')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="user_id" value="{{Auth::user()->id}}"  placeholder="Enter Course Price" class="form-control" required>
                            <input type="hidden" name="chat_id" value="{{$chat->id}}"  placeholder="Enter Course Price" class="form-control" required>                
                            <input type="text" name="message" class="form-control" placeholder="Enter text here..." required>
                            
                            <button type="submit" class="btn btn-primary">
                                Send <i class="zmdi zmdi-mail-send"></i>
                            </button>
                            
                        </form>                                                          
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
@endif
{{-- @if(Auth::user()->chats->count() == 0)
<div class="row">
    <div class="col-md-12">
        <!-- Basic layout-->
        <div class="card">
            <div class="card-header header-elements-inline">
                <h5 class="card-title">Chat With Admin </h5>
                <div class="header-elements">
                    <div class="list-icons">
                        <a class="list-icons-item" data-action="collapse"></a>
                        <a class="list-icons-item" data-action="remove"></a>
                    </div>
                </div>
            </div> 

            <div class="card-body">
                <form action="{{route('user.chat.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Enter Your Message</label>
                                <textarea name="message" id="" cols="30" rows="10" class="form-control"></textarea>
                            </div>    
                            <input type="hidden" name="user_id" value="{{Auth::user()->id}}"  placeholder="Enter Course Price" class="form-control" required>
                           
                        </div>
                    </div>
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">Send Message 
                            <i class="icon-plus22 ml-2"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <!-- /basic layout -->

    </div>
</div>
@else 
@foreach(Auth::user()->adminChat() as $chat) 
<div class="card">
    <div class="card-header header-elements-inline">
        <h5 class="card-title">Chat With Admin</h5>
        <div class="header-elements">
            <div class="list-icons">
                <a class="list-icons-item" data-action="collapse"></a>
                <a class="list-icons-item" data-action="reload"></a>
                <a class="list-icons-item" data-action="remove"></a>
            </div>
        </div>
    </div>

    <div class="card-body">
        <ul class="media-list media-chat mb-3">
            @foreach($chat->messages as $message)
            @if($message->admin_id)
            <li class="media">
                <div class="mr-3">
                    <a href="#">
                        <img src="{{asset('img\avatars\avatar.jpg')}}" class="rounded-circle" width="40" height="40" alt="">
                    </a>
                </div>

                <div class="media-body">
                    <div class="media-chat-item bg-slate border-slate">{{$message->message}}</div>
                    <div class="font-size-sm text-muted mt-2">{{$message->created_at->format('M d,Y H:i A')}}</div>
                </div>
            </li>
            @else 
            <li class="media media-chat-item-reverse">
                <div class="media-body">
                    <div class="media-chat-item bg-info border-info">{{$message->message}}</div>
                    <div class="font-size-sm text-muted mt-2">{{$message->created_at->format('M d,Y H:i A')}}
                        @if($message->status == "Unread")
                        <span class="badge badge-primary">{{$message->status}}</span>
                        @else 
                        <span class="badge badge-primary">{{$message->status}}</span>
                        @endif
                    </div>
                </div>
                <div class="ml-3">
                    <a href="#">
                        <img src="{{asset($message->user->image)}}" class="rounded-circle" width="40" height="40" alt="">
                    </a>
                </div>
            </li>
            @endif
            @endforeach
        </ul>
        <form action="{{route('user.chatmessage.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            <textarea name="message" class="form-control mb-3" rows="3" cols="1" placeholder="Enter your message..."></textarea>
            <input type="hidden" name="user_id" value="{{Auth::user()->id}}"  placeholder="Enter Course Price" class="form-control" required>
            <input type="hidden" name="chat_id" value="{{$chat->id}}"  placeholder="Enter Course Price" class="form-control" required>

            <div class="d-flex align-items-center">

                <button type="submit" class="btn bg-teal-400 btn-labeled btn-labeled-right ml-auto"><b><i class="icon-paperplane"></i></b> Send</button>
            </div>
        </form>
    </div>
</div>
@endforeach --}}
{{-- @endif --}}
@endsection