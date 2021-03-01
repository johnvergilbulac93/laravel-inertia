<?php

namespace App\Console\Commands;

use App\Mail\ReminderEmailDigest;
use App\Models\Reminder;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendReminderEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reminder:emails';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send email notification to user about reminders.';

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
        // return 0;
        $reminders = Reminder::query()
                    ->with(['lead'])
                    ->where('reminders.reminder_date', now()->format('Y-m-d'))
                    ->where('reminders.status', 'pending')
                    ->orderBy('user_id')
                    ->get();

        $data = [];
        foreach($reminders as $reminder)
        {
            $data[$reminder->user_id][]= $reminder->toArray();
        }
        
        foreach ($data as $userId => $reminders) 
        {
            $this->sendEmailToUser($userId, $reminders);
        }
    }
    public function sendEmailToUser($userId, $reminders)
    {
        $user = User::find($userId);

        Mail::to($user)->send(new ReminderEmailDigest($reminders));
        
    }
}
