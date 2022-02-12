<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserService
{
    /**
     * The user model instance.
     *
     * @var \App\Models\User
     */
    protected $user;

    /**
     * Create a new service instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Get all role list
     * 
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getRoles()
    {
        return Role::all();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function index()
    {
        return $this->user->all();
    }

    /**
     * Get data for dropdowns.
     * 
     * @return array
     */
    public function getDropdowns()
    {
        $dropdowns = [];

        $dropdowns['roles'] = Role::all()->map(fn ($item) => [
            'label' => $item->label,
            'value' => $item->name,
        ]);

        return $dropdowns;
    }

    /**
     * Get data for filters.
     * 
     * @return array
     */
    public function getFilters()
    {
        $filters = [];

        $filters['roles'] = Role::all()->map(fn ($item) => [
            'text' => $item->label,
            'value' => $item->name,
        ]);

        return $filters;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    public function store($data)
    {
        $user = $this->user->fill([
            'name' => $data['name'],
            'email' => $data['email'],
            'username' => $data['username'],
        ]);

        $user->password = Hash::make($data['password']);

        if (isset($data['avatar'])) {
            $user->saveAvatar($data['avatar']);
        }

        $user->save();
        $user->assignRole($data['role']);

        return $user;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  array  $data
     * @param  \App\Models\User  $user
     * @return \App\Models\User
     */
    public function update($data, User $user)
    {
        $user->fill([
            'name' => $data['name'],
            'email' => $data['email'],
            'username' => $data['username'],
        ]);

        if (isset($data['avatar'])) {
            $user->saveAvatar($data['avatar']);
        }

        $user->save();
        $user->assignRole($data['role']);

        return $user;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function destroy(User $user)
    {
        $user->removeAvatar();
        $user->delete();
    }

    /**
     * Get paginated data.
     *
     * @param  array  $params
     * @return array
     */
    public function getPaginatedData($params)
    {
        return $this->user->getPaginatedData(
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
