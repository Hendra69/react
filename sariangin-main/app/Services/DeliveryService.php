<?php

namespace App\Services;

use App\Models\Customer;
use App\Models\Delivery;
use App\Models\DeliveryCustomer;
use App\Models\DeliveryDriver;
use App\Models\DeliveryNote;
use App\Models\DeliveryVehicle;
use App\Models\TankCategory;
use App\Models\User;
use App\Models\Vehicle;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DeliveryService
{
    /**
     * The delivery model instance.
     *
     * @var \App\Models\Delivery
     */
    protected $delivery;

    /**
     * The customer model instance.
     *
     * @var \App\Models\Customer
     */
    protected $customer;

    /**
     * The user model instance.
     *
     * @var \App\Models\User
     */
    protected $user;

    /**
     * The vehicle model instance.
     *
     * @var \App\Models\Vehicle
     */
    protected $vehicle;

    /**
     * The tankCategory model instance.
     *
     * @var \App\Models\TankCategory
     */
    protected $tankCategory;

    /**
     * Create a new service instance.
     *
     * @return void
     */
    public function __construct(
        Delivery $delivery,
        Customer $customer,
        User $user,
        Vehicle $vehicle,
        TankCategory $tankCategory
    ) {
        $this->delivery = $delivery;
        $this->customer = $customer;
        $this->user = $user;
        $this->vehicle = $vehicle;
        $this->tankCategory = $tankCategory;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function index()
    {
        return $this->delivery->all();
    }

    /**
     * Get data for dropdowns.
     * 
     * @return array
     */
    public function getDropdowns()
    {
        $dropdowns = [];

        $dropdowns['deliveryTypes'] = $this->delivery->getDeliveryTypes();
        $dropdowns['customers'] = $this->customer->getSelectOptions();
        $dropdowns['drivers'] = $this->user->role('driver staff')->getSelectOptions();
        $dropdowns['vehicles'] = $this->vehicle->getSelectOptions();
        $dropdowns['tankCategories'] = $this->tankCategory->all();

        return $dropdowns;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  array  $data
     * @return \App\Models\Delivery
     */
    public function store($data)
    {
        $delivery = $this->delivery->fill([
            'date' => $data['date'] ? Carbon::parse($data['date']) : now(),
            'type' => $data['type'],
        ]);

        DB::transaction(function () use ($delivery, $data) {
            $delivery->save();

            $delivery->assignCustomer($data['customer_id']);
            $delivery->assignDriver($data['driver_id']);
            $delivery->assignVehicle($data['vehicle_id']);

            // notes
            if (isset($data['note'])) {
                $user = Auth::user();
                $delivery->addNote($user, $data['note']);
            }

            // tank categories
            $delivery->saveTankCategories($data['tank_categories']);
        });

        return $delivery;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  array  $data
     * @param  \App\Models\Delivery  $delivery
     * @return \App\Models\Delivery
     */
    public function update($data, Delivery $delivery)
    {
        $delivery = $delivery->fill([
            'date' => $data['date'] ? Carbon::parse($data['date']) : now(),
            'type' => $data['type'],
        ]);

        DB::transaction(function () use ($delivery, $data) {
            $delivery->save();

            $delivery->assignCustomer($data['customer_id']);
            $delivery->assignDriver($data['driver_id']);
            $delivery->assignVehicle($data['vehicle_id']);

            // notes
            if (isset($data['note'])) {
                $user = Auth::user();
                $delivery->addNote($user, $data['note']);
            }

            // tank categories
            $delivery->saveTankCategories($data['tank_categories']);
        });

        return $delivery;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Delivery  $delivery
     * @return void
     */
    public function destroy(Delivery $delivery)
    {
        $delivery->delete();
    }

    /**
     * Get paginated data.
     *
     * @param  array  $params
     * @return array
     */
    public function getPaginatedData($params)
    {
        return $this->delivery->getPaginatedData(
            $params['page'],
            $params['perPage'],
            $params['sortKey'],
            $params['sortOrder'],
            $params['search'],
            ['customer', 'tankCategories']
        );
    }
}
