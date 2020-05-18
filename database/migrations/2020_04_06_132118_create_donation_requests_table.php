<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDonationRequestsTable extends Migration {

	public function up()
	{
		Schema::create('donation_requests', function(Blueprint $table) {
			$table->increments('id');
			$table->string('patient_name', 30);
			$table->string('patient_phone', 14);
			$table->integer('city_id')->unsigned();
			$table->string('hospital_name', 30);
			$table->integer('blood_type_id')->unsigned();
			$table->smallInteger('patient_age');
			$table->smallInteger('bags_number');
			$table->string('hospital_address', 30);
			$table->text('details');
			$table->decimal('longitude', 10,8);
			$table->decimal('latitude', 10,8);
			$table->integer('client_id')->unsigned();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('donation_requests');
	}
}