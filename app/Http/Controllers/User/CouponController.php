<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CouponController extends Controller
{
    public $directory;

    public function __construct()
    {
        $this->directory = 'expert-user-panel';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->checkstatus() =='old')
        {
            return view($this->directory.'.coupon.index');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view($this->directory.'.coupon.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->percentage > Setting::couponDicount()){
            toastr()->error('Not Allowed To add more percentage');
            return redirect()->back();
        }
        Coupon::create($request->all());
        toastr()->success('Coupon is Created Successfully');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function show(Coupon $coupon)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $coupon = Coupon::find($id);
        if($coupon->user_id != Auth::user()->id){
            toastr()->error('Not Allowed');
            return redirect()->back();
        }
        return view($this->directory.'.coupon.edit',compact('coupon'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        
        if($request->percentage > Setting::couponDicount()){
            toastr()->error('Not Allowed To add more percentage');
            return redirect()->back();
        }
        $coupon = Coupon::find($id);
        $coupon->update($request->all());
        toastr()->success('Coupon Informations Updated successfully');
        return redirect()->back();
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $coupon = Coupon::find($id);
        $coupon->delete();
        toastr()->success('Coupon Deleted Successfully');
        return redirect()->back();
    }
}
