<?php

namespace App\Services;

use App\Models\TankCategory;

class TankCategoryService
{
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
    public function __construct(TankCategory $tankCategory)
    {
        $this->tankCategory = $tankCategory;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function index()
    {
        return $this->tankCategory->all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  array  $data
     * @return \App\Models\TankCategory
     */
    public function store($data)
    {
        $tankCategory = $this->tankCategory->fill([
            'name' => $data['name'],
            'size' => $data['size'],
            'note' => $data['note'],
        ]);
        $tankCategory->save();

        return $tankCategory;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  array  $data
     * @param  \App\Models\TankCategory  $tankCategory
     * @return \App\Models\TankCategory
     */
    public function update($data, TankCategory $tankCategory)
    {
        $tankCategory->fill([
            'name' => $data['name'],
            'size' => $data['size'],
            'note' => $data['note'],
        ]);
        $tankCategory->save();

        return $tankCategory;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TankCategory  $tankCategory
     * @return void
     */
    public function destroy(TankCategory $tankCategory)
    {
        $tankCategory->delete();
    }

    /**
     * Get paginated data.
     *
     * @param  array  $params
     * @return array
     */
    public function getPaginatedData($params)
    {
        return $this->tankCategory->getPaginatedData(
            $params['page'],
            $params['perPage'],
            $params['sortKey'],
            $params['sortOrder'],
            $params['search'],
        );
    }
}
