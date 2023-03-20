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
        Schema::create('medical_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id');
            $table->foreignId('medical_personel_id');
            $table->string('history');
            $table->string('physical_examination');
            $table->string('diagnosis');
            $table->string('treatment');
            $table->timestamps();
            $table->foreign('patient_id')->references('id')->on('patients')->cascadeOnDelete();
            $table->foreign('medical_personel_id')->references('id')->on('medical_personels')->cascadeOnDelete();
        });

        Schema::create('physical_examinations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('medical_record_id');
            $table->integer('height');
            $table->integer('weight');
            $table->integer('belly_circumference');
            $table->double('bmi');
            $table->integer('sistole');
            $table->integer('diastole');
            $table->integer('respiratory_rate');
            $table->integer('heart_rate');
            $table->enum('status', ['Ya', 'Tidak']);
            $table->timestamps();
            $table->foreign('medical_record_id')->references('id')->on('medical_records')->cascadeOnDelete()->cascadeOnUpdate();
        });

        Schema::create('medical_record_medicines', function (Blueprint $table) {
            $table->id();
            $table->foreignId('medical_record_id');
            $table->foreignId('medicine_id');
            $table->integer('quantity');
            $table->string('procedure');
            $table->timestamps();
            $table->foreign('medical_record_id')->references('id')->on('medical_records')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('medicine_id')->references('id')->on('medicines')->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('medical_records');
        Schema::dropIfExists('physical_examinations');
        Schema::dropIfExists('medical_record_medicines');
    }
};
