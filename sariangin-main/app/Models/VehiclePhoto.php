<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class VehiclePhoto extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'vehicle_id',
        'photo_path',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var string[]
     */
    protected $appends = ['url'];

    /**
     * Get photo_url attribute.
     * 
     * @return string
     */
    public function getUrlAttribute()
    {
        return asset('storage/' . $this->photo_path);
    }

    /**
     * Returns vehicle of this photo.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    /**
     * Delete photo file.
     *
     * @return void
     */
    public function deletePhoto()
    {
        if (file_exists(storage_path('app/public/' . $this->photo_path))) {
            Storage::delete('public/' . $this->photo_path);
        }
    }
}
