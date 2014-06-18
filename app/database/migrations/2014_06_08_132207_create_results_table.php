<?php

use Illuminate\Database\Migrations\Migration;

class CreateResultsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('results', function($table) {
            $table->increments('ResultID');
            $table->string('Ridername', 255)->nullable();
            $table->integer('EventID')->unsigned()->index();
            $table->integer('RoundID')->unsigned()->index();
            $table->string('Filename', 255)->nullable();
            $table->float('Duration')->nullable();
            $table->float('HandicapDuration')->nullable();
            $table->float('AvSpeed')->nullable();
            $table->float('AvPower')->nullable();
            $table->float('AvCadence')->nullable();
            $table->float('AvHR')->nullable();
            $table->float('PowerToWeight')->nullable();
            $table->string('Trainer', 50)->nullable()->index();
            $table->boolean('Validated')->nullable();
            $table->boolean('Downloadable')->default("1")->nullable();
            $table->float('TimePenalty')->nullable();
            $table->text('Comments')->nullable();
            $table->dateTime('Uploaded')->nullable();
            $table->integer('UploadCount')->default("1")->nullable();
            $table->float('Weight')->nullable();
            $table->integer('Points')->nullable();
            $table->integer('TimeZoneOffset')->nullable();
            $table->text('ValidatorComments')->nullable();
            $table->timestamp('TimeStamp')->default("CURRENT_TIMESTAMP");
            $table->string('Filename2', 255)->nullable();
            $table->float('NormPower')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('results');
    }

}