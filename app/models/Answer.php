<?php

class Answer extends \Eloquent {
	protected $fillable = ['answer' , 'user_id' ,'question_id','like'];
}