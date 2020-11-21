<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class DailyNotificationDiscordSlack extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notify:daily';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send the daily notification to discord and slack';

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
        Http::post(env('DISCORD_WEBHOOK_URL'), [
            'content' => 'Hello @Altaïr !',
            'embeds' => [
                'title' => "An awesome new notification!",
                'description' => "Discord Webhooks are great!",
                'color' => '7506394'
            ]
        ]);
    }
}
