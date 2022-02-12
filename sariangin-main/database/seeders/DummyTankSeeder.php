<?php

namespace Database\Seeders;

use App\Models\Tank;
use Illuminate\Database\Seeder;

class DummyTankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1001; $i < 10000; $i++) {
            $data = new Tank([
                'tank_category_id' => 1,
                'category_name' => 'Oksigen',
                'serial_number' => $i,
                'status' => 'Terisi',
                'location' => 'Gudang',
                'note' => 'Lorem ipsum dolor sit amet',
            ]);

            $data->save();
        }
    }
}
