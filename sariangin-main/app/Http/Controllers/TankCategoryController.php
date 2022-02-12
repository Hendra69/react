<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaginationRequest;
use App\Http\Requests\TankCategory\StoreTankCategoryRequest;
use App\Http\Requests\TankCategory\UpdateTankCategoryRequest;
use App\Models\TankCategory;
use App\Services\TankCategoryService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TankCategoryController extends Controller
{
    /**
     * The tank category model instance.
     *
     * @var \App\Services\TankCategoryService
     */
    protected $tankCategoryService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(TankCategoryService $tankCategoryService)
    {
        $this->tankCategoryService = $tankCategoryService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('TankInventory/TankCategory/TankCategory');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('TankInventory/TankCategory/CreateTankCategory');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\TankCategory\StoreTankCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTankCategoryRequest $request)
    {
        $this->tankCategoryService->store($request->all());

        return redirect()->route('tank-categories.index')
            ->with('success', __('messages.created', ['data' => __('models.tank-category')]));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TankCategory  $tankCategory
     * @return \Illuminate\Http\Response
     */
    public function show(TankCategory $tankCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TankCategory  $tankCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(TankCategory $tankCategory)
    {
        return Inertia::render('TankInventory/TankCategory/EditTankCategory', compact('tankCategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\TankCategory\UpdateTankCategoryRequest  $request
     * @param  \App\Models\TankCategory  $tankCategory
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTankCategoryRequest $request, TankCategory $tankCategory)
    {
        $this->tankCategoryService->update($request->all(), $tankCategory);

        return redirect()->route('tank-categories.index')
            ->with('success', __('messages.updated', ['data' => __('models.tank-category')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TankCategory  $tankCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(TankCategory $tankCategory)
    {
        $this->tankCategoryService->destroy($tankCategory);

        return redirect()->route('tank-categories.index')
            ->with('success', __('messages.deleted', ['data' => __('models.tank-category')]));
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \App\Http\Requests\PaginationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function indexAjax(PaginationRequest $request)
    {
        return $this->tankCategoryService->getPaginatedData($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TankCategory  $tankCategory
     * @return \Illuminate\Http\Response
     */
    public function showAjax(TankCategory $tankCategory)
    {
        return $tankCategory;
    }
}
