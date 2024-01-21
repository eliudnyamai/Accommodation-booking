<?php
// Helper function in a Helper class or in an appropriate file
namespace App\Helpers;
use Carbon\Carbon;
use App\Models\Accommodation;
class ContractHelper
{
    public static function checkBookingQualification($accommodationId, $checkInDate, $unitsBooked)
    {
         // Find the accommodation by ID
    $accommodation = Accommodation::find($accommodationId);

    if (!$accommodation) {
        // Accommodation not found
        return false;
    }

    // Get the corresponding contracts for the accommodation
    $contracts = $accommodation->contracts;

    // Parse the check-in date
    $checkInDate = Carbon::parse($checkInDate);

    // Iterate through the contracts
    foreach ($contracts as $contract) {
        // Parse contract start_date and end_date
        $startDate = Carbon::parse($contract->start_date);
        $endDate = Carbon::parse($contract->end_date);
        // Check if check-in date is between contract start_date and end_date
        if ($checkInDate->between($startDate, $endDate, true)) {
            // Check if units_booked is greater or equal to contract's volume_needed
            if ($unitsBooked >= $contract->volume_needed) {
                // Qualifies, return the contract rate
                return $contract->contract_rates;
            }
        }
    }

    // Doesn't qualify for any contract
    return false;
      }
}
