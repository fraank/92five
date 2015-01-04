<?php

use Illuminate\Database\Migrations\Migration;

class EventCalendarCategoryConnection extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('events', function($table){
			$table->unsignedInteger('calendar_category_id')->nullable();
			$table->dropColumn('category');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('events', function($table) {
			$table->dropColumn('calendar_category_id');
			$table->string('category', 128)->nullable();
		});
	}

}
