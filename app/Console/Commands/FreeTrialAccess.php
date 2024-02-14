<?php

namespace App\Console\Commands;

use App\Models\LinkaUsers;
use App\Models\SubscriptionLinka;
use App\Models\SubscriptionLinkaMembersType;
use Illuminate\Console\Command;

class FreeTrialAccess extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'free:trial';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This is command willbe used for free trial access to the app chatting';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Get all member users of the linka
        $linkaMembers = LinkaUsers::all();

        $freeTrialID = SubscriptionLinka::where("packageName", "Free")->first();

        foreach ($linkaMembers as $member) {

            SubscriptionLinkaMembersType::firstOrCreate([
                "linka_user_id" => $member->id,
                "subscription_type_linka_id" => $freeTrialID->id,
                "packageName" => "Free Trial",
                "amount" => "0",
                "status" => "Active",
            ]);
        }

        $this->info("Free Trial Activated for new member registered");
    }
}
