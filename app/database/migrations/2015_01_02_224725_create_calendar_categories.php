<?php

use Illuminate\Database\Migrations\Migration;

class CreateCalendarCategories extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('calendar_categories', function($table) {
			$table->increments('id');

			$table->string('title', 255)->nullable();
			$table->text('description')->nullable();
			
			$table->boolean('public_content');

			$table->dateTime('deleted_at')->nullable();
			$table->dateTime('created_at')->nullable();
			$table->dateTime('updated_at')->nullable();
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
		Schema::drop('calendar_categories');
	}

}
