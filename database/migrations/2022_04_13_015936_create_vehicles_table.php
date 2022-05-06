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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->integer('department_id');
            $table->integer('driver_id')->nullable();
            $table->string('vehicle_type')->nullable();
            $table->string('vehicle_year_model')->nullable();
            $table->string('plate_no')->nullable();
            $table->string('mv_file_no')->nullable();
            $table->string('motor_no')->nullable();
            $table->string('chasis_no')->nullable();
            $table->string('image_path')->nullable();
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
        Schema::dropIfExists('vehicles');
    }
};
