<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Order;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public $directory;
    private $months;
    private $timeFormat;
    private $DateFormat;

    public function __construct()
    {
        $this->directory = 'expert-user-panel';
        
        $this->months = [
            "January", "February", "March",
            "April", "May", "June", "July",
            "August", "September", "October",
            "November", "December"
        ];

        $this->timeFormat = 'Y-m-d H:i:s';
        $this->DateFormat = 'Y-m-d';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        $data['default_to']   = date($this->timeFormat);
        $data['default_from'] = date($this->timeFormat, strtotime("-30 days", strtotime($data['default_to'])));
        $to     = $request->input('to');
        $from   = $request->input('from');

        if(empty($to))
        {
            $to = $data['default_to'];
        }

        if(empty($from))
        {
            $from = $data['default_from'];
        }

        //-01 tells that it is date in yyyy-mm format not in timestamp format
        $fromDate       = new Carbon($from);
        $toDate         = new Carbon($to);

        $fromDate->startOfDay();
        $from = $fromDate->format($this->timeFormat);

        $toDate->endOfDay();
        $to = $toDate->format($this->timeFormat);

        if($fromDate->greaterThan($toDate)){
            toastr()->error('From cannot a be a date after To date!.');
            return back()->withInput();
        }
        $data['default_to']   = $to;
        $data['default_from'] = $from;
        $orders = Order::where('user_id',Auth::user()->id)->whereBetween('created_at',[$from, $to])->get();
        return view($this->directory.'.product.order',compact('orders','data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $total_amount = $request->price + $request->delivery_cost;
        if($request->order_type == 1 && $total_amount > Auth::user()->amount_for_shop)
        {
            toastr()->error('Shopping Amount is less than Product Price!.');
            return back();
        }else if($request->order_type == 2 && $total_amount > Auth::user()->balance)
        {
            toastr()->error('Your Balance is less than Product Price!.');
            return back();
        }else if ($request->order_type == 3 && $total_amount > Auth::user()->totalAvailableBalance())
        {
            toastr()->error('Your Balance and Shopping Amount Combin is less than Product Price!.');
            return back();
        }else if ($request->order_type == 5 && $total_amount > Auth::user()->balance)
        {
            toastr()->error('Your Balance is less than Product Price!.');
            return back();
        }
        if($request->coupon_code){
            $request->merge([
                'coupon_id' => Coupon::where('code',$request->coupon_code)->first()->id
            ]);
        }
        Order::create($request->all());
        if($request->order_type == 1)
        {
            Auth::user()->update([
                'amount_for_shop' => Auth::user()->amount_for_shop -= $total_amount
            ]);
        }else if($request->order_type == 2)
        {
            Auth::user()->update([
                'balance' => Auth::user()->balance -= $total_amount
            ]);
        }else if ($request->order_type == 3)
        {
            $amount_for_balance = $total_amount - Auth::user()->amount_for_shop;
            Auth::user()->update([
                'amount_for_shop' => 0,
                'balance' => Auth::user()->balance -= $amount_for_balance
            ]);
        }else if($request->order_type == 5)
        {
            Auth::user()->update([
                'balance' => Auth::user()->balance -= $total_amount
            ]);
        }
        toastr()->success('Order Created Successfully!.');
        return redirect(route('user.order.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
    public function applyOrder(Request $request)
    {
        try{
            $coupon = Coupon::where('code',$request->coupon_code)->first();
            if($coupon){
                $discountAmount = $request->price/100 * $coupon->percentage;
                $newPrice = $request->price - $discountAmount;
                return [
                    'success' => true,
                    'discount_amount' => $discountAmount,
                    'new_price' => $newPrice,
                    'message' => 'Coupon applied. You saved PKR '.$discountAmount,
                ];
            }else{
                return [
                    'success' => false,
                    'message' => 'Coupon Not Found!',
                ];
            }

        }catch(Exception $e){
            return [
                'success' => false,
                'message' => $e->getMessage(),
            ];
        }
    }
}
