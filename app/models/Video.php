<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;
use Watson\Validating\ValidatingTrait;

class Video extends Eloquent {

	protected $table = 'videos';
	public $timestamps = true;

	use SoftDeletingTrait;
	use Watson\Validating\ValidatingTrait;

	protected $dates = ['deleted_at'];
	protected $fillable = array('title', 'link', 'active');
	protected $visible = array('title', 'link', 'active', 'created_at', 'id', 'stars', 'images', 'image', 'date');

	protected $stars;
	protected $images = array();
	protected $image;

	protected $rules = array(
        'title'   => 'required|min:2',
        'link'   => 'required|min:2'
    );

    public function votes()
    {
        return $this->hasMany('Vote', 'voteable_id');
    }

	public function images()
    {
        return $this->hasMany('Image', 'parent_id');
    }

}