<?php

namespace App\Http\Controllers;

use App\Http\Requests\Delivery\StoreDeliveryRequest;
use App\Http\Requests\Delivery\UpdateDeliveryRequest;
use App\Http\Requests\PaginationRequest;
use App\Models\Delivery;
use App\Services\DeliveryService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DeliveryController extends Controller
{
    /**
     * The price service instance.
     *
     * @var \App\Services\DeliveryService
     */
    protected $deliveryService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(DeliveryService $deliveryService)
    {
        $this->deliveryService = $deliveryService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Delivery/Delivery');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Delivery/CreateDelivery', $this->deliveryService->getDropdowns());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Delivery\StoreDeliveryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDeliveryRequest $request)
    {
        $this->deliveryService->store($request->all());

        return redirect()->route('deliveries.index')
            ->with('success', __('messages.created', ['data' => __('models.delivery')]));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Delivery  $delivery
     * @return \Illuminate\Http\Response
     */
    public function show(Delivery $delivery)
    {
        $delivery->load(
            'tankCategories',
            'customer',
            'driver',
            'vehicle',
            'notes'
        );

        return Inertia::render('Delivery/DetailDelivery', compact('delivery'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Delivery  $delivery
     * @return \Illuminate\Http\Response
     */
    public function edit(Delivery $delivery)
    {
        $delivery->load(
            'tankCategories',
            'customer',
            'driver',
            'vehicle',
            'notes'
        );

        $dropdowns  = $this->deliveryService->getDropdowns();

        return Inertia::render('Delivery/EditDelivery', array_merge(
            compact('delivery'),
            $dropdowns
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Delivery\UpdateDeliveryRequest  $request
     * @param  \App\Models\Delivery  $delivery
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDeliveryRequest $request, Delivery $delivery)
    {
        $this->deliveryService->update($request->all(), $delivery);

        return redirect()->route('deliveries.index')
            ->with('success', __('messages.updated', ['data' => __('models.delivery')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Delivery  $delivery
     * @return \Illuminate\Http\Response
     */
    public function destroy(Delivery $delivery)
    {
        $this->deliveryService->destroy($delivery);

        return redirect()->route('deliveries.index')
            ->with('success', __('messages.deleted', ['data' => __('models.delivery')]));
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \App\Http\Requests\PaginationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function indexAjax(PaginationRequest $request)
    {
        return $this->deliveryService->getPaginatedData($request->all());
    }
}
