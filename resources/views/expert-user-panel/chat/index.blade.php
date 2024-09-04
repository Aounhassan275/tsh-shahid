@extends('user.layout.index')
@section('contents')
{{-- <div class="card"> --}}
    {{-- <div class="card-header header-elements-inline">
        <h5 class="card-title">View Your Chat With User</h5>
        <div class="header-elements">
            <div class="list-icons">
                <button data-toggle="modal"  data-target="#create_modal" class="btn btn-success  float-right complete-btn" type="button">Create Chat</button>
                <a class="list-icons-item" data-action="collapse"></a>
                <a class="list-icons-item" data-action="reload"></a>
                <a class="list-icons-item" data-action="remove"></a>
            </div>
        </div>
    </div> --}}

    {{-- <table class="table  datatable-basic datatable-row-basic">
        <thead>
            <tr>
                <th>Sr#</th>
                <th>User Image</th>
                <th>User Name</th>
                <th>User Email</th>
                <th>Unread Messages</th>
                <th>Action</th>
            </tr> 
        </thead>
        <tbody>
            @foreach ($chats as $key => $chat)
            @if($chat->other_user_id == Auth::user()->id)
            <tr> 
                <td>{{$key+1}}</td>
                <td><img src="{{asset($chat->user->image)}}" style="width:100px;height:auto;"></td>
                <td>{{$chat->user->name}}</td>
                <td>{{$chat->user->email}}</td>
                <td>
                    <button type="button" class="btn btn-primary btn-sm">{{$chat->messages->where('status','Unread')->count()}}</button>
                </td>
                <td>
                    <a href="{{route('user.chat.show',$chat->id)}}">
                        <button type="button" class="btn btn-success btn-sm">View</button>
                    </a> 
                </td>
            </tr>
            @else 
            <tr> 
                <td>{{$key+1}}</td>
                <td><img src="{{asset(@$chat->member->image)}}" style="width:100px;height:auto;"></td>
                <td>{{$chat->member->name}}</td>
                <td>{{$chat->member->email}}</td>
                <td>
                    <button type="button" class="btn btn-primary btn-sm">{{$chat->messages->where('status','Unread')->count()}}</button>
                </td>
                <td>
                    <a href="{{route('user.chat.show',$chat->id)}}">
                        <button type="button" class="btn btn-success btn-sm">View</button>
                    </a> 
                </td>
            </tr>
            @endif
            @endforeach
        </tbody>
    </table> --}}
{{-- </div> --}}
    <div id="chat-content">
        
    </div>
    {{-- <div id="create_modal" class="modal fade">
        <div class="modal-dialog">
            <form action="{{route('user.chat.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title mt-0" id="myModalLabel">Create Chat</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Enter Your Message</label>
                            <textarea name="message" id="" cols="30" rows="2" required class="form-control"></textarea>
                        </div>  
                        <div class="form-group">
                            <label>Select User</label>
                        
                            <select data-placeholder="Enter 'as'" required name="other_user_id" id="other_user_id" class="form-control select-minimum " data-fouc>
                                <option></option>
                                <optgroup label="Members">
                                    @foreach(App\Models\User::all() as $user)
                                        @if(!in_array($user->id,$user_ids))
                                        <option value="{{$user->id}}">{{$user->name}}</option>
                                    @endif
                                    @endforeach
                                </optgroup>
                            </select>
                        
                        <input type="hidden" name="user_id" value="{{Auth::user()->id}}"  placeholder="Enter Course Price" class="form-control" required>
                    
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary waves-effect waves-light">Create</button>
                    </div>
                </div>
            </form>
        </div>
    </div> --}}
@endsection
@section('scripts')
<script>
    getChats();
    function getChats() {
        $('#chat-content').html("");
        $.ajax({
            url: "{{ url('user/get_user_chats') }}",
            type: "GET",
            // headers: {
            //     'X-CSRF-TOKEN': '{{ csrf_token() }}'
            // },
            // dataType: 'JSON',
            // data: {
            //     'shared_user_id': shared_user,
            //     'group_id': group_id,
            //     'type': type,
            //     'borrower_id': borrower_id,
            // },
            success: function(response) {
                $('#chat-content').html(response.html);
            }
        });

    }
</script>
@endsection