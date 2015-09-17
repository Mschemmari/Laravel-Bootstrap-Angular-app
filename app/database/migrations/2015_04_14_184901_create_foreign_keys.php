<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;

class CreateForeignKeys extends Migration {

	public function up()
	{
		Schema::table('albums', function(Blueprint $table) {
			$table->foreign('featured_image')->references('id')->on('images')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('images', function(Blueprint $table) {
			$table->foreign('album_id')->references('id')->on('albums')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('contents_images', function(Blueprint $table) {
			$table->foreign('content_id')->references('id')->on('contents')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('contents_images', function(Blueprint $table) {
			$table->foreign('image_id')->references('id')->on('images')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('sliders', function(Blueprint $table) {
			$table->foreign('content_id')->references('id')->on('contents')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
	}

	public function down()
	{
		Schema::table('albums', function(Blueprint $table) {
			$table->dropForeign('albums_featured_image_foreign');
		});
		Schema::table('images', function(Blueprint $table) {
			$table->dropForeign('images_album_id_foreign');
		});
		Schema::table('contents_images', function(Blueprint $table) {
			$table->dropForeign('contents_images_content_id_foreign');
		});
		Schema::table('contents_images', function(Blueprint $table) {
			$table->dropForeign('contents_images_image_id_foreign');
		});
		Schema::table('sliders', function(Blueprint $table) {
			$table->dropForeign('sliders_content_id_foreign');
		});
	}
}