<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClientNotificationTable extends Migration {

	public function up()
	{
		Schema::create('client_notification', function(Blueprint $table) {
			$table->increments('id');
			$table->boolean('is_read');
			$table->integer('client_id')->unsigned();
			$table->integer('notification_id')->unsigned();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('client_notification');
	}
}