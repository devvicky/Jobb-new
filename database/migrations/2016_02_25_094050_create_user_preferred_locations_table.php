<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserPreferredLocationTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user_preferred_locations', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id')->unsigned();
            $table->string('locality', 100);
            $table->string('city', 100);
            $table->string('state', 100);
            $table->foreign('user_id')->references('id')->on('users');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('user_preferred_locations');
	}

}
