@extends('expert-user-panel.layout.index')
@section('title')
Edit Withdraw
@endsection
@section('content')
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="card">
            <div class="body">
                <form enctype="multipart/form-data" action="{{route('user.coupon.update',$coupon->id)}}" class="checkout" method="post" name="checkout">
                    @method('PUT')
                    @csrf<div class="row clearfix">
                        <div class="col-sm-6">
                            <div class="form-group">           
                                <label for="">Coupon Name</label>                                                 
                                <input type="text" name="name" value="{{$coupon->name}}" class="form-control" placeholder="" required/>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">           
                                <label for="">Coupon Code</label>                                                 
                                <input type="text" name="code" value="{{$coupon->code}}" class="form-control" placeholder="" required/>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">           
                                <label for="">Coupon Percentage</label>                                                 
                                <input type="text" name="percentage" readonly value="{{$coupon->percentage}}" class="form-control" placeholder="" required/>
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