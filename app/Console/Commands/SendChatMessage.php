<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SendChatMessage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'chat:message {message}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send chat message.';

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
         // Fire off an event, just randomly grabbing the first user for now
        $user = 'Ahmed';
        $message = $this->argument('message');
         
        event(new \App\Events\ChatMessageWasReceived($message, $user));
        $this->info('Event has been fired!');
    }
}
