@extends('admin.layout.index')

@section('title')
{{$chat->user->name}} Chat 
@endsection
@section('styles')
<script src="{{asset('admin/global_assets/js/demo_pages/chat_layouts.js')}}"></script>
@endsection

@section('contents')
<div class="card">
    <div class="row no-gutters">
        <div class="col-12 col-lg-12 col-xl-12">
            <div class="py-2 px-4 border-bottom d-none d-lg-block">
                <div class="media align-items-center py-1">
                    <div class="position-relative">
                        <img src="{{asset($chat->user->image)}}" class="rounded-circle mr-1" alt="{{$chat->user->name}}" width="40" height="40">
                    </div>
                    <div class="media-body pl-3">
                        <strong>Chat With {{$chat->user->name}}</strong>
                        {{-- <div class="text-muted small"><em>Typing...</em></div> --}}
                    </div>
                </div>
            </div>

            <div class="position-relative">
                <div class="chat-messages p-4">
                    @foreach($chat->messages as $message)
                    @if($message->user_id)

                        <div class="chat-message-left pb-4">
                            <div>
                                <img src="{{asset($message->user->image)}}" class="rounded-circle mr-1" alt="Chris Wood" width="40" height="40">
                                <div class="text-muted small text-nowrap mt-2">{{$message->created_at->format('M d,Y H:i A')}}</div>
                            </div>
                            <div class="flex-shrink-1 bg-light rounded py-2 px-3 mr-3">
                                <div class="font-weight-bold mb-1">{{$chat->user->name}}</div>
                                {{$message->message}}
                            </div>
                        </div>
                    @else
                        <div class="chat-message-right pb-4">
                            <div>
                                <img src="{{asset('img\avatars\avatar.jpg')}}" class="rounded-circle mr-1" alt="Bertha Martin" width="40" height="40">
                                <div class="text-muted small text-nowrap mt-2">{{$message->created_at->format('M d,Y H:i A')}}</div>
                            </div>
                            <div class="flex-shrink-1 bg-light rounded py-2 px-3 ml-3">
                                <div class="font-weight-bold mb-1">You</div>
                                {{$message->message}}
                                @if($message->status == "Unread")
                                <span class="badge badge-primary">{{$message->status}}</span>
                                @else 
                                <span class="badge badge-primary">{{$message->status}}</span>
                                @endif
                            </div>
                        </div>
                    @endif
                    @endforeach
                </div>
            </div>
            <div class="flex-grow-0 py-3 px-4 border-top">
                <form action="{{route('admin.chatmessage.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                    <div class="input-group">
                        <input type="hidden" name="admin_id" value="{{Auth::user()->id}}"  placeholder="Enter Course Price" class="form-control" required>
                        <input type="hidden" name="chat_id" value="{{$chat->id}}"  placeholder="Enter Course Price" class="form-control" required>
                        <input name="message" type="text" class="form-control" placeholder="Type your message">
                        <div class="input-group-append">
                            <button class="btn btn-primary">Send</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
@endsection