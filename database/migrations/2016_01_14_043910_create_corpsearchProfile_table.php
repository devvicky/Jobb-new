<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCorpsearchProfileTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('corpsearchprofiles', function(Blueprint $table)
        {
            $table->increments('id');
			$table->unsignedInteger('from_user')->nullable();
			$table->string('city')->nullable();
			$table->string('name')->nullable();
			$table->string('role')->nullable();
			$table->string('working_at')->nullable();
			$table->string('mobile')->nullable();
			$table->string('min_exp')->nullable();
            $table->string('max_exp')->nullable();
			$table->string('prefered_jobtype')->nullable();
			$table->string('resume')->nullable();
			$table->string('type')->nullable();
            $table->string('skills')->nullable();
			$table->timestamps();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('corpsearchprofiles');
    }

}