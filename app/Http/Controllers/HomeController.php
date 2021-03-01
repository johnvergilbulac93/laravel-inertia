<?php

namespace App\Http\Controllers;

use App\Models\Reminder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    // public function index()
    // {
    //     return view('home');
    // }
    public function index()
    {

        $reminders = Reminder::query()
                    ->with(['lead'])
                    ->where('reminders.reminder_date', now()->format('Y-m-d'))
                    ->where('reminders.user_id', Auth::user()->id)
                    ->where('reminders.status', 'pending')
                    ->get();
        return Inertia::render('Index',[
            'reminders' => $reminders
        ]);
    }
}
