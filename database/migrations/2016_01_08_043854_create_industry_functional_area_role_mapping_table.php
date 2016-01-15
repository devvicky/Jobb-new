<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIndustryFunctionalAreaRoleMappingTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('industry_functional_area_role_mappings', function(Blueprint $table)
			{
			$table->increments('id');
			$table->string('industry_functional_area')->nullable();
			$table->string('role')->nullable();
			$table->timestamps();
			$table->foreign('industry_functional_area')->references('id')->on('industry_functional_area_mappings');
			$table->foreign('role')->references('id')->on('roles');
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
