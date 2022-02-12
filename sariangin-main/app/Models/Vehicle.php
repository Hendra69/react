<?php

namespace App\Models;

use App\Traits\Selectable;
use App\Traits\WithPaginatedData;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;

class Vehicle extends Model
{
    use HasFactory, Selectable, WithPaginatedData;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'type',
        'license_plate',
    ];

    /**
     * Get all vehicle types.
     * 
     * @param  string  $labelName
     * @param  string  $valueName
     * @return array
     */
    public function getVehicleTypes($labelName = 'label', $valueName = 'value')
    {
        return [
            [
                $labelName => 'Truk Engkel',
                $valueName => 'Truk Engkel',
            ],
            [
                $labelName => 'Pickup Biasa',
                $valueName => 'Pickup Biasa',
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
        return $this->type . ' - ' . $this->license_plate;
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
     * Returns vehicle photos.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function photos()
    {
        return $this->hasMany(VehiclePhoto::class);
    }

    /**
     * Save vehicle photos.
     * 
     * @return void
     */
    public function savePhotos($photos = [])
    {
        $newPhotos = [];
        $photosId = [];

        foreach ($photos as $photo) {
            if ($photo instanceof UploadedFile) {
                $file = $photo->store('vehicles', 'public');

                $newPhotos[] = new VehiclePhoto([
                    'photo_path' => $file
                ]);
            } else {
                $photosId[] = $photo['id'];
            }
        }

        // delete old photos
        $oldPhotos = $this->photos->whereNotIn('id', $photosId);
        foreach ($oldPhotos as $photo) {
            $photo->deletePhoto();
            $photo->delete();
        }

        // save new photos
        $this->photos()->saveMany($newPhotos);
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
