@extends('expert-user-panel.layout.index')
@section('title')
Dashboard
@endsection
@section('content')
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card">
            <div class="body"> 
                <p>
                    @foreach (App\Models\Ticker::all() as $ticker)
                    {{$ticker->message}} .
                    @endforeach
                </p>
            </div>
        </div>
    </div>
</div>
<div class="row clearfix">
    <div class="col-lg-3 col-md-6 col-sm-12">
        <div class="card widget_2 big_icon traffic">
            <div class="body">
                <h6>Balance</h6>
                <h2>{{Auth::user()->balance}} <small class="info"> PKR </small></h2>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-12">
        <div class="card widget_2 big_icon sales">
            <div class="body">
                <h6>Direct Earning</h6>
                <h2>{{Auth::user()->earnings()->where('type','direct_income')->sum('price') + Auth::user()->earnings()->where('type','direct_income')->sum('temp_price')}} <small class="info">PKR</small></h2>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-12">
        <div class="card widget_2 big_icon domains">
            <div class="body">
                <h6>Indirect Earning</h6>
                <h2>{{Auth::user()->earnings()->where('type','indirect_income')->sum('price')}} <small class="info">PKR</small></h2>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-12">
        <div class="card widget_2 domains">
            <div class="body">
                <h6>Package Active </h6>
                <h2>{{Auth::user()->a_date ? Carbon\Carbon::parse(Auth::user()->a_date)->format('d M,Y') : ''}}</h2>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-12">
        <div class="card widget_2 big_icon ">
            <div class="body">
                <h6>Shopping Wallet</h6>
                <h2>{{Auth::user()->shopping_wallet}} <small class="info">PKR</small></h2>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-12">
        <div class="card widget_2 big_icon ">
            <div class="body">
                <h6>Amount of Shop</h6>
                <h2>{{Auth::user()->amount_for_shop}} <small class="info">PKR</small></h2>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-12">
        <div class="card widget_2 big_icon ">
            <div class="body">
                <h6>Total Shopping</h6>
                <h2>{{Auth::user()->orders->sum('price')}} <small class="info">PKR</small></h2>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-12">
        <div class="card widget_2 big_icon ">
            <div class="body">
                <h6>Shopping Reward</h6>
                <h2>{{Auth::user()->earnings()->where('type','personal_reward')->sum('price')}} <small class="info">PKR</small></h2>
            </div>
        </div>
    </div>
</div>
<div class="row clearfix">
    <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card state_w1">
            <div class="body d-flex justify-content-between">
                <div>
                    <h5>{{Auth::user()->instock_wallet}}</h5>
                    <span><i class="zmdi zmdi-eye col-amber"></i> In Stock Balance</span>
                </div>
                <div class="sparkline" data-type="bar" data-width="97%" data-height="55px" data-bar-Width="3" data-bar-Spacing="5" data-bar-Color="#FFC107">5,2,3,7,6,4,8,1</div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card state_w1">
            <div class="body d-flex justify-content-between">
                <div>                                
                    <h5>{{Auth::user()->earnings()->where('type','monthly_instock_reward')->sum('price')}}</h5>
                    <span><i class="zmdi zmdi-thumb-up col-blue"></i> Monthly In Stock Profit</span>
                </div>
                <div class="sparkline" data-type="bar" data-width="97%" data-height="55px" data-bar-Width="3" data-bar-Spacing="5" data-bar-Color="#46b6fe">8,2,6,5,1,4,4,3</div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card state_w1">
            <div class="body d-flex justify-content-between">
                <div>
                    <h5>PKR {{Auth::user()->earnings()->where('type','monthly_team_profit')->sum('price')}}</h5>
                    <span><i class="zmdi zmdi-comment-text col-red"></i> Monthly Team Profit</span>
                </div>
                <div class="sparkline" data-type="bar" data-width="97%" data-height="55px" data-bar-Width="3" data-bar-Spacing="5" data-bar-Color="#ee2558">4,4,3,9,2,1,5,7</div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card state_w1">
            <div class="body d-flex justify-content-between">
                <div>                            
                    <h5>
                        {{Auth::user()->earnings()->where('type','monthly_team_profit')->sum('price')+Auth::user()->earnings()->where('type','monthly_instock_reward')->sum('price')}}
                    </h5>
                    <span><i class="zmdi zmdi-account text-success"></i> Total In Stock Profit</span>
                </div>
                <div class="sparkline" data-type="bar" data-width="97%" data-height="55px" data-bar-Width="3" data-bar-Spacing="5" data-bar-Color="#04BE5B">7,5,3,8,4,6,2,9</div>
            </div>
        </div>
    </div>
