@extends('layout')
@section('title')
	Notification
@stop

@section('body')



@foreach($notifications as $notification)
<br>

<?php

switch ($notification->source_type) {
	case 'answer':
		$userNu = Answer::distinct()->select('user_id')->where('question_id' , '=', $notification->parent_id)
		->groupBy('user_id')->get()->count() ;

		$lastUser = User::find(Answer::find($notification->source_id)->user_id) ;

		if($userNu > 1)
			echo '<a href="/user/'.$lastUser->id.'">'.$lastUser->name.'</a> and '.($userNu-1).' more has answerd your question <a href="'.asset('question/'.$notification->parent_id).'">'.Str::limit(e(Question::find($notification->parent_id)->question),20).'</a>' ;
		else
			echo '<a href="/user/'.$lastUser->id.'">'.$lastUser->name.'</a> has answerd your question <a href="'.asset('question/'.$notification->parent_id).'">'.Str::limit(e(Question::find($notification->parent_id)->question),20).'</a>' ;
		break;
	
	case 'discussion':

			$userNu = Discussion::distinct()->select('user_id')->where('parent_id' , '=', $notification->parent_id)
			->groupBy('user_id')->get()->count() ;

			$lastUser = User::find(Discussion::find($notification->source_id)->user_id) ;

				switch ($notification->parent_type) {
					case 'question':
						
						if($userNu > 1)
							echo '<a href="/user/'.$lastUser->id.'">'.$lastUser->name.'</a> and '.($userNu-1).' more has discussed your question <a href="'.asset('question/'.$notification->parent_id).'">'.Str::limit(e(Question::find($notification->parent_id)->question),20).'</a>' ;
						else
							echo '<a href="/user/'.$lastUser->id.'">'.$lastUser->name.'</a> has discussed on your question <a href="'.asset('question/'.$notification->parent_id).'">'.Str::limit(e(Question::find($notification->parent_id)->question),20).'</a>' ;
							

					break;
					
					case 'answer':
						if($userNu > 1)
							echo '<a href="/user/'.$lastUser->id.'">'.$lastUser->name.'</a> and '.($userNu-1).' more has discussed on answer <a href="'.asset('question/'.$notification->parent_id).'">'.Str::limit(e(Question::find($notification->parent_id)->question),20).'</a>' ;
						else
							echo '<a href="/user/'.$lastUser->id.'">'.$lastUser->name.'</a> has discussed on your answer <a href="'.asset('question/'.$notification->parent_id).'">'.Str::limit(e(Question::find($notification->parent_id)->question),20).'</a>' ;
							
						break;
				}


					break;
			}

			$notification->seen = 1 ;
			$notification->save() ;


?>

<br>
@endforeach






@stop