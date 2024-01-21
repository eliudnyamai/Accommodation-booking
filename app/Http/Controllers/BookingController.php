<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Accommodation;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Helpers\BookingCheck;
use App\Helpers\ContractHelper;
class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Retrieve all bookings of the logged-in user
        $user = auth()->user();
        $bookings = $user->bookings;
        $user = auth()->user();

        $bookings = $user->bookings()
            ->join('accommodations', 'bookings.accommodation_id', '=', 'accommodations.id')
            ->select('bookings.id','bookings.check_in_date','bookings.units_booked', 'bookings.total_price', 'accommodations.name', 'accommodations.description')
            ->get();
        return Inertia::render(
            'Bookings/Index',
            [
                'bookings'=>$bookings
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $accommodation = Accommodation::find($request->input('id'));
        $user = auth()->user();
        return Inertia::render(
            'Bookings/Create',
            [
                'accommodation' => $accommodation,
                 'user' => $user
            ],
           
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
            $request->validate([
                'userId' => 'required|exists:users,id',
                'accommodationId' => 'required|exists:accommodations,id',
                'units_booked' => 'required|integer|min:1',
                'check_in_date' => 'required|date', // Add validation for check-in date
            ]);
            $accommodation = Accommodation::findOrFail($request->accommodationId);
            $contractCheck=ContractHelper::checkBookingQualification($request->accommodationId, $request->check_in_date, $request->units_booked);
            if($contractCheck){//Qualifies for the dicounted price
                $totalPrice = $contractCheck * $request->units_booked;
            } else{//Does not qualify
                $totalPrice = $accommodation->standard_rack_rate * $request->units_booked;
            }
            if( BookingCheck::areUnitsAvailable($request->check_in_date, $request->accommodationId, $request->units_booked)){
                
                $booking=Booking::create([
                    'user_id' => $request->userId,
                    'accommodation_id' => $request->accommodationId,
                    'units_booked' => $request->units_booked,
                    'total_price' => $totalPrice,
                    'check_in_date' => $request->check_in_date,

                ]);
               
                sleep(1);
                return redirect()->route('bookings.index')->with([
                    'message' => [
                    'type' => 'success','message'=>'Booking Created Successfully'
                    ]
                ]);             
            }
            else{
                    return redirect()->route('accommodations.index')->with([
                        'message' => [
                        'type' => 'error','message'=>'No Enough Units To Book For That Particular Date. Try a lower Number'
                        ]
                    ]);  
            }
           
          

        
    }

    /**
     * Display the specified resource.
     */
    public function show(Booking $booking)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Booking $booking)
    {
        return Inertia::render(
            'Bookings/Edit',
            [
                'booking' => $booking
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Booking $booking)
    {
        $request->validate([
            'units_booked' => 'required',
            'check_in_date' => 'required',
        ]);
            
            $accommodation = Accommodation::findOrFail($request->accommodationId);
            $totalPrice = $accommodation->standard_rack_rate * $request->units_booked;
            $booking->units_booked = $request->units_booked;
            $booking->check_in_date = $request->check_in_date;
            $booking->total_price = $totalPrice;
            $booking->save();
            sleep(1);
            return redirect()->route('bookings.index')->with([
                'message' => [
                'type' => 'success','message'=>'Booking updated successfully'
                ]
            ]);     
     }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Booking $booking)
    {
        $booking->delete();
        sleep(1);
        return redirect()->route('bookings.index')->with([
            'message' => [
            'type' => 'success','message'=>'Booking Deleted successfully'
            ]
        ]);    
    }
}
