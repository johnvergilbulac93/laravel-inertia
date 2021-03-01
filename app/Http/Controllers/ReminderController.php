<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lead;
use App\Models\Reminder;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class ReminderController extends Controller
{
    public function add(Lead $lead)
    {
        return Inertia::render('Leads/LeadReminderAdd',[
            'lead' => $lead
        ]);
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'reminder' => 'required',
            'reminder_date' => 'required|date',
            'lead_id' => 'required|exists:leads,id'
        ]);

        $lead = Lead::find($request->get('lead_id'));

        $lead->reminders()->create([
            'lead_id' => $request->get('lead_id'),
            'user_id' => $request->user()->id,
            'reminder' => $request->get('reminder'),
            'reminder_date' => $request->get('reminder_date'),
            'status'    => 'pending'

        ]);

        return Redirect::route('lead.view',[
            $lead
        ]);
    }
    public function view(Lead $lead, Reminder $reminder)
    {
        return Inertia::render('Leads/ReminderView',[
            'lead' => $lead,
            'reminder' => $reminder
        ]);
    }
    public function note(Lead $lead, Reminder $reminder)
    {
        return Inertia::render('Leads/ReminderNote',[
            'lead' => $lead,
            'reminder' => $reminder
        ]);
    }
    public function close(Request $request)
    {
        $this->validate($request, [
            'note' => 'required',
        ]);
        
        $data = array(
            'status'    => 'completed',
            'note'      =>  $request['note']
        );

        Reminder::where('id', $request['reminder_id'])->update($data);

        return Redirect::route('lead.view',[
            'lead' => $request['lead_id']
        ]);
    }
    
}
