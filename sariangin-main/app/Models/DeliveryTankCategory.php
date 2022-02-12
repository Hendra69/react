<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryTankCategory extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'tank_category_id',
        'name',
        'size',
        'note',
        'qty',
    ];

    /**
     * Return delivery that this customer belongs to.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function delivery()
    {
        return $this->belongsTo(Delivery::class);
    }

    /**
     * Return tankCategory.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tankCategory()
    {
        return $this->belongsTo(TankCategory::class);
    }

    /**
     * Return tanks.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tanks()
    {
        return $this->hasMany(DeliveryTank::class);
    }
}
