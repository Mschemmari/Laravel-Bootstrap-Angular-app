<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCommentsTable extends Migration {

	public function up()
	{
		Schema::create('comments', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('commentable_id')->unsigned();
			$table->string('commentable_type');
			$table->string('guest_email', 256);
			$table->string('guest_name');
			$table->text('body');
			$table->timestamps();
			$table->softDeletes();
			$table->enum('active', array('Y', 'N'));
		});
	}

	public function down()
	{
		Schema::drop('comments');
	}
}