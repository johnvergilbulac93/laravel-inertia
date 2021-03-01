<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use App\Models\Package;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class LeadController extends Controller
{
    public function index(Request $request)
    {


        $query = Lead::orderBy('id','asc');

        if ($request->search) {
            $query = Lead::when($request->search,function($query, $search){
                $query->where('name','LIKE', '%'. $search .'%');
            });
        }

        $leads = $query->paginate();

        return Inertia::render('Leads/Index',[
            'leads' => $leads,
        ]);
    }
    public function create()
    {
        $packages = Package::all();

        return Inertia::render('Leads/LeadAdd',[
            'packages' => $packages
        ]);
    }
    public function store(Request $request)
    {
         $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|numeric',
            'birthday' => 'required|date',
            'package' => 'required',
        ]);
        
        $dob = Carbon::parse($request['birthday']);
        $age = $dob->age;
        Lead::create([
            'name'          => $request['name'],
            'email'         => $request['email'],
            'phone'         => $request['phone'],
            'dob'           => $request['birthday'],
            'package'       => $request['package'],
            'branch_id'     => 1,
            'age'           =>  $age,
        ]);

        return Redirect::route('lead.list');
    }
    public function view(Lead $lead)
    {   
        $lead->load(['reminders']);
        $packages = Package::all();
        
        return Inertia::render('Leads/LeadView', [
            'lead-prop' => $lead,
            'packages' => $packages

        ]);
    }
    public function update(Request $request)
    {
        $dob = Carbon::parse($request['dob']);
        $age = $dob->age;

        $leadData = array(
            'name'          => $request['name'],
            'email'         => $request['email'],
            'phone'         => $request['phone'],
            'dob'           => $request['dob'],
            'package'       => $request['package'],
            'branch_id'     => 1,
            'age'           => $age,
        );

        Lead::where('id', $request['id'])->update($leadData);

        return Redirect::route('lead.view',[
            'lead' => $request['id']
        ]);
    }
}
