<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait Selectable
{
    /**
     * Option label.
     * 
     * @return mixed
     */
    abstract public function getOptionLabel();

    /**
     * Option value.
     * 
     * @return mixed
     */
    abstract public function getOptionValue();

    /**
     * Get data as select options object.
     * 
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  string  $labelName
     * @param  string  $valueName
     * @return array|\Illuminate\Database\Eloquent\Collection
     */
    public function scopeGetSelectOptions(Builder $query, $labelName = 'label', $valueName = 'value')
    {
        return $query->get()->map(fn ($item) => [
            $labelName => $item->getOptionLabel(),
            $valueName => $item->getOptionValue(),
        ]);
    }
}
