<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;
use Watson\Validating\ValidatingTrait;

class ContentImage extends Eloquent {

	protected $table = 'contents_images';
	public $timestamps = true;
	protected $fillable = array('content_id', 'image_id', 'position');
	protected $visible = array('content_id', 'image_id', 'position');

	use SoftDeletingTrait;

	public function getContent()
	{
		return $this->belongsTo('Content');
	}

	public function getImage()
	{
		return $this->belongsTo('Image');
	}

	

}