<?php

use Illuminate\Database\Migrations\Migration;

class MakeNotesTextualContent extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		DB::statement('ALTER TABLE subtasks MODIFY COLUMN `text` TEXT');
		DB::statement('ALTER TABLE todos MODIFY COLUMN `text` TEXT');
		DB::statement('ALTER TABLE tasks MODIFY COLUMN note TEXT');
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
		DB::statement('ALTER TABLE subtasks MODIFY COLUMN `text` VARCHAR(255)');
		DB::statement('ALTER TABLE todos MODIFY COLUMN `text` VARCHAR(255)');
		DB::statement('ALTER TABLE tasks MODIFY COLUMN note VARCHAR(255)');
	}

}
