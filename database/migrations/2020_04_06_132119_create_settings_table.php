<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSettingsTable extends Migration {

	public function up()
	{
		Schema::create('settings', function(Blueprint $table) {
			$table->increments('id');
			$table->text('notification_settings_text');
			$table->mediumText('about_app');
			$table->string('phone', 14);
			$table->string('email', 30)->unique();
			$table->string('facebook_link');
			$table->string('twitter_link');
			$table->string('instagram_link');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('settings');
	}
}