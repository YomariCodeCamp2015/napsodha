<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');

	protected $fillable = ['email','name' , 'profile_pic' , 'password', 'address', 'contact' , 'company', 'dob', 'gender' ,'confirmed' , 'confirmation_code'];

	public function Post()
	{
	return $this->hasMany('Post' , 'user_id');
	}

	public function Notification()
	{
	return $this->hasMany('Notification' , 'user_id');
	}

	public function NotificationUnseen()
	{
		$nutifi = Notification::where('user_id','=',Auth::id())->where('seen','=',0)->get()->count() ;
		return $nutifi ;
	}


 
	public static function unreadmessage(){

		$user_id = Auth::id() ;
		$Conversationlist = array();
		$conversations = Conversation::where('user1_id','=',$user_id)
		->orWhere('user2_id','=',$user_id)->get() ;

		foreach ($conversations as $Conversation) {
			$Conversationlist[] = $Conversation->id ;
		}
		
		if(!empty($Conversationlist)){
			$message = Message::whereIn('conversation_id',$Conversationlist)
			->where('seen','=',0)->where('user_id','!=',$user_id)->get()->count() ;
		}else{
			return 0 ;
		}
		return $message ;

	}


}
