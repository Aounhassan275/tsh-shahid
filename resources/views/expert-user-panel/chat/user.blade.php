@extends('user.layout.index')

@section('title')
Chat 
@endsection
@section('styles')
<script src="{{asset('admin/global_assets/js/demo_pages/chat_layouts.js')}}"></script>
@endsection

@section('contents')
<div class="row">
    <div class="col-md-12">
        <!-- Basic layout-->
        <div class="card">
            <div class="card-header header-elements-inline">
                <h5 class="card-title">Chat With {{$user->name}} </h5>
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
                            <input type="hidden" name="other_user_id" value="{{$user->id}}"  placeholder="Enter Course Price" class="form-control" required>
                           
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
@endsection