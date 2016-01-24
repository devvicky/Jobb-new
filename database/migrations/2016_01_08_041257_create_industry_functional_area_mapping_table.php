<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIndustryFunctionalAreaMappingTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('industry_functional_area_mappings', function(Blueprint $table)
		{
			$table->increments('id');
			$table->unsignedInteger('industry');
			$table->unsignedInteger('functional_area');
			$table->timestamps();
			$table->foreign('industry')->references('id')->on('industries');
			$table->foreign('functional_area')->references('id')->on('functional_areas');
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
