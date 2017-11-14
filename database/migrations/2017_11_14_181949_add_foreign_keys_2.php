<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeys2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {                
        Schema::table('assessment_visit', function (Blueprint $table) {
            $table->integer('visit_id')->unsigned()->change();
            $table->foreign('visit_id')->references('id')->on('visits');            
        });
        
        Schema::table('illness_medication', function (Blueprint $table) {
            $table->integer('illness_id')->unsigned()->change();
            $table->foreign('illness_id')->references('id')->on('illnesses');
            $table->integer('medication_id')->unsigned()->change();
            $table->foreign('medication_id')->references('id')->on('medications');            
        });
       
        Schema::table('illness_supplement', function (Blueprint $table) {
            $table->integer('illness_id')->unsigned()->change();
            $table->foreign('illness_id')->references('id')->on('illnesses');
            $table->integer('supplement_id')->unsigned()->change();
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
        Schema::table('assessment_visit', function (Blueprint $table) {
            //
        });
    }
}
