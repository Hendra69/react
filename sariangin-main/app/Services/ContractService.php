<?php

namespace App\Services;

use App\Models\Contract;
use App\Models\Customer;
use App\Models\Delivery;
use App\Models\Tank;
use Carbon\Carbon;
use DB;
use Intervention\Image\ImageManagerStatic;
use Milon\Barcode\Facades\DNS1DFacade as DNS1D;

class ContractService
{
    /**
     * The contract model instance.
     *
     * @var \App\Models\Contract
     */
    protected $contract;

    /**
     * The customer model instance.
     *
     * @var \App\Models\Customer
     */
    protected $customer;

    /**
     * The tank model instance.
     *
     * @var \App\Models\Tank
     */
    protected $tank;

    /**
     * The delivery model instance.
     *
     * @var \App\Models\Delivery
     */
    protected $delivery;

    /**
     * Create a new service instance.
     *
     * @return void
     */
    public function __construct(Contract $contract, Customer $customer, Tank $tank, Delivery $delivery)
    {
        $this->contract = $contract;
        $this->customer = $customer;
        $this->tank = $tank;
        $this->delivery = $delivery;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function index()
    {
        return $this->contract->all();
    }

    /**
     * Get data for dropdowns.
     * 
     * @return array
     */
    public function getDropdowns()
    {
        $dropdowns = [];

        $dropdowns['customers'] = $this->customer->all();
        $dropdowns['tanks'] = $this->tank->all();
        $dropdowns['deliveries'] = $this->delivery->with('customer')->get();

        return $dropdowns;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  array  $data
     * @return \App\Models\Contract
     */
    public function store($data)
    {
        $contract = $this->contract->fill([
            'from' => Carbon::parse($data['from']),
            'to' => Carbon::parse($data['to']),
        ]);

        $customer = $this->customer->findOrFail($data['customer_id']);
        if ($customer->type === 'RS') {
            $contract->delivery_id = $data['delivery_id'];
        }

        DB::transaction(function () use ($contract, $data) {
            $contract->save();
            $contract->assignCustomer($data['customer_id']);
            $contract->saveTanks($data['tanks']);
        });

        return $contract;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  array  $data
     * @param  \App\Models\Contract  $contract
     * @return \App\Models\Contract
     */
    public function update($data, Contract $contract)
    {
        $contract->fill([
            'from' => Carbon::parse($data['from']),
            'to' => Carbon::parse($data['to']),
        ]);

        $customer = $this->customer->findOrFail($data['customer_id']);
        if ($customer->type === 'RS') {
            $contract->delivery_id = $data['delivery_id'];
        } else {
            $contract->delivery_id = null;
        }

        DB::transaction(function () use ($contract, $data) {
            $contract->save();
            $contract->assignCustomer($data['customer_id']);
            $contract->saveTanks($data['tanks']);
        });

        return $contract;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contract  $contract
     * @return void
     */
    public function destroy(Contract $contract)
    {
        $contract->delete();
    }

    /**
     * Get paginated data.
     *
     * @param  array  $params
     * @return array
     */
    public function getPaginatedData($params)
    {
        return $this->contract->getPaginatedData(
            $params['page'],
            $params['perPage'],
            $params['sortKey'],
            $params['sortOrder'],
            $params['search'],
            ['customer', 'tanks'],
        );
    }
}
