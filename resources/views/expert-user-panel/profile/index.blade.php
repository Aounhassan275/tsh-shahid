@extends('expert-user-panel.layout.index')
@section('title')
Profile
@endsection
@section('content')

<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="card">
            <div class="body">
                <form enctype="multipart/form-data" action="{{route('user.user.update',Auth::user()->id)}}" class="checkout" method="post" name="checkout">
                    @method('PUT')
                    @csrf
                    <div class="row clearfix">
                        <div class="col-sm-6">
                            <div class="form-group">           
                                <label for="">User Email</label>                                                 
                                <input type="email" name="email" value="{{Auth::user()->email}}" class="form-control" placeholder="" required/>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">           
                                <label for="">Password <small style="color:red;">(Leave it Blank if you don't want to change)</small></label>                                                 
                                <input type="password" name="password" class="form-control" placeholder="" />
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">           
                                <label for="">Account Holder Name</label>                                                 
                                <input type="text" name="account_holder" value="{{Auth::user()->account_holder}}" class="form-control" placeholder="" required/>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">           
                                <label for="">Account Name</label>                                                 
                                <input type="text" name="account_number" value="{{Auth::user()->account_number}}" class="form-control" placeholder="" required/>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">           
                                <label for="">Payment Method</label>                                                 
                                <select class="form-control show-tick ms search-select" name="payment_method" data-placeholder="Select">
                                    <option value="">Select a Payment Method</option>
                                    @foreach(App\Models\Source::all() as $source)
                                        <option @if($source->name == Auth::user()->payment_method) selected @endif value="{{$source->name}}">{{$source->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group text-right">     
                                <button class="btn btn-primary" type="submit">Update</button>      
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection