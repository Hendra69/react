<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaginationRequest;
use App\Http\Requests\Vehicle\StoreVehicleRequest;
use App\Http\Requests\Vehicle\UpdateVehicleRequest;
use App\Models\Vehicle;
use App\Services\VehicleService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class VehicleController extends Controller
{
    /**
     * The vehicle service instance.
     *
     * @var \App\Services\VehicleService
     */
    protected $vehicleService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(VehicleService $vehicleService)
    {
        $this->vehicleService = $vehicleService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $filters = $this->vehicleService->getFilters();

        return Inertia::render('MasterData/Vehicle/Vehicle', compact('filters'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $dropdowns = $this->vehicleService->getDropdowns();

        return Inertia::render('MasterData/Vehicle/CreateVehicle', $dropdowns);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Vehicle\StoreVehicleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreVehicleRequest $request)
    {
        $this->vehicleService->store($request->all());

        return redirect()->route('vehicles.index')
            ->with('success', __('messages.created', ['data' => __('models.vehicle')]));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function show(Vehicle $vehicle)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function edit(Vehicle $vehicle)
    {
        $vehicle->load('photos');

        $dropdowns = $this->vehicleService->getDropdowns();

        return Inertia::render('MasterData/Vehicle/EditVehicle', array_merge(
            compact('vehicle'),
            $dropdowns,
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Vehicle\UpdateVehicleRequest  $request
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateVehicleRequest $request, Vehicle $vehicle)
    {
        $this->vehicleService->update($request->all(), $vehicle);

        return redirect()->route('vehicles.index')
            ->with('success', __('messages.updated', ['data' => __('models.vehicle')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vehicle $vehicle)
    {
        $this->vehicleService->destroy($vehicle);

        return redirect()->route('vehicles.index')
            ->with('success', __('messages.deleted', ['data' => __('models.vehicle')]));
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \App\Http\Requests\PaginationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function indexAjax(PaginationRequest $request)
    {
        return $this->vehicleService->getPaginatedData($request->all());
    }
}
