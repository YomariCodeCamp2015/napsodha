<?php

class Question extends \Eloquent {
	protected $fillable = ['question','user_id' , 'like'];
}