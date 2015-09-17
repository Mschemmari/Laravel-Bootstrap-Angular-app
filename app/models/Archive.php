<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;
use Watson\Validating\ValidatingTrait;

class Archive extends Eloquent {

	protected $table = 'files';
	public $timestamps = true;

	use SoftDeletingTrait;
	use Watson\Validating\ValidatingTrait;

	protected $dates = ['deleted_at'];
	protected $fillable = array('title','news_id', 'type', 'filename', 'path');
	protected $visible = array('title','id','news_id', 'type', 'filename', 'path');

	protected $rules = array(
        'type'		 => 'required',
        'filename'     => 'required',
        'path'		 => 'required'
    );

}