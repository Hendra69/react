<?php

namespace App\Http\Controllers;

use App\Http\Requests\Contract\StoreContractRequest;
use App\Http\Requests\Contract\UpdateContractRequest;
use App\Http\Requests\PaginationRequest;
use App\Models\Contract;
use App\Services\ContractService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ContractController extends Controller
{
    /**
     * The user model instance.
     *
     * @var \App\Services\ContractService
     */
    protected $contractService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ContractService $contractService)
    {
        $this->contractService = $contractService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contracts = $this->contractService->index();

        return Inertia::render('Contract/Contract', compact('contracts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render('Contract/CreateContract', $this->contractService->getDropdowns());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Contract\StoreContractRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreContractRequest $request)
    {
        $this->contractService->store($request->all());

        return redirect()->route('contracts.index')
            ->with('success', __('messages.created', ['data' => __('models.contract')]));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Contract  $contract
     * @return \Illuminate\Http\Response
     */
    public function show(Contract $contract)
    {
        $contract->load('customer', 'tanks');

        return Inertia::render('Contract/DetailContract', compact('contract'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Contract  $contract
     * @return \Illuminate\Http\Response
     */
    public function edit(Contract $contract)
    {
        $contract->load('customer', 'tanks');

        return Inertia::render('Contract/EditContract', array_merge(
            compact('contract'),
            $this->contractService->getDropdowns()
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Contract\UpdateContractRequest  $request
     * @param  \App\Models\Contract  $contract
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateContractRequest $request, Contract $contract)
    {
        $this->contractService->update($request->all(), $contract);

        return redirect()->route('contracts.index')
            ->with('success', __('messages.updated', ['data' => __('models.contract')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contract  $contract
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contract $contract)
    {
        $this->contractService->destroy($contract);

        return redirect()->route('contracts.index')
            ->with('success', __('messages.deleted', ['data' => __('models.contract')]));
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \App\Http\Requests\PaginationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function indexAjax(PaginationRequest $request)
    {
        return $this->contractService->getPaginatedData($request->all());
    }
}
