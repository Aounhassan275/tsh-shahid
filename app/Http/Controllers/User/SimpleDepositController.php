<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\SimpleDeposit;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class SimpleDepositController extends Controller
{
    public $directory;
    public $timeFormat;

    public function __construct()
    {
        $this->directory = 'expert-user-panel';
        $this->timeFormat = 'Y-m-d H:i:s';

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
        $desposits = SimpleDeposit::where('user_id',Auth::user()->id)
                ->whereBetween('created_at',[$from, $to])
                ->orderBy('created_at','DESC')
                ->get();
        return view($this->directory.'.simple-deposit.index',compact('desposits','data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view($this->directory.'.simple-deposit.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            't_id' => 'required|unique:simple_deposits'
        ]);

        if($validator->fails()){
            toastr()->error('Transaction Id already exists');
            return redirect()->back();
        }

        SimpleDeposit::create([
            'user_id' => Auth::user()->id
        ]+$request->all());

        toastr()->success('Your Deposit Request Has Been successfully Submitted.');
        
        return redirect(route('user.dashboard.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SimpleDeposit  $simpleDeposit
     * @return \Illuminate\Http\Response
     */
    public function show(SimpleDeposit $simpleDeposit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SimpleDeposit  $simpleDeposit
     * @return \Illuminate\Http\Response
     */
    public function edit(SimpleDeposit $simpleDeposit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SimpleDeposit  $simpleDeposit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SimpleDeposit $simpleDeposit)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SimpleDeposit  $simpleDeposit
     * @return \Illuminate\Http\Response
     */
    public function destroy(SimpleDeposit $simpleDeposit)
    {
        //
    }
}
