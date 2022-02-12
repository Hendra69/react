<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryTank extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'tank_id',
        'category_name',
        'serial_number',
        'status',
        'location',
        'note',
    ];

    /**
     * Return tankCategory that this tank belongs to.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tankCategory()
    {
        return $this->belongsTo(DeliveryTankCategory::class);
    }

    /**
     * Return tank that belongs to.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tank()
    {
        return $this->belongsTo(Tank::class);
    }
}
