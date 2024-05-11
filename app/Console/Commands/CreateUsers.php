<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;

class CreateUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:users {count=1}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates test user data and insert into the database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $numberOfUsers = $this->argument('count');
    
        for ($i = 0; $i < $numberOfUsers; $i++) { 
            User::factory()->create();
        }
        return Command::SUCCESS;
    }
}
