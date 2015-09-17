<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;
use Watson\Validating\ValidatingTrait;

class Album extends Eloquent {

	protected $table = 'albums';
	public $timestamps = true;

	use SoftDeletingTrait;
	use Watson\Validating\ValidatingTrait;

	protected $dates = ['deleted_at'];
	protected $fillable = array('title', 'active');
	protected $visible = array('title', 'active', 'created_at', 'id', 'stars', 'images', 'image', 'date');

	protected $rules = array(
        'title'   => 'required|min:2'
    );

    protected $stars;
	protected $image;
	protected $images = array();

	public function votes()
    {
        return $this->hasMany('Vote', 'voteable_id');
    }

	public function images()
    {
        return $this->hasMany('Image', 'parent_id');
    }

}