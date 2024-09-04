@extends('admin.layout.index')

@section('contents')

<div class="col-12 ">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">View Chat Table</h5>
            <div class="row">
                <div class="col-md-12 pull-right">
                    <button data-toggle="modal"  data-target="#create_modal" class="btn btn-success  float-right complete-btn" type="button">Create Chat</button>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <table id="datatables-buttons" class="table table-striped ">
                <thead>
                    <tr>
                        <th style="width:auto;">Sr#</th>
                        <th style="width:auto;">User Image</th>
                        <th style="width:auto;">User Name</th>
                        <th style="width:auto;">User Email</th>
                        <th style="width:auto;">Unread Messages</th>
                        <th style="width:auto;">Action</th>
                    </tr>
                </thead>
                <tbody> 
                    @foreach (App\Models\Chat::where('other_user_id',null)->get() as $key => $chat)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td><img src="{{asset($chat->user->image)}}" style="width:100px;height:auto;"></td>
                        <td>{{$chat->user->name}}</td>
                        <td>{{$chat->user->email}}</td>
                        <td>
                            <button type="button" class="btn btn-primary btn-sm">{{$chat->messages->where('status','Unread')->where('admin_id',null)->count()}}</button>
                        </td>
                        <td>
                            <a href="{{route('admin.chat.show',$chat->id)}}">
                                <button type="button" class="btn btn-success btn-sm">View</button>
                            </a> 
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<div id="create_modal" class="modal fade">
    <div class="modal-dialog">
        <form action="{{route('admin.chat.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="myModalLabel">Create Chat</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Enter Your Message</label>
                        <textarea name="message" id="" cols="30" rows="2" class="form-control"></textarea>
                    </div>  
                    <div class="form-group">
                        <label>Select User</label>
                        <select name="user_id"  class="form-control select2" required>
                            <option selected disabled>Select</option>
                            @foreach(App\Models\User::all() as $user)
                                @if($user->chats->count() == 0)
                                <option value="{{$user->id}}" >{{$user->name}}</option>
                                @endif
                            @endforeach
                        </select>  
                    </div>    
                    <input type="hidden" name="admin_id" value="{{Auth::user()->id}}"  placeholder="Enter Course Price" class="form-control" required>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary waves-effect waves-light">Create</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
@section('scripts')
<script>
    $(function() {
       // Select2
       $(".select2").each(function() {
           $(this)
               .wrap("<div class=\"position-relative\"></div>")
               .select2({
                   placeholder: "Select Category",
                   dropdownParent: $(this).parent()
               });
       })
   });
</script>
<script>
    $(function() {
        // Datatables with Buttons
        var datatablesButtons = $("#datatables-buttons").DataTable({
            // responsive: true,
            // lengthChange: !1,
            buttons: ["copy", "print"]
        });
        datatablesButtons.buttons().container().appendTo("#datatables-buttons_wrapper .col-md-6:eq(0)");
    });
</script>
@endsection