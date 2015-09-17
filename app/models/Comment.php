<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model {

	protected $table = 'comments';
	public $timestamps = true;

	use SoftDeletes;

	protected $dates = ['deleted_at'];
	protected $fillable = array('commentable_id', 'commentable_type', 'guest_email', 'guest_name', 'body', 'active');
	protected $visible = array('commentable_id', 'commentable_type', 'guest_email', 'guest_name', 'body', 'active');

}