<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateNotificationsTable extends Migration {

	public function up()
	{
		Schema::create('notifications', function(Blueprint $table) {
			$table->increments('id');
			$table->string('title');
			$table->mediumText('content');
			$table->integer('donation_request_id')->unsigned();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('notifications');
	}
}