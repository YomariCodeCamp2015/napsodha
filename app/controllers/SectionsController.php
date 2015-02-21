<?php

class SectionsController extends \BaseController {


	 
	public function show($section_id){
		$section = Section::find($section_id) ;

		$question = Question::where('section_id' , '=' , $section->id )->orderBy('create_at' , 'desc')->simplePaginate() ;

		return View::make('section.view')->with('section',$section)->with('questions',$question) ;
	}

	public function showQuestion($id){

		$question = Question::find($id) ;

		$answers = Answer::where('question_id' ,'=',$question->id )->orderBy('like')->get() ;

		return View::make('question.view')->with('question',$question)->with('answers',$answers) ;
	}

	public function showUser($user_id)
	{
		$section_ids = Section_user::where('user_id' , '=' , $user_id )->get();
		$section_list = array() ;
		
		foreach ($section_ids as $section_id) {
			$section_list[] = $section_id->id ;
		}
		
		$section_list =  array_filter($section_list) ;
		
		if(empty($section_list))
			return null ;

		$section = Section::whereIn('id'  ,$section_list )->get();
		return $section ;
	}

	 
	public function register()
	{
		//custom message
		$messages = array(
   		 //'g-recaptcha-response.required' => 'We need to know if you are a human!',
   		 'name.required' => 'You Must Have A Name' ,
   		 'about.required' => 'Why there is this section' ,
		);

		//validate the info , create rules for the inputs
		$rules = array(
			'name' => 'required|alpha_spaces|min:4|max:32',
			'about' => 'required|alpha_spaces|min:4|max:32',
			//'g-recaptcha-response' => 'required|recaptcha'
		);


		// run the validation rules on the inputs from the form
		$validator = Validator::make(Input::all() ,$rules , $messages) ;

		//if the validator fails, redirect back to the form
		if($validator->fails()) {
			return Redirect::to('/section/register')
				->withErrors($validator) //send back all errors to the
				->withInput(Input::all());
		}else{

			//$confirmation_code = str_random(30);

			$data = Input::only(['name','about']);
			//$data['confirmation_code'] = $confirmation_code ; 
			$newSection = Section::create($data);

			// Mail::queue('emails.verify', array('confirmation_code' =>$confirmation_code), function($message) {
   //          $message->to(Input::get('email'), Input::get('username'))
   //              ->subject('Verify your email address');
			// });
			if($newSection){
				//Auth::login($newUser);
				return Redirect::to('home')->with('flash_notice' , 'Thanks For Register!')
				->withInput(Input::all() );
			}

			return Redirect::to('section/register') ;
		}
	}



	 

}