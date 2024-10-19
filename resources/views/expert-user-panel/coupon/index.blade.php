@extends('expert-user-panel.layout.index')
@section('title')
Coupons
@endsection
@section('content')
<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="header">
                <h2><strong>Coupon</strong> </h2>
                <a href="{{route('user.coupon.create')}}" class="btn btn-primary">Create New Coupon</a>
                <ul class="header-dropdown">
                    <li class="remove">
                        <a role="button" class="boxs-close"><i class="zmdi zmdi-close"></i></a>
                    </li>
                </ul>
            </div>
            <div class="body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                        <thead>
                            <tr>
                                <th>Sr#</th>
                                <th>Coupon Code</th>
                                <th>Coupon Name</th>
                                <th>Coupon Percentage</th>
                                <th>Coupon Orders</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach (Auth::user()->coupons as $key => $coupon)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$coupon->code}}</td>
                                    <td>{{$coupon->name}}</td>
                                    <td>{{$coupon->percentage}}</td>
                                    <td><a href="{{route('user.coupon.show',$coupon->id)}}"> {{$coupon->orders->count()}}</a></td>
                                    <td>
                                        <a href="{{route('user.coupon.edit',$coupon->id)}}"><button class="btn btn-primary">Edit</button></a>
                                        <form action="{{route('user.coupon.destroy',$coupon->id)}}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button class="btn btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection