<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAlbumsTable extends Migration {

	public function up()
	{
		Schema::create('albums', function(Blueprint $table) {
			$table->increments('id');
			$table->string('title', 256);
			$table->enum('active', array('T', 'N'));
			$table->timestamps();
			$table->softDeletes();
			$table->integer('featured_image')->unsigned()->nullable()/*->default('NULL')*/;
		});
	}

	public function down()
	{
		Schema::drop('albums');
	}
}