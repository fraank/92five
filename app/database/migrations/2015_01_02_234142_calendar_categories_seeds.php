<?php

use Illuminate\Database\Migrations\Migration;

class CalendarCategoriesSeeds extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		DB::table('calendar_categories')->insert(
			array(
				array('title' => 'Meeting - General',
					'description' => '',
					'public_content' => false
				),
				array('title' => 'Meeting - Project',
					'description' => '',
					'public_content' => false
				),
				array('title' => 'Meeting - Task',
					'description' => '',
					'public_content' => false
				),
				array('title' => 'Deliverer',
					'description' => '',
					'public_content' => false
				),
				array('title' => 'Client',
					'description' => '',
					'public_content' => false
				),
				array('title' => 'Others',
					'description' => '',
					'public_content' => false
				)
			)
		);
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
