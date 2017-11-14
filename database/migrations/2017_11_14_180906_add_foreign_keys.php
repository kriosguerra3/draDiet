<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('assessment_visit', function (Blueprint $table) {
            $table->renameColumn('assesment_id', 'assessment_id');            
        });
        
        Schema::table('assessment_visit', function (Blueprint $table) {
            $table->integer('assessment_id')->unsigned()->change();
            $table->foreign('assessment_id')->references('id')->on('assessments');
            $table->dropColumn('id');
        });       
        
        Schema::table('malaise_medication', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->text('dose');
        });
        
        Schema::table('malaise_supplement', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->text('dose');
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
