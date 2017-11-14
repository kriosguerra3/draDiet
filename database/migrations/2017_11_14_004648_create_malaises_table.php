<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMalaisesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('malaises', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->timestamps();
        });
        
        Schema::create('malaise_medication', function (Blueprint $table) {
            $table->integer('malaise_id')->unsigned();
            $table->foreign('malaise_id')->references('id')->on('malaises');
            $table->integer('medication_id')->unsigned();
            $table->foreign('medication_id')->references('id')->on('medications');
        });
            
        Schema::create('malaise_supplement', function (Blueprint $table) {
            $table->integer('malaise_id')->unsigned();
            $table->foreign('malaise_id')->references('id')->on('malaises');
            $table->integer('supplement_id')->unsigned();
            $table->foreign('supplement_id')->references('id')->on('supplements');
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
