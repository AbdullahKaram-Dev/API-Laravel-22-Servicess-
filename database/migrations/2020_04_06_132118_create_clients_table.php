<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClientsTable extends Migration {

	public function up()
	{
		Schema::create('clients', function(Blueprint $table) {
			$table->increments('id');
			$table->string('phone', 14);
			$table->string('email', 30)->unique();
			$table->string('password');
			$table->string('name', 30);
			$table->date('date_of_birth');
			$table->enum('blood_type',array('O-','O+','B-','B+','A+','A-','AB-','AB+'));
			$table->date('last_doniation_date');
			$table->integer('city_id')->unsigned();
			$table->string('api_token', 60)->nullable()->unique();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('clients');
	}
}