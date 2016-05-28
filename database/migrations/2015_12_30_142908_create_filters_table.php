<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFiltersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('filter', function(Blueprint $table)
		{
			$table->increments('id');
			$table->unsignedInteger('from_user')->nullable();
			$table->string('job_title')->nullable();
			$table->string('time_for')->nullable();
			$table->string('experience')->nullable();
			$table->string('city')->nullable();
			$table->string('role')->nullable();
			$table->string('linked_skill')->nullable();
			$table->string('prof_category')->nullable();
			$table->string('unique_id')->nullable();
			$table->string('posted_by')->nullable();
			$table->string('expired')->nullable();
			$table->timestamps();
			$table->foreign('from_user')->references('id')->on('users')->onDelete('cascade');
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
