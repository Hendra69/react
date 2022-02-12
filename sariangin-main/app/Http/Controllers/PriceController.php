<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaginationRequest;
use App\Http\Requests\Price\CheckUniquePriceRequest;
use App\Http\Requests\Price\StorePriceRequest;
use App\Http\Requests\Price\UpdatePriceRequest;
use App\Models\Customer;
use App\Models\Price;
use App\Models\TankCategory;
use App\Services\CustomerService;
use App\Services\PriceService;
use App\Services\TankCategoryService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PriceController extends Controller
{
    /**
     * The price service instance.
     *
     * @var \App\Services\PriceService
     */
    protected $priceService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(PriceService $priceService)
    {
        $this->priceService = $priceService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('TankInventory/Price/Price');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $dropdowns = $this->priceService->getDropdowns();

        return Inertia::render('TankInventory/Price/CreatePrice', $dropdowns);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Price\StorePriceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePriceRequest $request)
    {
        $this->priceService->store($request->all());

        return redirect()->route('prices.index')
            ->with('success', __('messages.created', ['data' => __('models.price')]));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Price  $price
     * @return \Illuminate\Http\Response
     */
    public function show(Price $price)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Price  $price
     * @return \Illuminate\Http\Response
     */
    public function edit(Price $price)
    {
        $dropdowns = $this->priceService->getDropdowns();

        return Inertia::render('TankInventory/Price/EditPrice', array_merge(
            compact('price'),
            $dropdowns
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Price\UpdatePriceRequest  $request
     * @param  \App\Models\Price  $price
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePriceRequest $request, Price $price)
    {
        $this->priceService->update($request->all(), $price);

        return redirect()->route('prices.index')
            ->with('success', __('messages.updated', ['data' => __('models.price')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Price  $price
     * @return \Illuminate\Http\Response
     */
    public function destroy(Price $price)
    {
        $this->priceService->destroy($price);

        return redirect()->route('prices.index')
            ->with('success', __('messages.deleted', ['data' => __('models.price')]));
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \App\Http\Requests\PaginationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function indexAjax(PaginationRequest $request)
    {
        return $this->priceService->getPaginatedData($request->all());
    }

    /**
     * Check for uniqueness of the input.
     *
     * @param  \App\Http\Requests\Price\CheckUniquePriceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function checkUnique(CheckUniquePriceRequest $request, Price $price = null)
    {
        return response()->json([
            'valid' => true,
        ]);
    }
}
