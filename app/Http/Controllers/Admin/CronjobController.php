<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CompanyAccount;
use App\Models\Earning;
use App\Models\InStockLevel;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;

class CronjobController extends Controller
{
    
    public function addRewardForInStockLevel()
    {
        info("Add Reward For In Stock Values Cronjob Started At" . date("d-M-Y h:i a"));
        $users = User::where('instock_wallet','>',0)->get();		
        $levels = InStockLevel::all();		
        if ($users) {
            $total_users = $users->count();
            info("Add Reward For In Stock Values to User CRONJOB Total Users : $total_users");
            $flash_income= CompanyAccount::flash_income();
            foreach($users as $user)
            {
                $instockReward = $user->instock_wallet / 100 * Setting::instockReward();
                $user->update([
                    'balance' => $user->balance + $instockReward,
                ]);
                Earning::create([
                    'due_to' => $user->id, 
                    'user_id' => $user->id, 
                    'price' => $instockReward, 
                    'type' => 'monthly_instock_reward', 
                ]);

                $flash_income->update([
                    'balance' => $flash_income->balance -= $instockReward,
                ]);
                info("Add Reward For In Stock Values to User CRONJOB User : $user->name");
                $parents = $user->getParents();
                foreach($levels as $index => $level_reward)
                {
                    if($parents[$index])
                    {
                        $instockTeamReward = $instockReward / 100 * $level_reward->amount;

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
		} else {
			info("Add Reward For In Stock Values to User CRONJOB: Users not found. ");
		}
		info("Add Reward For In Stock Values to User CRONJOB END AT " . date("d-M-Y h:i a"));
        toastr()->success('Add Reward In Stock Values Cronjob Run Successfully');
        return back();
    }
}
