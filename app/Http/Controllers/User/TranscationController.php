<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\CompanyAccount;
use App\Models\Earning;
use App\Models\InStockLevel;
use App\Models\Setting;
use App\Models\Transcation;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class TranscationController extends Controller
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
        return view($this->directory.'.transcation.index');
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
        try{
            $validator = Validator::make($request->all(),[
                'wallet' => 'required',
                'amount' => 'required|min:1',
            ]);
            DB::beginTransaction();
            if(Auth::user()->balance < $request->amount){
                toastr()->error('Your balance is less than amount you want to transfer.');
                return redirect()->back();
            }
            $shoppingReward = $instockReward =  0;
            $user =Auth::user();
            if($request->wallet == 'Shopping Wallet'){
                $shoppingReward = $request->amount / 100 * Setting::shoppingReward();
                Auth::user()->update([
                    'shopping_wallet' => Auth::user()->shopping_wallet + $request->amount,
                    'amount_for_shop' => Auth::user()->amount_for_shop + $shoppingReward + $request->amount,
                    'balance' => Auth::user()->balance - $request->amount,
                ]);
            }else if($request->wallet == 'In Stock Wallet'){
                Auth::user()->update([
                    'instock_wallet' => Auth::user()->instock_wallet + $request->amount,
                    'balance' => Auth::user()->balance - $request->amount,
                ]);
                $levels = InStockLevel::all();		
                $parents = $user->getParents();
                $flash_income= CompanyAccount::flash_income();
                foreach($levels as $index => $level_reward)
                {
                    if($parents[$index])
                    {
                        $instockTeamReward = $request->amount / 100 * $level_reward->amount;

                        $parents[$index]->update([
                            'balance' => $parents[$index]->balance + $instockTeamReward, 
                        ]);
                        Earning::create([
                            'user_id' => $parents[$index]->id, 
                            'due_to' => $user->id, 
                            'price' => $instockTeamReward, 
                            'type' => 'monthly_team_profit', 
                        ]);
                        $flash_income->update([
                            'balance' => $flash_income->balance -= $instockTeamReward,
                        ]);
                    }
                }   
            }
            Transcation::create([
                'user_id' => Auth::user()->id
            ]+$request->all());
            DB::commit();
            toastr()->success('Amount Transfer Successfully!');
            return redirect()->back();
        }catch(Exception $e){
            DB::rollBack();
            toastr()->error($e->getMessage());
            return redirect()->back();
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transcation  $transcation
     * @return \Illuminate\Http\Response
     */
    public function show(Transcation $transcation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transcation  $transcation
     * @return \Illuminate\Http\Response
     */
    public function edit(Transcation $transcation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transcation  $transcation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transcation $transcation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transcation  $transcation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transcation $transcation)
    {
        //
    }
}
