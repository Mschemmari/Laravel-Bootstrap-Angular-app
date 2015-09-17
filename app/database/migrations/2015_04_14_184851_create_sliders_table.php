<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSlidersTable extends Migration {

	public function up()
	{
		Schema::create('sliders', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('content_id')->unsigned();
			$table->enum('category', array('home'));
			$table->integer('position')->unsigned();
			$table->enum('active', array('Y', 'N'));
			$table->timestamps();
			$table->softDeletes();
		});
	}

	public function down()
	{
		Schema::drop('sliders');
	}
}