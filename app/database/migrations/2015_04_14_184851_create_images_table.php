<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateImagesTable extends Migration {

	public function up()
	{
		Schema::create('images', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('album_id')->unsigned()->index()/*->default('NULL')*/;
			$table->string('name');
			$table->text('description');
			$table->enum('active', array('Y', 'N'));
			$table->timestamps();
			$table->softDeletes();
		});
	}

	public function down()
	{
		Schema::drop('images');
	}
}