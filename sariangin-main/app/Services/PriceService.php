<?php

namespace App\Services;

use App\Models\Customer;
use App\Models\Price;
use App\Models\TankCategory;

class PriceService
{
    /**
     * The price model instance.
     *
     * @var \App\Models\Price
     */
    protected $price;

    /**
     * The customer model instance.
     *
     * @var \App\Models\Customer
     */
    protected $customer;

    /**
     * The tank category model instance.
     *
     * @var \App\Models\TankCategory
     */
    protected $tankCategory;

    /**
     * Create a new service instance.
     *
     * @return void
     */
    public function __construct(Price $price, Customer $customer, TankCategory $tankCategory)
    {
        $this->price = $price;
        $this->customer = $customer;
        $this->tankCategory = $tankCategory;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function index()
    {
        return $this->price->all();
    }

    /**
     * Get data for dropdowns.
     * 
     * @return array
     */
    public function getDropdowns()
    {
        $dropdowns = [];

        $dropdowns['customerTypes'] = $this->customer->getCustomerTypes();
        $dropdowns['tankCategories'] = $this->tankCategory->getSelectOptions();

        return $dropdowns;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  array  $data
     * @return \App\Models\Price
     */
    public function store($data)
    {
        $price = $this->price->fill([
            'tank_category_id' => $data['tank_category_id'],
            'customer_type' => $data['customer_type'],
            'price' => $data['price'],
        ]);
        $price->save();

        return $price;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  array  $data
     * @param  \App\Models\Price  $price
     * @return \App\Models\Price
     */
    public function update($data, Price $price)
    {
        $price->fill([
            'tank_category_id' => $data['tank_category_id'],
            'customer_type' => $data['customer_type'],
            'price' => $data['price'],
        ]);
        $price->save();

        return $price;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Price  $price
     * @return void
     */
    public function destroy(Price $price)
    {
        $price->delete();
    }

    /**
     * Get paginated data.
     *
     * @param  array  $params
     * @return array
     */
    public function getPaginatedData($params)
    {
        return $this->price->getPaginatedData(
            $params['page'],
            $params['perPage'],
            $params['sortKey'],
            $params['sortOrder'],
            $params['search'],
            ['tankCategory']
        );
    }
}
