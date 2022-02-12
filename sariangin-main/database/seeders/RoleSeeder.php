<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            [
                'name' => 'admin',
                'label' => 'Admin'
            ],
            [
                'name' => 'owner',
                'label' => 'Owner'
            ],
            [
                'name' => 'office staff',
                'label' => 'Staf Kantor'
            ],
            [
                'name' => 'warehouse staff',
                'label' => 'Staf Gudang'
            ],
            [
                'name' => 'refill staff',
                'label' => 'Staf Pengisian'
            ],
            [
                'name' => 'driver staff',
                'label' => 'Staf Driver'
            ],
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}
