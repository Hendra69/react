<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaginationRequest;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Models\User;
use App\Services\UserService;
use Inertia\Inertia;

class UserController extends Controller
{
    /**
     * The user service instance.
     *
     * @var \App\Services\UserService
     */
    protected $userService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $filters = $this->userService->getFilters();

        return Inertia::render('MasterData/User/User', compact('filters'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $dropdowns = $this->userService->getDropdowns();

        return Inertia::render('MasterData/User/CreateUser', $dropdowns);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\User\StoreUserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        $this->userService->store($request->all());

        return redirect()->route('users.index')
            ->with('success', __('messages.created', ['data' => __('models.user')]));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $user->role = $user->role;
        $dropdowns = $this->userService->getDropdowns();

        return Inertia::render('MasterData/User/EditUser', array_merge(
            compact('user'),
            $dropdowns
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\User\UpdateUserRequest  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $this->userService->update($request->all(), $user);

        return redirect()->route('users.index')
            ->with('success', __('messages.updated', ['data' => __('models.user')]));;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $this->userService->destroy($user);

        return redirect()->route('users.index')
            ->with('success', __('messages.deleted', ['data' => __('models.user')]));
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \App\Http\Requests\PaginationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function indexAjax(PaginationRequest $request)
    {
        return $this->userService->getPaginatedData($request->all());
    }
}
