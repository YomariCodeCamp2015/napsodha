<?php

class SectionsController extends \BaseController {


	 
	public function show($section_id){
		$section = Section::find($section_id) ;

		$question = Question::where('section_id' , '=' , $section->id )->orderBy('create_at' , 'desc')->simplePaginate() ;

		return View::make('section.view')->with('section',$section)->with('questions',$question) ;
	}

	public function showAll(){
		
		return View::make('Section.viewall') ;
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
   		 'name.required' => 'You Must Have A Name' ,
   		 'about.required' => 'Why need this section' ,
		);

		//validate the info , create rules for the inputs
		$rules = array(
			'name' => 'required|alpha_spaces|min:4|max:32|Unique:sections',
			'about' => 'required|alpha_spaces|min:4|max:32',
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

			 
			if($newSection){
				return Redirect::to('home')->with('flash_notice' , 'Thanks For Register!')
				->withInput(Input::all() );
			}

			return Redirect::to('section/create')->with('flash_error' , 'Something went wrong!') ;
		}
	}



	public function likeHandler(){

		/*

		{{ Form::open(array('url' => 'like')) }}
		<p>{{ Form::submit('Discuss!' , array(
		'class' => 'btn btn-primary'
		)) }}</p>
		<input type="hidden" name="discussion_question_id"  autocomplete="off" value="<?php echo $question->id; ?>">
		<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
		{{ Form::close() }}

		

		*/	
		$source_id = Input::get('source_id'); //question->id or answer->id
		$source_type = Input::get('source_type') ; // question or answer
		$handle = Input::get('handle'); //like or dislike

		switch ($source_type) {
			case 'question':
				$question = Question::find($source_id) ;
					if($question){
						$like = Like::where('source_type' ,'=' ,$source_type)
						->where('user_id' ,'=' ,Auth::id())
						->where('source_id' ,'=' ,$source_id)
						->first() ;
						switch ($handle) {
						case 'like':
							if($like){
								if($like->like == 1 ){
									return Redirect::back()->withErrors(['like' => 'Already Liked']) ;
								}else{
									$like->like = 1 ;
									$like->save() ;
								}
							}else{
								$like = Like::create([
									'user_id' => Auth::id() ,
									'source_type' => $source_type ,
									'source_id' => $section_id ,
									'like' => 1 ,
									]);
							}
							break;
						
						case 'dislike'
							if($like){
								if($like->like == 0 ){
									return Redirect::back()->withErrors(['like' => 'Already DisLiked']) ;
								}else{
									$like->like = 0 ;
									$like->save() ;
								}
							}else{
								$like = Like::create([
									'user_id' => Auth::id() ,
									'source_type' => $source_type ,
									'source_id' => $section_id ,
									'like' => 0 ,
									]);
							}
							break;
						}
				}else{
					return Redirect::back()->with('flash_error','No Question found');
				}
				break;
			
			case 'answer':
				$answer = Answer::find($source_id) ;
					if($answer){
						$like = Like::where('source_type' ,'=' ,$source_type)
						->where('user_id' ,'=' ,Auth::id())
						->where('source_id' ,'=' ,$source_id)
						->first() ;
						switch ($handle) {
						case 'like':
							if($like){
								if($like->like == 1 ){
									return Redirect::back()->withErrors(['like' => 'Already Liked']) ;
								}else{
									$like->like = 1 ;
									$like->save() ;
								}
							}else{
								$like = Like::create([
									'user_id' => Auth::id() ,
									'source_type' => $source_type ,
									'source_id' => $section_id ,
									'like' => 1 ,
									]);
							}
							break;
						
						case 'dislike'
							if($like){
								if($like->like == 0 ){
									return Redirect::back()->withErrors(['like' => 'Already DisLiked']) ;
								}else{
									$like->like = 0 ;
									$like->save() ;
								}
							}else{
								$like = Like::create([
									'user_id' => Auth::id() ,
									'source_type' => $source_type ,
									'source_id' => $section_id ,
									'like' => 0 ,
									]);
							}
							break;
						}
				}else{
					return Redirect::back()->with('flash_error','No Answer found');
				}
				break;

	}


	 

}