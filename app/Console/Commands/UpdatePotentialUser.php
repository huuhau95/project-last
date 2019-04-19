<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;

class UpdatePotentialUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'potential:user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update potential for user related by count their order success';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $users = User::withCount(['orders' => function ($query) {
            $query->where('status', 1);
        }])->get();

        foreach ($users as $user) {
            $count = $user->orders_count;
            switch ($count) {
                case $count <= 1:
                    $potential = 1;
                    break;
                case $count <= 20:
                    $potential = 2;
                    break;
                case $count <= 30:
                    $potential = 3;
                    break;
                default:
                    $potential = null;
            }
            $user->potential_id = $potential;
            $user->save();
        }
    }
}
