<?php

class Notification extends \Eloquent {
	protected $fillable = ['user_id','source_id' ,'source_type' ,'seen' ,'parent_type' ,'parent_id'];



	public static function sendNotification($source_type , $source_id){

		switch ($source_type) {
			case 'answer':
				 
				 $answer = Answer::find($source_id) ;
				 $question = Question::find($answer->question_id) ;
				 
				 $notification = Notification::where('user_id' ,'=',$question->user_id)
				 ->where('parent_type','=','question')
				 ->where('parent_id','=',$answer->question_id)->first() ;

				 if(!$notification){

					 if(Auth::id() != $question->user_id)
					 $newNotification = Notification::create([
					 	'user_id' => $question->user_id , 
					 	'source_type' => $source_type ,
					 	'source_id' => $source_id ,
					 	'parent_type' => 'question' ,
					 	'parent_id' => $answer->question_id , 
					 	]) ;
				}else{
					$notification->seen = 0 ;
					$notification->save() ;
				}
				break;
			
			case 'discussion':
				
				$userList = array() ;

				$discussion = Discussion::find($source_id) ;

				switch ($discussion->source_type) {
					case 'question':
				 	   $userList[] = User::find(Question::find($discussion->source_id)->user_id)->id ;//question writter
				 	   $otherDisscussion = Discussion::where('source_type' ,'=' , 'question')
				 	   ->where('source_id' ,'=' ,$discussion->source_id)->get() ;

				 	   foreach ($otherDisscussion as $discus) {
				 	   		if(Auth::id() != $discus->user_id)
				 	   			$userList[] = $discus->user_id ;
				 	   }

				 	   foreach ($userList as $user_id) {
				 	   		$notification = Notification::where('user_id','=' , $user_id)
				 	   			->where('parent_type','=','question')
				 	   			->where('parent_id' ,'=', $discussion->source_id)
				 	   			->where('source_type' ,'=', 'discussion')
				 	   			->first() ; //source_id is the id of the question

				 	   		if($notification){
				 	   			$notification->update([
				 	   				'source_id' => $discussion->id ,
				 	   				'seen' => 0 ,
				 	   				]);
				 	   		}else{
				 	   			$flag = Notification::create([
				 	   				'user_id' => $user_id , 
								 	'source_type' => 'question' ,
								 	'source_id' => $discussion->id ,
								 	'parent_type' => 'question' ,
								 	'parent_id' => $discussion->source_id , 
				 	   				]);
				 	   		}
				 	   }

						break;
					
					case 'answer':
						 $userList[] = User::find(Answer::find($discussion->source_id)->user_id)->id ;//answer writter
				 	   $otherDisscussion = Discussion::where('source_type' ,'=' , 'answer')
				 	   ->where('source_id' ,'=' ,$discussion->source_id)->get() ;

				 	   foreach ($otherDisscussion as $discus) {
				 	   		if(Auth::id() != $discus->user_id)
				 	   			$userList[] = $discus->user_id ;
				 	   }

				 	   foreach ($userList as $user_id) {
				 	   		$notification = Notification::where('user_id','=' , $user_id)
				 	   			->where('parent_type','=','answer')
				 	   			->where('parent_id' ,'=', $discussion->source_id)
				 	   			->where('source_type' ,'=', 'discussion')
				 	   			->first() ; //source_id is the id of the answer

				 	   		if($notification){
				 	   			$notification->update([
				 	   				'source_id' => $discussion->id ,
				 	   				'seen' => 0 ,
				 	   				]);
				 	   		}else{
				 	   			$flag = Notification::create([
				 	   				'user_id' => $user_id , 
								 	'source_type' => 'answer' ,
								 	'source_id' => $discussion->id ,
								 	'parent_type' => 'answer' ,
								 	'parent_id' => $discussion->source_id , 
				 	   				]);
				 	   		}
				 	   }
						break;
				}
				

				break;
		}

	}

}