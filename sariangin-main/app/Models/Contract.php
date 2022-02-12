<?php

namespace App\Models;

use App\Traits\WithPaginatedData;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    use HasFactory, WithPaginatedData;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'from',
        'to',
    ];

    /**
     * Assign contract customer.
     * 
     * @param  int  $id  Customer id
     * @return \App\Models\DeliveryCustomer
     */
    public function assignCustomer($id)
    {
        $customer = Customer::findOrFail($id);

        if ($this->customer()->exists()) {
            $contractCustomer = $this->customer->fill([
                'customer_id' => $customer->id,
                'type' => $customer->type,
                'name' => $customer->name,
                'phone' => $customer->phone,
                'email' => $customer->email,
                'address' => $customer->address,
            ]);

            $contractCustomer->save();
        } else {
            $contractCustomer = new ContractCustomer([
                'customer_id' => $customer->id,
                'type' => $customer->type,
                'name' => $customer->name,
                'phone' => $customer->phone,
                'email' => $customer->email,
                'address' => $customer->address,
            ]);

            $this->customer()->save($contractCustomer);
        }

        return $contractCustomer;
    }

    /**
     * Save contract tanks.
     * 
     * @param  array  $items
     * @return void
     */
    public function saveTanks($items)
    {
        if ($this->tanks()->exists()) {
            $this->tanks()->delete();
        }

        foreach ($items as $data) {
            $tank = Tank::findOrFail(isset($data['contract_id']) ? $data['tank_id'] : $data['id']);

            $contractTank = new ContractTank([
                'contract_type' => $data['contract_type'],
                'tank_id' => $tank->id,
                'category_name' => $tank->category_name,
                'serial_number' => $tank->serial_number,
                'status' => $tank->status,
                'location' => $tank->location,
                'note' => $tank->note,
            ]);

            $this->tanks()->save($contractTank);
        }
    }

    /**
     * Return customer of this contract.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function customer()
    {
        return $this->hasOne(ContractCustomer::class);
    }

    /**
     * Return tanks of this contract.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tanks()
    {
        return $this->hasMany(ContractTank::class);
    }
}
