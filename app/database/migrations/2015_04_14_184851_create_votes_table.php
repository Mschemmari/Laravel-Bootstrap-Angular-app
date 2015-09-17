<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateVotesTable extends Migration {

	public function up()
	{
		Schema::create('votes', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('voteable_id')->unsigned();
			$table->string('voteable_type');
			$table->string('ip', 50);
			$table->integer('score')->unsigned();
			$table->timestamps();
			$table->softDeletes();
		});
	}

	public function down()
	{
		Schema::drop('votes');
	}
}