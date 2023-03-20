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
        Schema::create('medical_personels', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('identity_number')->unique();
            $table->string('profession');
            $table->string('position');
            $table->string('education');
            $table->string('address');
            $table->foreignId('province_id');
            $table->foreignId('city_id');
            $table->foreignId('subdistrict_id');
            $table->string('phone_number');
            $table->string('email')->unique();
            $table->timestamps();
            $table->foreign('province_id')->references('id')->on('provinces');
            $table->foreign('city_id')->references('id')->on('cities');
            $table->foreign('subdistrict_id')->references('id')->on('subdistricts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('medical_personels');
    }
};
