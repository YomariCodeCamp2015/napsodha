<?php

class QuestionsController extends \BaseController {

	 public function show($id){

			$question = Question::find($id) ;

			$answers = Answer::where('question_id' ,'=',$question->id )->orderBy('like')->simplePaginate() ;

			return View::make('question.view')->with('question',$question)->with('answers',$answers) ;
		}


		public function create(){

			//custom message
		$messages = array(
   		 //'g-recaptcha-response.required' => 'We need to know if you are a human!',
   		 'question.required' => 'You Must Have A question' ,
		);

		//validate the info , create rules for the inputs
		$rules = array(
			'question' => 'required|min:4',
			//'g-recaptcha-response' => 'required|recaptcha'
		);


		// run the validation rules on the inputs from the form
		$validator = Validator::make(Input::all() ,$rules , $messages) ;

		//if the validator fails, redirect back to the form
		if($validator->fails()) {
			return Redirect::back()
				->withErrors($validator) //send back all errors to the
				->withInput(Input::all());
		}else{

			 
			$newQuestion = Question::create([

				'question' => htmlentities(Input::get('question')) ,
				'user_id' => Auth::id(),
				]);

			// Mail::queue('emails.verify', array('confirmation_code' =>$confirmation_code), function($message) {
   //          $message->to(Input::get('email'), Input::get('username'))
   //              ->subject('Verify your email address');
			// });
				return Redirect::back()->with('flash_notice' , 'Thanks For Question!<br>Someone will answer your question<br>Be patience');

		}
		}
}