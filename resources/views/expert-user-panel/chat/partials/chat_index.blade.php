<div class="card">
    <div class="card-header bg-transparent header-elements-inline">
        <span class="card-title font-weight-semibold">Chats</span>
        <div class="header-elements">
            <div class="list-icons">
                <a class="list-icons-item" data-action="collapse"></a>  
                <a class="list-icons-item" data-action="reload"></a>
                <a class="list-icons-item" data-action="remove"></a>
            </div>
        </div>
    </div>

    <div class="card-body">
        <form action="#">
            <div class="form-group-feedback form-group-feedback-right">
                <input type="text" id="search" name="search" class="form-control" placeholder="Search...">
                <div class="form-control-feedback">
                    <i class="icon-search4 font-size-base text-muted"></i>
                </div>
            </div>
            <br>
            <ul class="media-list">
                <p>Old Chats</p>
                @foreach ($chats as $key => $chat)
                @php 
                $message = $chat->messages->last();
                @endphp
                @if($chat->other_user_id == Auth::user()->id)
                <li class="media" @if($message->user_id != Auth::user()->id && $message->status == 'Unread') style="background-color:ghostwhite!important;" @endif>
                    <a href="#" class="mr-3">
                        <img src="{{asset($chat->user->image)}}" width="36" height="36" class="rounded-circle" alt="">
                    </a>
                    <div class="media-body">
                        <a href="#" class="media-title font-weight-semibold">{{$chat->user->name}}</a>
                        <div class="font-size-sm text-muted">@if($message->user_id == Auth::user()->id )@if($message->status == 'Unread')<i class="icon-check"></i>@else<i class="icon-double"></i>@endif @endif {{@$chat->messages->last()->message}}</div>
                    </div>
                    <div class="ml-3 align-self-center">
                        @if($message->user_id != Auth::user()->id && $message->status == 'Unread' && $chat->messages->where('status','Unread')->count() > 0)
                        <span class="badge badge-success">{{$chat->messages->where('status','Unread')->count()}}</span>
                        @endif
                    </div>
                </li>
                @else 
                <li class="media" @if($message->user_id != Auth::user()->id && $message->status == 'Unread') style="background-color:ghostwhite!important;" @endif>
                    <a href="#" class="mr-3">
                        <img src="{{asset($chat->member->image)}}" width="36" height="36" class="rounded-circle" alt="">
                    </a>
                    <div class="media-body">
                        <a href="#" class="media-title font-weight-semibold">{{$chat->member->name}}</a>
                        <div class="font-size-sm text-muted">@if($message->user_id == Auth::user()->id )@if($message->status == 'Unread')<i class="icon-check"></i>@else<i class="icon-double"></i>@endif @endif {{@$chat->messages->last()->message}}</div>
                    </div>
                    <div class="ml-3 align-self-center">
                        @if($message->user_id != Auth::user()->id && $message->status == 'Unread' && $chat->messages->where('status','Unread')->count() > 0)
                        <span class="badge badge-success">{{$chat->messages->where('status','Unread')->count()}}</span>
                        @endif
                    </div>
                </li>
                @endif
                @endforeach
            </ul>
        </form>
    </div>
</div>