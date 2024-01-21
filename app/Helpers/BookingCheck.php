<?php
// Helper function in a Helper class or in an appropriate file
namespace App\Helpers;
use App\Models\Booking;
use App\Models\Accommodation;

class BookingCheck
{
    public static function areUnitsAvailable($checkInDate, $accommodationId, $requestedUnits)
    {
        // Get all bookings for the accommodation on the specific check-in date
        $bookings = Booking::where('accommodation_id', $accommodationId)
            ->where('check_in_date', $checkInDate)
            ->get();
        // If there are no existing bookings for the check-in date, all units are available
        if ($bookings->isEmpty()) {
            return true;
        }
        // Calculate the total units booked for the specific check-in date
        $totalUnitsBooked = $bookings->sum('units_booked');
        // Check if there are enough available units
        $accommodation = Accommodation::findOrFail($accommodationId);
        $availableUnits = $accommodation->available_units - $totalUnitsBooked;

        return $availableUnits >= $requestedUnits;
    }
}
