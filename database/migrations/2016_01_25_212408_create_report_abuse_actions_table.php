<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReportAbuseActionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('report_abuse_actions', function(Blueprint $table)
		{
			$table->increments('id');
			$table->unsignedInteger('post');
            $table->unsignedInteger('action_taken_by'); 
            $table->integer('warning_email_sent')->default(0)->nullable();
            $table->dateTime('email_dtTime')->nullable();
            $table->integer('post_inactive')->default(0)->nullable();
            $table->dateTime('post_inactivity_dtTime')->nullable();
            $table->integer('post_user_blocked')->default(0)->nullable();
            $table->dateTime('user_blocked_dtTime')->nullable();
            $table->foreign('post')->references('id')->on('postjobs');
            $table->foreign('action_taken_by')->references('id')->on('users');
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
		Schema::drop('report_abuse_actions');
	}

}
