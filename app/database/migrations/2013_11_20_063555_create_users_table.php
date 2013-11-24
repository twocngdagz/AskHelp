<?php

use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function($table) 
		{
		    $table->increments('id');
		    $table->string('username',128);
		    $table->string('firstname', 128);
		    $table->string('lastname', 64);
		    $table->string('accesstoken', 256);
		    $table->string('fbid');
		    $table->string('cellnumber');
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
		Schema::drop('users');
	}

}