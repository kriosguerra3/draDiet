<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNewFieldsToPatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('patients', function (Blueprint $table) {
            $table->string('email');
            $table->text('past_medications');
            $table->time('schedule_wakes_up');
            $table->time('schedule_breakfast');
            $table->time('schedule_snack_am');
            $table->time('schedule_lunch');
            $table->time('schedule_snack_pm');
            $table->time('schedule_dinner');
            $table->time('schedule_sleeps');
            $table->enum('other_snacks', ['yes', 'no']);
            $table->enum('takes_turns', ['yes', 'no']);
            $table->enum('travels_frequently', ['yes', 'no']);
            $table->text('indications');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('patients', function (Blueprint $table) {
            //
        });
    }
}
