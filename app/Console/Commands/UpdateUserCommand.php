<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;

class UpdateUserCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:update {id} {comment}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update User';

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
     * @return int
     */
    public function handle()
    {
        $user = User::find($this->argument('id'));
        $user->comments =  $this->argument('comment');

        $user->save();

        return 0;
    }
}
