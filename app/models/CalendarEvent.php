<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;
use Watson\Validating\ValidatingTrait;

class CalendarEvent extends Eloquent {

	protected $table = 'events';
	public $timestamps = true;

	use SoftDeletingTrait;
	use Watson\Validating\ValidatingTrait;

	protected $dates = ['deleted_at'];
	protected $fillable = array('title', 'crest', 'text', 'date', 'active');
	protected $visible = array('id', 'title', 'crest', 'text', 'date', 'active');


	protected $rules = array(
        'date'    => 'required',
        'title'   => 'required|min:2',
        'crest'   => 'required|max:300'
    );    

}