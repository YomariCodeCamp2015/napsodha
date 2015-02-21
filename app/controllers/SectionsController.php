<?php

class SectionsController extends \BaseController {


	 
	public function show($section_id){
		$section = Section::find($section_id) ;

		$question = Question::where('section_id' , '=' , $section->id )->orderBy('create_at' , 'desc')->simplePaginate() ;

		return View::make('section.view')->with('section',$section)->with('questions',$question) ;
	}

	

	public function showUser($user_id)
	{
		$section_ids = SectionUser::where('user_id' , '=' , $user_id )->get();
		$section_list = array() ;
		
		foreach ($section_ids as $section_id) {
			$section_list[] = $section_id->id ;
		}
		
		$section_list =  array_filter($section_list) ;
		
		if(empty($section_list))
			return null ;

		$sections = Section::whereIn('id'  ,$section_list )->get();
		return $sections ;
	}

	public function viewCreate(){

		return View::make('Section.create') ;
	}

	public function create()
	{
		//custom message
		$messages = array(
   		 //'g-recaptcha-response.required' => 'We need to know if you are a human!',
   		 'name.required' => 'You Must Have A Name' ,
   		 'about.required' => 'Why there is this section' ,
		);

		//validate the info , create rules for the inputs
		$rules = array(
			'name' => 'required|alpha_spaces|min:4|max:32|Unique:sections',
			'about' => 'required|alpha_spaces|min:4|max:32',
			//'g-recaptcha-response' => 'required|recaptcha'
		);


		// run the validation rules on the inputs from the form
		$validator = Validator::make(Input::all() ,$rules , $messages) ;

		//if the validator fails, redirect back to the form
		if($validator->fails()) {
			return Redirect::to('/section/create')
				->withErrors($validator) //send back all errors to the
				->withInput(Input::all());
		}else{
			$newSection = Section::create([
				'name' => Input::get('name') ,
				'author_id' => Auth::id() ,
				'about' => Input::get('about') ,
				]);

			// Mail::queue('emails.verify', array('confirmation_code' =>$confirmation_code), function($message) {
   //          $message->to(Input::get('email'), Input::get('username'))
   //              ->subject('Verify your email address');
			// });
				return Redirect::to('home')->with('flash_notice' , 'Thanks For Register!')->withInput(Input::all() );

		}
	}



	 

}