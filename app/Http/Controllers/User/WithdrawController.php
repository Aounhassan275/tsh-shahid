<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Withdraw;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WithdrawController extends Controller
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
        return view($this->directory.'.withdraw.index');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view($this->directory.'.withdraw.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        
          if($request->payment > $user->balance){
                toastr()->error('Not enough balance');
                return redirect()->back();
            }
        // $limit = $user->package->withdraw_limit;
        // $total_withdraw = Withdraw::where('user_id',$user->id)->where('status','Completed')->whereBetween('created_at',[$user->a_date,Carbon::tomorrow()])->sum('payment');
        // $pending_withdraw = Withdraw::where('user_id',$user->id)->where('status','in process')->whereBetween('created_at',[$user->a_date,Carbon::tomorrow()])->sum('payment');
        // $total_withdraw = $total_withdraw + $pending_withdraw;
        // if($request->payment > $limit || $total_withdraw > $limit)
        // {
        //     toastr()->error('Your Withdraw Limit is Exceeded.');
        //     return redirect()->back();
        // }
          Withdraw::create([
              'user_id' => $user->id,
              'status' => "in process",
          ]+$request->all());
          
          $user->update([
              'balance' => $user->balance - $request->payment,    
          ]);
          toastr()->success('Withdraw Request is Submit Successfully');
          return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Withdraw  $withdraw
     * @return \Illuminate\Http\Response
     */
    public function show(Withdraw $withdraw)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Withdraw  $withdraw
     * @return \Illuminate\Http\Response
     */
    public function edit(Withdraw $withdraw)
    {
        return view($this->directory.'.withdraw.edit')->with('withdraw',$withdraw);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Withdraw  $withdraw
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $withdraw = Withdraw::find($id);
        $withdraw->update($request->all());
        toastr()->success('Withdraw Informations Updated successfully');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Withdraw  $withdraw
     * @return \Illuminate\Http\Response
     */
    public function destroy(Withdraw $withdraw)
    {
        $withdraw->delete();
        toastr()->success('Your Withdraw Request is Deleted Successfully');
        return redirect()->back();
    }
}
