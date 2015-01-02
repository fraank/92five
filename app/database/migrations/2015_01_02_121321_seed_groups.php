<?php

use Illuminate\Database\Migrations\Migration;

class SeedGroups extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		DB::table('groups')->insert(
		array(
			array('id' => '1',
						'name' => 'admin',
						'permissions' => '{"project.create":1,"project.update":1,"project.view":1,"project.delete":1,"task.create":1,"task.update":1,"task.view":1,"task.delete":1,"milestone.create":1,"milestone.update":1,"milestone.view":1,"milestone.delete":1,"user.create":1,"user.update":1,"user.view":1,"user.delete":1,"role.create":1,"role.update":1,"role.view":1,"role.delete":1,"reports.create":1,"reports.update":1,"reports.view":1,"reports.delete":1,"groups.create":1,"groups.update":1,"groups.view":1,"groups.delete":1}'
			),
			array('id' => '2',
						'name' => 'manager',
						'permissions' => '{"project.create":1,"project.update":1,"project.view":1,"project.delete":1,"task.create":1,"task.update":1,"task.view":1,"task.delete":1,"milestone.create":1,"milestone.update":1,"milestone.view":1,"milestone.delete":1,"user.view":1,"role.view":1,"reports.create":1,"reports.update":1,"reports.view":1,"reports.delete":1,"groups.view":1}'
			),
			array('id' => '3',
						'name' => 'leader',
						'permissions' => '{"project.update":1,"project.view":1,"task.create":1,"task.update":1,"task.view":1,"task.delete":1,"milestone.create":1,"milestone.update":1,"milestone.view":1,"milestone.delete":1,"user.view":1,"role.view":1,"reports.create":1,"reports.update":1,"reports.view":1}'
			),
			array('id' => '4',
						'name' => 'user',
						'permissions' => '{"project.view":1,"task.create":1,"task.update":1,"task.view":1,"task.delete":1,"milestone.update":1,"milestone.view":1,"milestone.delete":1,"user.view":1,"reports.view":1}'
			),
		));
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
