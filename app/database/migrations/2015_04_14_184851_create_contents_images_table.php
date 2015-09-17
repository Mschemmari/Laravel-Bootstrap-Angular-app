<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateContentsImagesTable extends Migration {

	public function up()
	{
		Schema::create('contents_images', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('content_id')->unsigned();
			$table->integer('image_id')->unsigned();
			$table->integer('position')->unsigned();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('contents_images');
	}
}