<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;
use Watson\Validating\ValidatingTrait;

class Slider extends Eloquent {

	protected $table = 'sliders';
	public $timestamps = true;

	use SoftDeletingTrait;
	use Watson\Validating\ValidatingTrait;

	protected $dates = ['deleted_at'];
	protected $fillable = array('title', 'link', 'text', 'active', 'position');
	protected $visible = array('title', 'link', 'text', 'active', 'position', 'images', 'image');
	protected $images = array();
    protected $image;

	protected $rules = array(
        'title'   => 'required|min:2',
        'link'   => 'required|min:2',
        'text' => 'required|min:2'
    );

    public function images()
    {
        return $this->hasMany('Image', 'parent_id');
    }

}