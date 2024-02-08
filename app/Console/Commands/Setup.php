<?php

namespace App\Console\Commands;

use App\Enums\SubscriptionType;
use App\Enums\UserType;
use App\Models\SubscriptionLinka;
use App\Models\SubscriptionType as ModelsSubscriptionType;
use App\Models\UsersType;
use Illuminate\Console\Command;

class Setup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'setup:required-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'prerequisities setup required data';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // create default user types
        $userTypes = UserType::cases();

        foreach ($userTypes as $types) {
            UsersType::firstOrCreate([
                "userType" => $types->value,
            ]);
        }

        // create subscription types
        $subscriptionTypes = SubscriptionType::cases();

        foreach ($subscriptionTypes as $subscription) {

            ModelsSubscriptionType::firstOrCreate([
                "subscriptionName" => $subscription->value,
            ]);
        }

        // create default subscription of linka where subscription is free
        SubscriptionLinka::firstOrCreate([
            "subscription_type_id" => 1,
            "packageName" => "Free Trial",
            "amount" => "0",
            "description" => "This is a free trial subscription",
        ]);

        $this->info("setup created successfully");
    }
}
