<?php

namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class PackageController extends Controller
{
    public function index(Request $request)
    {
        $query = Package::orderBy('id','asc');

        if ($request->search) {
            $query = Package::when($request->search,function($query, $search){
                $query->where('name','LIKE', '%'. $search .'%');
            });
        }

        $packages = $query->paginate();

        return Inertia::render('Packages/Index',[
            'packages' => $packages,
        ]);
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'amount' => 'required|',
            'days' => 'required|numeric',
        ]);
        Package::create([
            'name'          => $request['name'],
            'amount'         => floatval($request['amount']) ,
            'days'         => $request['days'],
        ]);
        return Redirect::route('package.list');
        
    }
    public function view(Package $package)
    {
        return Inertia::render('Packages/PackageView',[
            'packages' =>$package
        ]);
    }
    public function update(Request $request)
    {
        $packageData = array(
            'name'          => $request['name'],
            'amount'         => $request['amount'],
            'days'         => $request['days'],
        );
        Package::where('id', $request['id'])->update($packageData);

        return Redirect::route('package.list',[
            'packages' => $request['id']
        ]);
    }
    public function destroy(Request $request)
    {
        $package = Package::find($request->package)->delete();

        return Redirect::route('package.list');
    }

}