</div>
<div class="row clearfix">
    <div class="col-md-12 col-lg-3">
        <div class="card">
            <div class="body">
                <h3 class="mt-0 mb-0">{{Auth::user()->orders->count()}}</h3>
                <p class="text-muted">Total Orders</p>
                <div class="progress">
                    <div class="progress-bar l-purple" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                </div>
                {{-- <small>21% higher than last month</small> --}}
            </div>
        </div>
    </div>
    <div class="col-md-12 col-lg-3">
        <div class="card">
            <div class="body">
                <h3 class="mt-0 mb-0">{{Auth::user()->coupons->count()}}</h3>
                <p class="text-muted">Total Coupons</p>
                <div class="progress">
                    <div class="progress-bar l-cyan" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12 col-lg-3">
        <div class="card">
            <div class="body">
                <h3 class="mt-0 mb-0">PKR {{Auth::user()->orders->sum('price')}}</h3>
                <p class="text-muted">Total Order Price</p>
                <div class="progress">
                    <div class="progress-bar l-blush" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12 col-lg-3">
        <div class="card">
            <div class="body">
                <h3 class="mt-0 mb-0">PKR {{Auth::user()->couponSales()}}</h3>
                <p class="text-muted">Coupon Sales</p>
                <div class="progress">
                    <div class="progress-bar l-blue" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@if (Auth::user()->checkstatus() =='old')

<div class="row clearfix">
    <div class="col-md-12 col-lg-3">
        <div class="card">
            <div class="body">
                <h3 class="mt-0 mb-0">PKR 0</h3>
                <p class="text-muted">Total Installement</p>
                <div class="progress">
                    <div class="progress-bar l-amber" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                </div>
                {{-- <small>21% higher than last month</small> --}}
            </div>
        </div>
    </div>
    <div class="col-md-12 col-lg-3">
        <div class="card">
            <div class="body">
                <h3 class="mt-0 mb-0">PKR 0</h3>
                <p class="text-muted">Total Paid Installement</p>
                <div class="progress">
                    <div class="progress-bar l-pink" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12 col-lg-3">
        <div class="card">
            <div class="body">
                <h3 class="mt-0 mb-0">PKR 0</h3>
                <p class="text-muted">Total Pending Installement</p>
                <div class="progress">
                    <div class="progress-bar l-green" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12 col-lg-3">
        <div class="card">
            <div class="body">
                <h3 class="mt-0 mb-0">0</h3>
                <p class="text-muted">Member Rank</p>
                <div class="progress">
                    <div class="progress-bar l-red" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- <div id="user-tree"></div> --}}

