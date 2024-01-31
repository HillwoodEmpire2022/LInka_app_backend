<?php

namespace App\Console\Commands;

use App\Enums\UserType;
use App\Models\User;
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
            UsersType::create([
                "userType" => $types->value
            ]);
        }

        $this->info("User types created successfully");
    }
}
