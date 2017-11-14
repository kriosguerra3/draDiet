<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlergiableTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alergiable', function (Blueprint $table) {
            $table->integer('patient_id')->unsigned();            
            $table->foreign('patient_id')->references('id')->on('patients');
            $table->morphs('alergiable');
           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('alergiable', function (Blueprint $table) {
            //
        });
    }
}
