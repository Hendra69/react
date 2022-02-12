<?php

namespace App\Models;

use App\Traits\Selectable;
use App\Traits\WithPaginatedData;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory, Selectable, WithPaginatedData;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'type',
        'name',
        'phone',
        'email',
        'address',
    ];

    /**
     * Return all customer types.
     * 
     * @return array
     */
    public function getCustomerTypes()
    {
        return [
            [
                'label' => 'Personal',
                'value' => 'Personal',
            ],
            [
                'label' => 'RS',
                'value' => 'RS',
            ],
            [
                'label' => 'Agen',
                'value' => 'Agen',
            ],
        ];
    }

    /**
     * Option label.
     * 
     * @return string
     */
    public function getOptionLabel()
    {
        return $this->name . ' - ' . $this->type;
    }

    /**
     * Option value.
     * 
     * @return int
     */
    public function getOptionValue()
    {
        return $this->id;
    }

    /**
     * Runs query with filters.
     * 
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  array  $filters
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeWithFilter(Builder $query, $filters = [])
    {
        // apply filters
        if (isset($filters['type'])) {
            $query->whereIn('type', $filters['type']);
        }

        return $query;
    }
}
