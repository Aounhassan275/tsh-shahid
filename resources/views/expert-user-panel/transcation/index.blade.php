@extends('expert-user-panel.layout.index')
@section('title')
    Trasnfer Balance to Shopping & In Stock Wallet
@endsection
@section('content')
<div class="row clearfix">
    <div class="col-lg-4 col-md-6 col-sm-12">
        <div class="card widget_2 big_icon traffic">
            <div class="body">
                <h6>Balance</h6>
                <h2>{{Auth::user()->balance}} <small class="info"> PKR </small></h2>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-12">
        <div class="card widget_2 big_icon sales">
            <div class="body">
                <h6>Shopping Wallet</h6>
                <h2>{{Auth::user()->shopping_wallet}} <small class="info"> PKR </small></h2>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-12">
        <div class="card widget_2 big_icon domains">
            <div class="body">
                <h6>In Stock Balance</h6>
                <h2>{{Auth::user()->instock_wallet}} <small class="info"> PKR </small></h2>
            </div>
        </div>
    </div>
</div>
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="card">
            <div class="body">
                <form enctype="multipart/form-data" action="{{route('user.balance_transfer.store')}}" method="post" >
                @csrf
                <div class="alert alert-success">
                    You will get {{App\Models\Setting::shoppingReward()}} % of Shopping Reward when you transfer balance to shopping wallet & 
                    You will get {{App\Models\Setting::instockReward()}} % of In Stock Reward when you transfer balance to In Stock wallet.
                </div>
                    <div class="row clearfix">
                        <div class="col-sm-4">
                            <div class="form-group">           
                                <label for="">Transfer To</label>                         
                                <select name="wallet" class="form-control" required>
                                    <option value="">Select Wallet</option>
                                    <option value="Shopping Wallet">Shopping Wallet</option>
                                    <option value="In Stock Wallet">In Stock Wallet</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">           
                                <label for="">Amount To Trasnfer</label>                                                 
                                <input type="number" required step="0.01" name="amount" value="0" class="form-control" placeholder="" />
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group text-right">     
                                <button class="btn btn-primary" type="submit">Transfer</button>      
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection