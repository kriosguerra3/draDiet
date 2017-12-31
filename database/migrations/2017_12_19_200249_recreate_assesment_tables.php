<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RecreateAssesmentTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assessments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
        
        Schema::create('assessment_visit', function (Blueprint $table) {
            $table->integer('assesment_id')->unsigned();
            $table->foreign('assesment_id')->references('id')->on('assessments');
            $table->integer('visit_id')->unsigned();
            $table->foreign('visit_id')->references('id')->on('visits');
            $table->timestamps();
            $table->softDeletes();            
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
