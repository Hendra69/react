<?php

namespace App\Traits;

use Illuminate\Support\Facades\Log;

trait WithPaginatedData
{
    /**
     * The attributes that are searchable.
     *
     * @var string[]
     */
    // protected $searchable = [];

    /**
     * Get paginated data from model.
     *
     * @return array
     */
    public function getPaginatedData(
        $page = 1,
        $perPage = 20,
        $sortKey = 'id',
        $sortOrder = 'asc',
        $search = null,
        $withRelations = [],
        $filters = []
    ) {
        $page = $page ?? 1;
        $perPage = $perPage ?? 20;
        $sortKey = $sortKey ?? 'id';
        $sortOrder = $sortOrder ?? 'asc';
        $search = $search ?? null;

        if (method_exists($this, 'querySort')) {
            $query = $this->querySort($withRelations, $sortKey, $sortOrder);
        } else {
            $query = $this->with($withRelations)->orderBy($sortKey, $sortOrder);
        }

        if ($search) {
            $searchKeyword = "%$search%";
            if (method_exists($this, 'querySearch')) {
                $query = $this->querySearch($query, $searchKeyword);
            } else {
                $query = $query->where(function ($q) use ($searchKeyword) {
                    if ($this->searchable) {
                        $searchable = $this->searchable;
                    } else {
                        $searchable = $this->getFillable();
                    }

                    foreach ($searchable as $field) {
                        $q->orWhere($field, 'like', $searchKeyword);
                    }
                });
            }
        }

        if (method_exists($this, 'scopeWithFilter')) {
            $query = $query->withFilter($filters);
        }

        if (method_exists($this, 'queryBeforePaginate')) {
            $query = $this->queryBeforePaginate($query);
        }

        return $this->paginate($query, $page, $perPage);
    }

    /**
     * Get paginated query.
     *
     * @return mixed
     */

    public function paginate($query, $page = 1, $perPage = 20)
    {
        $offset = ($page - 1) * $perPage;

        $total = $query->count();
        $lastPage = ceil($total / $perPage);

        if ($page > 1 && $page > $lastPage) {
            return $this->paginate($query, $page - 1, $perPage);
        }

        $query = $query->offset($offset)->limit($perPage);
        $pagination = [
            'page' => (int) $page,
            'perPage' => (int) $perPage,
            'lastPage' => (int) $lastPage,
            'start' => (int) $page ? $offset + 1 : 0,
            'end' => (int) $page ? $offset + $query->count() : 0,
            'total' => (int) $total
        ];

        return [
            'results' => $query->get(),
            'pagination' => $pagination
        ];
    }
}
