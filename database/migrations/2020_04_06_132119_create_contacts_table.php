<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateContactsTable extends Migration {

	public function up()
	{
		Schema::create('contacts', function(Blueprint $table) {
			$table->increments('id');
			$table->string('phone', 14);
			$table->string('email', 30);
			$table->string('title_message');
			$table->text('message');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('contacts');
	}
}