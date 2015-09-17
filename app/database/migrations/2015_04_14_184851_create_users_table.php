<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration {

	public function up()
	{
		Schema::create('users', function(Blueprint $table) {
			$table->increments('id');
			$table->string('username', 24)->unique();
			$table->string('password', 256);
			$table->string('email', 256)/*->unique()*/;
			$table->enum('active', array('Y', 'N'));
			$table->timestamps();
			$table->softDeletes();
			//$table->rememberToken();
		});
	}

	public function down()
	{
		Schema::drop('users');
	}
}