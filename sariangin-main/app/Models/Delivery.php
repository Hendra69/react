<?php

namespace App\Models;

use App\Traits\WithPaginatedData;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Delivery extends Model
{
    use HasFactory, WithPaginatedData;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'date',
        'type',
    ];

    /**
     * The attributes that are searchable.
     *
     * @var string[]
     */
    protected $searchable = [
        'date',
        'type',
        'customer',
        'tankCategories',
    ];

    /**
     * Return available delivery types.
     * 
     * @return string[]
     */
    public function getDeliveryTypes()
    {
        return [
            [
                'label' => 'Delivery',
                'value' => 'Delivery'
            ],
            [
                'label' => 'Pickup',
                'value' => 'Pickup'
            ],
        ];
    }

    /**
     * Return this delivery customer.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function customer()
    {
        return $this->hasOne(DeliveryCustomer::class);
    }

    /**
     * Return this delivery tank categories.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tankCategories()
    {
        return $this->hasMany(DeliveryTankCategory::class);
    }

    /**
     * Return this delivery driver.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function driver()
    {
        return $this->hasOne(DeliveryDriver::class);
    }

    /**
     * Return this delivery vehicle.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function vehicle()
    {
        return $this->hasOne(DeliveryVehicle::class);
    }

    /**
     * Return this delivery notes.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function notes()
    {
        return $this->hasMany(DeliveryNote::class)->orderBy('id', 'desc');
    }

    /**
     * Assign delivery customer.
     * 
     * @param  int  $id  Customer id
     * @return \App\Models\DeliveryCustomer
     */
    public function assignCustomer($id)
    {
        $customer = Customer::findOrFail($id);

        if ($this->customer()->exists()) {
            $deliveryCustomer = $this->customer->fill([
                'customer_id' => $customer->id,
                'type' => $customer->type,
                'name' => $customer->name,
                'phone' => $customer->phone,
                'email' => $customer->email,
                'address' => $customer->address,
            ]);

            $deliveryCustomer->save();
        } else {
            $deliveryCustomer = new DeliveryCustomer([
                'customer_id' => $customer->id,
                'type' => $customer->type,
                'name' => $customer->name,
                'phone' => $customer->phone,
                'email' => $customer->email,
                'address' => $customer->address,
            ]);

            $this->customer()->save($deliveryCustomer);
        }

        return $deliveryCustomer;
    }

    /**
     * Assign delivery driver.
     * 
     * @param  int  $id  Driver id
     * @return \App\Models\DeliveryDriver
     */
    public function assignDriver($id)
    {
        $driver = User::findOrFail($id);
        if ($this->driver()->exists()) {
            $deliveryDriver = $this->driver->fill([
                'user_id' => $driver->id,
                'name' => $driver->name,
                'phone' => $driver->phone,
            ]);

            $deliveryDriver->save();
        } else {
            $deliveryDriver = new DeliveryDriver([
                'user_id' => $driver->id,
                'name' => $driver->name,
                'phone' => $driver->phone,
            ]);

            $this->driver()->save($deliveryDriver);
        }

        return $deliveryDriver;
    }

    /**
     * Assign delivery vehicle.
     * 
     * @param  int  $id  Vehicle id
     * @return \App\Models\DeliveryVehicle
     */
    public function assignVehicle($id)
    {
        $vehicle = Vehicle::findOrFail($id);

        if ($this->vehicle()->exists()) {
            $deliveryVehicle = $this->vehicle->fill([
                'vehicle_id' => $vehicle->id,
                'type' => $vehicle->type,
                'license_plate' => $vehicle->license_plate,
            ]);

            $deliveryVehicle->save();
        } else {
            $deliveryVehicle = new DeliveryVehicle([
                'vehicle_id' => $vehicle->id,
                'type' => $vehicle->type,
                'license_plate' => $vehicle->license_plate,
            ]);

            $this->vehicle()->save($deliveryVehicle);
        }

        return $deliveryVehicle;
    }

    /**
     * Save delivery tank categories.
     * 
     * @param  array  $items
     * @return void
     */
    public function saveTankCategories($items)
    {
        if ($this->tankCategories()->exists()) {
            $this->tankCategories()->delete();
        }

        foreach ($items as $data) {
            $tankCategory = TankCategory::findOrFail(isset($data['delivery_id']) ? $data['tank_category_id'] : $data['id']);

            $deliveryTankCategory = new DeliveryTankCategory([
                'tank_category_id' => $tankCategory->id,
                'name' => $tankCategory->name,
                'size' => $tankCategory->size,
                'note' => $tankCategory->note,
                'qty' => $data['qty'],
            ]);

            $this->tankCategories()->save($deliveryTankCategory);
        }
    }

    /**
     * Add note for this delivery.
     * 
     * @param  \App\Models\User  $user  User/author
     * @param  string  $note  Note data
     * @return \App\Models\DeliveryNote
     */
    public function addNote($user, $note)
    {
        $deliveryNote = new DeliveryNote([
            'user_id' => $user->id,
            'user_name' => $user->name,
            'user_role' => $user->role->label,
            'note' => $note,
        ]);

        $this->notes()->save($deliveryNote);

        return $deliveryNote;
    }

    /**
     * Custom query for searching.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  string  $kKeyword
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function querySearch(Builder $query, $keyword)
    {
        return $query->where(function (Builder $q) use ($keyword) {
            foreach ($this->searchable as $field) {
                if (in_array($field, ['customer', 'tankCategories'])) {
                    $q->orWhereHas(
                        $field,
                        fn (Builder $q) => $q->where('name', 'like', $keyword)
                    );
                } else {
                    $q->orWhere($field, 'like', $keyword);
                }
            }
        });
    }
}
