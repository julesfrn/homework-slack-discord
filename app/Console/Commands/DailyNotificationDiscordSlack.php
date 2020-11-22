<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\Homework;
use Carbon\Carbon;

class DailyNotificationDiscordSlack extends Command
{
    protected $signature = 'notify:daily';
    protected $description = 'Send the daily notification to discord and slack';

    public function __construct()
    {
        parent::__construct();
    }

    private function homeWorkForNextWeek() {
        return Homework::whereBetween('due_date_time', [Carbon::now(), Carbon::now()->addDay()])->get();
    }

    public function handle()
    {
        $homeworks = $this->homeWorkForNextWeek();
        $message;
        if (count($homeworks) > 0) {
            $message = 'Bonjour <@&779740992382566410> ! Voici les devoirs à rendre dans les prochaines 24h :';
            foreach ($homeworks as $homework) {
                $dueDate = Carbon::parse($homework->due_date_time, 'UTC')->locale('fr')->calendar();
                $message .= '
 - **' . $homework->class . '** _(' . $homework->teacher . ')_ pour **' . $dueDate . '** :
' . $homework->description;
            }
        } else { 
            $message = 'Bonjour <@&779740992382566410> ! Je ne vois aucun devoir à rendre dans les prochaine 24h.';
        }
        Http::post(env('DISCORD_WEBHOOK_URL'), ['content' => $message]);
    }
}
