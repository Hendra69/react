<?php

namespace App\Services;

use App\Models\Customer;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class CustomerService
{
    /**
     * The customer model instance.
     *
     * @var \App\Models\Customer
     */
    protected $customer;

    /**
     * Create a new service instance.
     *
     * @return void
     */
    public function __construct(Customer $customer)
    {
        $this->customer = $customer;
    }

    /**
     * Get all customer types.
     * 
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getCustomerTypes()
    {
        return $this->customer->getCustomerTypes();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function index()
    {
        return $this->customer->all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  array  $data
     * @return \App\Models\Customer
     */
    public function store($data)
    {
        $customer = $this->customer->fill([
            'type' => $data['type'],
            'name' => $data['name'],
            'phone' => $data['phone'],
            'email' => $data['email'],
            'address' => $data['address'],
        ]);
        $customer->save();

        return $customer;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  array  $data
     * @param  \App\Models\Customer  $customer
     * @return \App\Models\Customer
     */
    public function update($data, Customer $customer)
    {
        $customer->fill([
            'type' => $data['type'],
            'name' => $data['name'],
            'phone' => $data['phone'],
            'email' => $data['email'],
            'address' => $data['address'],
        ]);
        $customer->save();

        return $customer;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return void
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();
    }

    /**
     * Get paginated data.
     *
     * @param  array  $params
     * @return array
     */
    public function getPaginatedData($params)
    {
        return $this->customer->getPaginatedData(
            $params['page'],
            $params['perPage'],
            $params['sortKey'],
            $params['sortOrder'],
            $params['search'],
            [],
            $params['filters']
        );
    }
}
