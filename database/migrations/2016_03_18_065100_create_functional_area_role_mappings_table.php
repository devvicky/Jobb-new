<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFunctionalAreaRoleMappingsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('functional_area_role_mappings', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('functional_area')->nullable();
			$table->string('role')->nullable();
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
		Schema::drop('functional_area_role_mappings');
	}

}
