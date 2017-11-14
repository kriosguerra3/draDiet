<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeys3 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
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
        //
    }
}
