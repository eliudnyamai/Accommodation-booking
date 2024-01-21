<?php

namespace App\Http\Controllers;

use App\Models\Accommodation;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AccommodationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $accommodations= Accommodation::all();
        $user = auth()->user();
        return Inertia::render(
            'Accommodations/Index',
            [
                'accommodations' => $accommodations,
                'user'=>$user
            ]
        );
    }

    /**
     * Show the form fo\\r creating a new resource.
     */
    public function create()
    {
        return Inertia::render(
            'Accommodations/Create'
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'standardrackrate' => 'required'
        ]);
        Accommodation::create([
            'name' => $request->name,
            'description' => $request->description,
            'standard_rack_rate' => $request->standardrackrate,
            'available_units'=> $request->availableUnits
        ]);
        sleep(1);
        return redirect()->route('accommodations.index')->with([
            'message' => [
            'type' => 'success','message'=>'Accommodation Created Successfully'
            ]
        ]);       
    }

    /**
     * Display the specified resource.
     */
    public function show(Accommodation $accommodation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Accommodation $accommodation)
    {
        return Inertia::render(
            'Accommodations/Edit',
            [
                'accommodation' => $accommodation
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Accommodation $accommodation)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'standardrackrate' => 'required',
            'unitsAvailable' => 'required',
        ]);
            $accommodation->name = $request->name;
            $accommodation->description = $request->description;
            $accommodation->standard_rack_rate = $request->standardrackrate;
            $accommodation->available_units=$request->unitsAvailable;
            $accommodation->save();
            sleep(1);
            return redirect()->route('accommodations.index')->with([
                'message' => [
                'type' => 'success','message'=>'Accommodation Updated Successfully'
                ]
            ]);          
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Accommodation $accommodation)
    {
        $accommodation->delete();
        sleep(1);
        return redirect()->route('accommodations.index')->with([
            'message' => [
            'type' => 'success','message'=>'Accommodation Deleted Successfully'
            ]
        ]);          
    }
}