{{-- @if(Auth::user()->package && Auth::user()->package->package_level_rewards()->where('type',1)->count() > 0)
<div class="row clearfix">
    <div class="col-sm-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="header">
                <h2><strong>Level</strong> Progress</h2>
                <ul class="header-dropdown">
                    <li class="remove">
                        <a role="button" class="boxs-close"><i class="zmdi zmdi-close"></i></a>
                    </li>
                </ul>
            </div>
            <div class="table-responsive">
                <table class="table table-hover c_table">
                    <thead>
                        <tr>
                            <th class="text-center">Level</th>
                            <th class="text-center">Total Users Allowed</th>
                            <th class="text-center">Total Users Exist</th>
                            <th class="text-center">Reward</th>
                            <th class="text-center">Reward Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach(Auth::user()->package->package_level_rewards()->where('type',1)->get() as $key => $reward)
                        <tr>
                            @php 
                            $index = $key+1;
                            @endphp
                            <td class="text-center">Level {{$index}}</td>
                            <td class="text-center">{{config('services.levels.'.$index)}}</td>
                            <td class="text-center"> {{count(Auth::user()->getLevelStatus($index))}}</td>
                            <td class="text-center">
                                @if(config('services.levels.'.$index) == count(Auth::user()->getLevelStatus($index)))
                                    <span class="badge badge-success">{{$reward->title}}</span>
                                @else 
                                    <span class="badge badge-danger">{{$reward->title}}</span>
                                @endif
                            </td> 
                            <td class="text-center">
                                @if(Auth::user()->getLevelRewardStatus($index))
                                    @if(Auth::user()->getLevelRewardStatus($index)->status)
                                        <span class="badge badge-success">{{Auth::user()->getLevelRewardStatus($index)->name}}</span>
                                    @else
                                        <span class="badge badge-danger">{{Auth::user()->getLevelRewardStatus($index)->name}}</span>
                                    @endif
                                @else 
                                    @if($reward->title == 'NIL' && config('services.levels.'.$index) == count(Auth::user()->getLevelStatus($index)))
                                        <span class="badge badge-success">{{$reward->title}}</span>
                                    @endif
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div> 
@else --}}
{{-- <div class="row clearfix">
    <div class="col-sm-12 col-md-12 col-lg-12">
        <div class="card">
            <div class="header">
                <h2><strong>Level</strong> Progress</h2>
                <ul class="header-dropdown">
                    <li class="remove">
                        <a role="button" class="boxs-close"><i class="zmdi zmdi-close"></i></a>
                    </li>
                </ul>
            </div>
            <div class="table-responsive">
                <table class="table table-hover c_table">
                    <thead>
                        <tr>
                            <th class="text-center">Level</th>
                            <th class="text-center">Total Users Allowed</th>
                            <th class="text-center">Total Users Exist</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-center">Level 1</td>
                            <td class="text-center">{{config('services.levels.1')}}</td>
                            <td class="text-center">{{count(Auth::user()->level_1())}}</td>
                        </tr>
                        <tr>
                            <td  class="text-center">Level 2</td>
                            <td  class="text-center">{{config('services.levels.2')}}</td>
                            <td  class="text-center">{{count(Auth::user()->level_2())}}</td>
                        </tr>
                        <tr>
                            <td  class="text-center">Level 3</td>
                            <td  class="text-center">{{config('services.levels.3')}}</td>
                            <td  class="text-center">{{count(Auth::user()->level_3())}}</td>
                        </tr>
                        <tr>
                            <td  class="text-center">Level 4</td>
                            <td  class="text-center">{{config('services.levels.4')}}</td>
                            <td  class="text-center">{{count(Auth::user()->level_4())}}</td>
                        </tr>
                        <tr>
                            <td  class="text-center">Level 5</td>
                            <td  class="text-center">{{config('services.levels.5')}}</td>
                            <td  class="text-center">{{count(Auth::user()->level_5())}}</td>
                        </tr>
                        <tr>
                            <td  class="text-center">Level 6</td>
                            <td  class="text-center">{{config('services.levels.6')}}</td>
                            <td  class="text-center">{{count(Auth::user()->level_6())}}</td>
                        </tr>
                        <tr>
                            <td  class="text-center">Level 7</td>
                            <td  class="text-center">{{config('services.levels.7')}}</td>
                            <td  class="text-center">{{count(Auth::user()->level_7())}}</td>
                        </tr>
                        <tr>
                            <td  class="text-center">Level 8</td>
                            <td  class="text-center">{{config('services.levels.8')}}</td>
                            <td  class="text-center">{{count(Auth::user()->level_8())}}</td>
                        </tr>
                        <tr>
                            <td  class="text-center">Level 9</td>
                            <td  class="text-center">{{config('services.levels.9')}}</td>
                            <td  class="text-center">{{count(Auth::user()->level_9())}}</td>
                        </tr>
                        <tr>
                            <td  class="text-center">Level 10</td>
                            <td  class="text-center">{{config('services.levels.10')}}</td>
                            <td  class="text-center">{{count(Auth::user()->level_10())}}</td>
                        </tr>
                        <tr>
                            <td  class="text-center">Level 11</td>
                            <td  class="text-center">{{config('services.levels.11')}}</td>
                            <td  class="text-center">{{count(Auth::user()->level_11())}}</td>
                        </tr>
                        <tr>
                            <td  class="text-center">Level 12</td>
                            <td  class="text-center">{{config('services.levels.12')}}</td>
                            <td  class="text-center">{{count(Auth::user()->level_12())}}</td>
                        </tr>
                        <tr>
                            <td  class="text-center">Level 13</td>
                            <td  class="text-center">{{config('services.levels.13')}}</td>
                            <td  class="text-center">{{count(Auth::user()->level_13())}}</td>
                        </tr>
                        <tr>
                            <td  class="text-center">Level 14</td>
                            <td  class="text-center">{{config('services.levels.14')}}</td>
                            <td  class="text-center">{{count(Auth::user()->level_14())}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>  --}}
{{-- @endif --}}
@endif
@endsection

@section('scripts')
{{-- <script>
    var user_id = "{{Auth::user()->id}}";
    getTree(user_id);
    function getTree(user_id)
    {  
        $.ajax({
            url: "{{route('user.refer.getTree')}}",
            method: 'post',
            data: {
                id: user_id,
            },
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            success: function(response){
                $('#user-tree').html(response.html)
            }
        });
    }
</script> --}}
@endsection