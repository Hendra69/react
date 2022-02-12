<?php

namespace App\Models;

use App\Traits\Selectable;
use App\Traits\WithPaginatedData;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TankCategory extends Model
{
    use HasFactory, Selectable, WithPaginatedData;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'size',
        'note',
    ];

    /**
     * Returns tanks that belongs to this category.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tanks()
    {
        return $this->hasMany(Tank::class);
    }

    /**
     * Option label.
     * 
     * @return string
     */
    public function getOptionLabel()
    {
        return $this->name;
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
}
