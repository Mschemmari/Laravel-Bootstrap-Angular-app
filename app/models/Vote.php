<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;
use Watson\Validating\ValidatingTrait;

class Vote extends Eloquent {

	protected $table = 'votes';
	public $timestamps = true;

	use ValidatingTrait;
	use SoftDeletingTrait;

	protected $dates = ['deleted_at'];
	protected $fillable = array('voteable_id', 'voteable_type', 'ip', 'score');
	protected $visible = array('voteable_id', 'voteable_type', 'ip', 'score');

	public static function getAverage($votes){
		$totalScore = 0;
		$avg = 0;
		$quantity = count($votes);
		if($quantity > 0){
			foreach ($votes as $vote) 
				$totalScore += $vote['score']; 
			$avg = $totalScore / $quantity;
		}
		return $avg;
	}
}