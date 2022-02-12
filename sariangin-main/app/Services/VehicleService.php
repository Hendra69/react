<?php

namespace App\Services;

use App\Models\Vehicle;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class VehicleService
{
    /**
     * The vehicle model instance.
     *
     * @var \App\Models\Vehicle
     */
    protected $vehicle;

    /**
     * Create a new service instance.
     *
     * @return void
     */
    public function __construct(Vehicle $vehicle)
    {
        $this->vehicle = $vehicle;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function index()
    {
        return $this->vehicle->all();
    }

    /**
     * Get data for dropdowns.
     * 
     * @return array
     */
    public function getDropdowns()
    {
        $dropdowns = [];

        $dropdowns['vehicleTypes'] = $this->vehicle->getVehicleTypes();

        return $dropdowns;
    }

    /**
     * Get data for filters.
     * 
     * @return array
     */
    public function getFilters()
    {
        $filters = [];

        $filters['vehicleTypes'] = $this->vehicle->getVehicleTypes('text');

        return $filters;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  array  $data
     * @return \App\Models\Vehicle
     */
    public function store($data)
    {
        $vehicle = $this->vehicle->fill([
            'type' => $data['type'],
            'license_plate' => $data['license_plate'],
        ]);
        $vehicle->save();
        $vehicle->savePhotos($data['photos']);

        return $vehicle;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  array  $data
     * @param  \App\Models\Vehicle  $vehicle
     * @return \App\Models\Vehicle
     */
    public function update($data, Vehicle $vehicle)
    {
        $vehicle->fill([
            'type' => $data['type'],
            'license_plate' => $data['license_plate'],
        ]);
        $vehicle->save();
        $vehicle->savePhotos($data['photos']);

        return $vehicle;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vehicle  $vehicle
     * @return void
     */
    public function destroy(Vehicle $vehicle)
    {
        $vehicle->delete();
    }

    /**
     * Get paginated data.
     *
     * @param  array  $params
     * @return array
     */
    public function getPaginatedData($params)
    {
        return $this->vehicle->getPaginatedData(
            $params['page'],
            $params['perPage'],
            $params['sortKey'],
            $params['sortOrder'],
            $params['search'],
            ['photos'],
            $params['filters']
        );
    }
}
