<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientIllnessTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {                       
        Schema::create('illness_patient', function (Blueprint $table) {
            $table->integer('illness_id')->unsigned();
            $table->foreign('illness_id')->references('id')->on('illnesses');            
            $table->integer('patient_id')->unsigned();
            $table->foreign('patient_id')->references('id')->on('patients');            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
