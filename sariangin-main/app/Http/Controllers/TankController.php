<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaginationRequest;
use App\Http\Requests\Tank\StoreTankRequest;
use App\Models\Tank;
use App\Models\TankCategory;
use App\Services\TankCategoryService;
use App\Services\TankService;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Milon\Barcode\Facades\DNS1DFacade as DNS1D;

class TankController extends Controller
{
    /**
     * The tank service instance.
     *
     * @var \App\Services\TankService
     */
    protected $tankService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(TankService $tankService)
    {
        $this->tankService = $tankService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $filters = $this->tankService->getFilters();

        return Inertia::render('TankInventory/Tank/Tank', compact('filters'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $dropdowns = $this->tankService->getDropdowns();

        return Inertia::render('TankInventory/Tank/CreateTank', $dropdowns);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Tank\StoreTankRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTankRequest $request)
    {
        $this->tankService->store($request->all());

        return redirect()->route('tanks.index')
            ->with('success', __('messages.created', ['data' => __('models.tank')]));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tank  $tank
     * @return \Illuminate\Http\Response
     */
    public function show(Tank $tank)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tank  $tank
     * @return \Illuminate\Http\Response
     */
    public function edit(Tank $tank)
    {
        $dropdowns = $this->tankService->getDropdowns();

        return Inertia::render('TankInventory/Tank/EditTank', array_merge(
            compact('tank'),
            $dropdowns
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Tank\UpdateTankRequest  $request
     * @param  \App\Models\Tank  $tank
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tank $tank)
    {
        $this->tankService->update($request->all(), $tank);

        return redirect()->route('tanks.index')
            ->with('success', __('messages.updated', ['data' => __('models.tank')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tank  $tank
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tank $tank)
    {
        $tank->delete();

        return redirect()->route('tanks.index')
            ->with('success', __('messages.deleted', ['data' => __('models.tank')]));
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \App\Http\Requests\PaginationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function indexAjax(PaginationRequest $request)
    {
        return $this->tankService->getPaginatedData($request->all());
    }

    /**
     * Show barcode for a tank.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function showBarcode(Request $request, Tank $tank)
    {
        $image = $this->tankService->generateBarcode($tank);

        return $image->response();
    }

    /**
     * Print tank barcodes.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function printBarcodes(Request $request)
    {
        $request->validate([
            'id' => 'nullable|array',
        ]);

        if ($request->id) {
            $tanks = $this->tankService->index($request->id);

            return $this->tankService->generateAllBarcodeBase64($tanks);
        }

        return $this->tankService->generateAllBarcodeBase64();
    }
}
