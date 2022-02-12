<?php

namespace App\Models;

use App\Traits\WithPaginatedData;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    use HasFactory, WithPaginatedData;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'tank_category_id',
        'customer_type',
        'price',
    ];

    /**
     * The attributes that are searchable.
     *
     * @var string[]
     */
    protected $searchable = [
        'customer_type',
        'price',
    ];

    /**
     * Returns tank category for this price.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tankCategory()
    {
        return $this->belongsTo(TankCategory::class);
    }
}
