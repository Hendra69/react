<?php

namespace App\Observers;

use App\Models\Vehicle;
use App\Models\VehiclePhoto;
use Illuminate\Support\Facades\Log;

class VehicleObserver
{
    /**
     * Handle the Vehicle "created" event.
     *
     * @param  \App\Models\Vehicle  $vehicle
     * @return void
     */
    public function created(Vehicle $vehicle)
    {
        //
    }

    /**
     * Handle the Vehicle "updated" event.
     *
     * @param  \App\Models\Vehicle  $vehicle
     * @return void
     */
    public function updated(Vehicle $vehicle)
    {
        //
    }

    /**
     * Handle the Vehicle "deleting" event.
     *
     * @param  \App\Models\Vehicle  $vehicle
     * @return void
     */
    public function deleting(Vehicle $vehicle)
    {
        $vehiclePhotos = $vehicle->photos()->get();

        foreach ($vehiclePhotos as $photo) {
            $photo->deletePhoto();
        }
    }

    /**
     * Handle the Vehicle "deleted" event.
     *
     * @param  \App\Models\Vehicle  $vehicle
     * @return void
     */
    public function deleted(Vehicle $vehicle)
    {
        //
    }

    /**
     * Handle the Vehicle "restored" event.
     *
     * @param  \App\Models\Vehicle  $vehicle
     * @return void
     */
    public function restored(Vehicle $vehicle)
    {
        //
    }

    /**
     * Handle the Vehicle "force deleted" event.
     *
     * @param  \App\Models\Vehicle  $vehicle
     * @return void
     */
    public function forceDeleted(Vehicle $vehicle)
    {
        //
    }
}
