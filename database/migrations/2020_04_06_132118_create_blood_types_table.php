<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBloodTypesTable extends Migration {

	public function up()
	{
		Schema::create('blood_types', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name', 3);
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('blood_types');
	}
}