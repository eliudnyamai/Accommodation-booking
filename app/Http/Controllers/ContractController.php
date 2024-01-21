<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use App\Models\Accommodation;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ContractController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contracts = Contract::join('accommodations', 'contracts.accommodation_id', '=', 'accommodations.id')
        ->select('contracts.*', 'accommodations.name as accommodation_name')
        ->get();
        return Inertia::render(
            'Contracts/Index',
            [
                'contracts' => $contracts
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $accommodation = Accommodation::find($request->input('id'));
        return Inertia::render(
            'Contracts/Create',
            [
                'accommodation' => $accommodation
            ]
        );
    }
    public function getContracts(Accommodation $accommodation)
    {
        $contracts = $accommodation->contracts;
        return response()->json($contracts);
       
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'contract_rate' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'accommodationId' => 'required',
            'volume_needed' => 'required'
        ]);
       $contract= Contract::create([
            'contract_rates' => $request->contract_rate,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'accommodation_id'=> $request->accommodationId,
            'volume_needed'=> $request->volume_needed
        ]);
        sleep(1);
        return redirect()->route('accommodations.index')->with([
            'message' => [
            'type' => 'success','message'=>'Contract Created successfully'
            ]
        ]); 
    }

    /**
     * Display the specified resource.
     */
    public function show(Contract $contract)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contract $contract)
    {
        return Inertia::render(
            'Contracts/Edit',
            [
                'contract' => $contract
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Contract $contract)
    {
        $request->validate([
            'contract_rate' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'volume_needed' => 'required',
        ]);
        $contract->contract_rates = $request->contract_rate;
        $contract->start_date = $request->start_date;
        $contract->end_date = $request->end_date;
        $contract->volume_needed=$request->volume_needed;
        $contract->save();
        sleep(1);

        return redirect()->route('contracts.index')->with([
            'message' => [
            'type' => 'success','message'=>'contract updated successfully'
            ]
        ]); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contract $contract)
    {
        $contract->delete();
        sleep(1);

        return redirect()->route('contracts.index')->with([
            'message' => [
            'type' => 'success','message'=>'Contract Deleted successfully'
            ]
        ]); 
    }
}
