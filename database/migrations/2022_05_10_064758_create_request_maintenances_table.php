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
        Schema::create('request_maintenances', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('vehicle_id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('status');
            $table->string('request_type');
            $table->string('description')->nullable();
            $table->string('front_left_tire')->nullable();
            $table->string('front_right_tire')->nullable();
            $table->string('rear_left_tire')->nullable();
            $table->string('rear_right_tire')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('request_maintenances');
    }
};
