<?php

namespace App\Models;

use App\Traits\Selectable;
use App\Traits\WithPaginatedData;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tank extends Model
{
    use HasFactory, Selectable, WithPaginatedData;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'tank_category_id',
        'category_name',
        'serial_number',
        'status',
        'location',
        'note',
    ];

    /**
     * The attributes that are searchable.
     *
     * @var string[]
     */
    protected $searchable = [
        'category_name',
        'serial_number',
        'status',
        'location',
        'note',
    ];

    /**
     * Return all tank status.
     * 
     * @param  string  $labelName
     * @param  string  $valueName
     * @return string[]
     */
    public function getTankStatus($labelName = 'label', $valueName = 'value')
    {
        return [
            [
                $labelName => 'Kosong',
                $valueName => 'Kosong',
            ],
            [
                $labelName => 'Terisi',
                $valueName => 'Terisi',
            ],
            [
                $labelName => 'Maintenance',
                $valueName => 'Maintenance',
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
        return $this->category_name . ' - ' . $this->serial_number;
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
     * Returns tank category.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(TankCategory::class);
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
        if (isset($filters['category'])) {
            $query->whereIn('tank_category_id', $filters['category']);
        }

        if (isset($filters['location'])) {
            $query->whereIn('location', $filters['location']);
        }

        if (isset($filters['status'])) {
            $query->whereIn('status', $filters['status']);
        }

        return $query;
    }
}
