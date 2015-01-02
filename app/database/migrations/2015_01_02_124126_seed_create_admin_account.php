<?php

use Illuminate\Database\Migrations\Migration;

class SeedCreateAdminAccount extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{

			$user = Sentry:: createUser(array(
				'email'=> 'admin@admin.com',
				'password'=> 'changeme12345',
				'activated'=>true,
				'first_name'=>'Admin',
				'last_name'=>'Changeme',
			));
			$group = Sentry::findGroupByName('admin');
			$user->addGroup($group);
			$quicknote = new \Quicknote;
			$quicknote->user_id = $user->id;
			$quicknote->save();
			$userProfile = new \UserProfile;
			$userProfile->id = $user->id;
			$userProfile->save();
			$imageResult = App::make('AuthController')->{'createUserImage'}($user->id,$user->first_name,$user->last_name);
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
