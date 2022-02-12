<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeliveryTanksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('delivery_tanks', function (Blueprint $table) {
            $table->id();

            $table->foreignId('delivery_tank_category_id')
                ->constrained('delivery_tank_categories')
                ->cascadeOnDelete();

            $table->foreignId('tank_id')
                ->nullable()
                ->constrained('tanks')
                ->cascadeOnDelete();
            $table->string('category_name');
            $table->string('serial_number');
            $table->string('status');
            $table->string('location');
            $table->text('note')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('delivery_tanks');
    }
}
