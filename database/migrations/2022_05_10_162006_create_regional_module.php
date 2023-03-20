<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegionalModule extends Migration
{
    public function up()
    {
        Schema::create('provinces', function (Blueprint $table) {
            $table->id('id');
            $table->string('name');
        });
        Schema::create('cities', function (Blueprint $table) {
            $table->id('id');
            $table->foreignId('province_id');
            $table->string('name');
            $table->string('code', 6);
            $table->foreign('province_id')->references('id')->on('provinces');
        });
        Schema::create('subdistricts', function (Blueprint $table) {
            $table->id('id');
            $table->foreignId('city_id');
            $table->string('name');
            $table->foreign('city_id')->references('id')->on('cities');
        });
    }
    public function down()
    {
        Schema::dropIfExists('province');
        Schema::dropIfExists('city');
        Schema::dropIfExists('subdistrict');
    }
}
