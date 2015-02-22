<?php

class QuestionsController extends \BaseController {

	 public function show($id){

			$question = Question::find($id) ;

			$answers = Answer::where('question_id' ,'=',$question->id )->orderBy('like' , 'desc')->simplePaginate() ;

			return View::make('question.show')->with('question',$question)->with('answers',$answers) ;
		}


	public function create(){

			//custom message
		$messages = array(
   		 'question.required' => 'You Must Have A question' ,
   		 'section.required' => 'Your question must belong to one section' ,
		);

		//validate the info , create rules for the inputs
		$rules = array(
			'question' => 'required|min:4',
			'section' => 'required|min:2',
		);


		// run the validation rules on the inputs from the form
		$validator = Validator::make(Input::all() ,$rules , $messages) ;

		//if the validator fails, redirect back to the form
		if($validator->fails()) {
			return Redirect::back()
				->withErrors($validator) //send back all errors to the
				->withInput(Input::all());
		}else{

			$section_list = preg_split('/\s+/', Input::get('section'));

			foreach ($section_list as $sectionName) {
					 $section = Section::where('name','=',$sectionName)->first() ;
					 if(!$section)
					 	return Redirect::back()
					 	->withErrors(['section' => 'Section: '.$sectionName.' doesnot exists'])
					  	->withInput(Input::all());
			}

			 
			if(!$section)
				return Redirect::back()->with('flash_error' , 'Section not found ');
			 
			$newQuestion = Question::create([
				'question' => Input::get('question') ,
				'user_id' => Auth::id(),
				]);

			 
			if($newQuestion){
				
					foreach ($section_list as $sectionName) {
						 $section = Section::where('name','=',$sectionName)->first() ;
						
						$flag = Questionsection::create([
							'section_id' => $section->id ,
							'question_id' => $newQuestion->id
							]) ;
				}

				return Redirect::back()->with('flash_notice' , 'Thanks For Question!<br>Someone will answer your question<br>Be patience');
			}

			return Redirect::to('section/create')->with('flash_error' , 'Something went wrong!') ;

		}
		}


	public function addAnswer(){
		$messages = array(
   		 'answer.required' => 'Answer field cant be empty' ,
		);

		//validate the info , create rules for the inputs
		$rules = array(
			'answer' => 'required|min:4',
		);


		// run the validation rules on the inputs from the form
		$validator = Validator::make(Input::all() ,$rules , $messages) ;

		//if the validator fails, redirect back to the form
		if($validator->fails()) {
			return Redirect::back()
				->withErrors($validator) //send back all errors to the
				->withInput(Input::all());
		}else{

			$question = Question::find(Input::get('question_id')); 
			
			if(!$question)
				return Redirect::back()->with('flash_error' , 'No question found!') ;

			$newAnswer = Answer::create([
				'answer' => Input::get('answer') ,
				'user_id' => Auth::id(),
				'question_id' => $question->id ,
				]);

			 
			if($newAnswer){
				Notification::sendNotification('answer',$newAnswer->id) ;
				return Redirect::back()->with('flash_notice' , 'Thanks For Answer!');
			}

			return Redirect::back()->with('flash_error' , 'Something went wrong!') ;

		}
		 
	}

	public function addQuesDiscuss(){
		$messages = array(
   		 'discussion.required' => 'Discussion field cant be empty' ,
		);

		//validate the info , create rules for the inputs
		$rules = array(
			'discussion' => 'required|min:4',
		);


		// run the validation rules on the inputs from the form
		$validator = Validator::make(Input::all() ,$rules , $messages) ;

		//if the validator fails, redirect back to the form
		if($validator->fails()) {
			return Redirect::back()
				->withErrors($validator) //send back all errors to the
				->withInput(Input::all());
		}else{

			$question = Question::find(Input::get('discussion_question_id')); 
		 
			if(!$question)
				return Redirect::back()->with('flash_error' , 'No question found!') ;

			$newDiscuss = Discussion::create([
				'discussion' => Input::get('discussion') ,
				'user_id' => Auth::id(),
				'source_id' => $question->id ,
				'source_type' => 'question' ,
				]);

			 
			if($newDiscuss){
				return Redirect::back() ;
			}

			return Redirect::back()->with('flash_error' , 'Something went wrong!') ;

		}
		 
	}

		public function addAnsDiscuss(){
		$messages = array(
   		 'discussion.required' => 'Discussion field cant be empty' ,
		);

		//validate the info , create rules for the inputs
		$rules = array(
			'discussion' => 'required|min:4',
		);


		// run the validation rules on the inputs from the form
		$validator = Validator::make(Input::all() ,$rules , $messages) ;

		//if the validator fails, redirect back to the form
		if($validator->fails()) {
			return Redirect::back()
				->withErrors($validator) //send back all errors to the
				->withInput(Input::all());
		}else{

			$answer = Answer::find(Input::get('discussion_answer_id')); 
			
			if(!$answer)
				return Redirect::back()->with('flash_error' , 'No answer found!') ;

			$newDiscuss = Discussion::create([
				'discussion' => Input::get('discussion') ,
				'user_id' => Auth::id(),
				'source_id' => $answer->id ,
				'source_type' => 'answer' ,
				]);

			 
			if($newDiscuss){
				return Redirect::back() ;
			}

			return Redirect::back()->with('flash_error' , 'Something went wrong!') ;

		}
		 
	}
}