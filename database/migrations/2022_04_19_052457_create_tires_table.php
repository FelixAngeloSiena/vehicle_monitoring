<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tires', function (Blueprint $table) {
            $table->id();
            $table->integer('vehicle_id');
            $table->string('front_left_tire');
            $table->string('front_right_tire');
            $table->string('rear_left_tire');
            $table->string('rear_right_tire');
            $table->string('date_changed');
            $table->string('date_next_change');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tires');
    }
};
