<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRatUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('rat_users', function(Blueprint $table) {
			$table->increments('uid');
			$table->integer('ttid');
			$table->string('username');
			$table->string('password');
			$table->boolean('logged')->default(0);
			$table->boolean('busy')->default(0);
			$table->string('avatar')->default("./public/assets/images/default_avatar.png");
			$table->string('aname');
			$table->smallInteger('location')->default(0);
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('rat_users');
	}

}
