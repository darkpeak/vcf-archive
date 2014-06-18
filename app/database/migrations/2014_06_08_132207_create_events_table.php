<?php

use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function($table) {
            $table->increments('EventID');
            $table->integer('SoftwareID')->unsigned()->index();
            $table->integer('EventTypeID')->nullable()->unsigned()->index();
            $table->string('Name', 100)->nullable()->unique();
            $table->dateTime('Start')->nullable();
            $table->dateTime('End')->nullable();
            $table->integer('RoundCount')->default("1");
            $table->enum('RoundDurationUnit', array("Days", "Weeks", "Months"))->default("Weeks")->nullable();
            $table->integer('RoundDuration')->default("2")->nullable();
            $table->integer('DivisionCount')->default("1");
            $table->integer('MaxRiderUploads')->nullable();
            $table->boolean('ResultsVisible')->default("1")->nullable();
            $table->boolean('Visible')->nullable();
            $table->string('Creator', 255)->nullable();
            $table->integer('PointsForFirstPlace')->default("100")->nullable();
            $table->text('Comments')->nullable();
            $table->boolean('Handicaps')->default("1")->nullable();
            $table->timestamp('TimeStamp')->default("CURRENT_TIMESTAMP");
            $table->string('PGMF', 255)->nullable();
            $table->boolean('RegistrationOnly')->nullable();
            $table->boolean('Teams');
            $table->string('RLV', 255)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('events');
    }

}