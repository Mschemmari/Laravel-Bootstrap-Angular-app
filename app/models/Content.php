<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;
use Watson\Validating\ValidatingTrait;

class Content extends Eloquent {

	protected $table = 'contents';
	public $timestamps = true;

	use SoftDeletingTrait;
	use Watson\Validating\ValidatingTrait;

	protected $dates = ['deleted_at'];
	protected $fillable = array('title', 'crest', 'category', 'text', 'volanta', 'active', 'position');
	protected $visible = array('title', 'crest', 'category', 'text', 'volanta', 'created_at', 'id', 'stars', 'images', 'image', 'date', 'active', 'archive', 'position');

	protected $stars;
	protected $images = array();
    protected $image;
    public $formated_date;

	protected $rules = array(
        'category' => 'required',
        'title'   => 'required|min:2',
        'crest'   => 'required|min:2',
        'text' => 'required|min:2'
    );

    public function votes()
    {
        return $this->hasMany('Vote', 'voteable_id');
    }

	public function images()
    {
        return $this->hasMany('Image', 'parent_id');
    }

    public function archive()
    {
        return $this->hasOne('Archive', 'news_id');
    }
    

}