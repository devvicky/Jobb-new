<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminControlsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('admin_controls', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id')->unsigned();
			$table->integer('profile_id')->unsigned();
			$table->string('subscribe')->nullable();
			$table->string('contact_view')->nullable();
			$table->integer('contact_view_count');
			$table->string('resume_view')->nullable();
			$table->integer('resume_view_count');
			$table->string('post_job')->nullable();
			$table->integer('post_job_count');
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
		Schema::drop('admin_controls');
	}

}
