<?php

class SectionsController extends \BaseController {


	 
	public function show($section_id){
		$section = Section::find($section_id) ;

		$question = Question::where('section_id' , '=' , $section->id )->orderBy('created_at' , 'desc')->simplePaginate() ;

		return View::make('section.view')->with('section',$section)->with('questions',$question) ;
	}

	public function showAll(){
		
		return View::make('Section.viewall') ;
	}

	

	public static function showUser($user_id)
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
			<p>{{ Form::submit('Good!' , array(
			'class' => 'btn btn-primary'
			)) }}</p>
			<input type="hidden" name="source_id"  autocomplete="off" value="<?php echo $question->id; ?>">
			<input type="hidden" name="source_type"  autocomplete="off" value="question">
			<input type="hidden" name="handle"  autocomplete="off" value="like">
			<sinput type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
			{{ Form::close() }}
			
			{{ Form::open(array('url' => 'like')) }}
			<p>{{ Form::submit('Bad!' , array(
			'class' => 'btn btn-primary'
			)) }}</p>
			<input type="hidden" name="source_id"  autocomplete="off" value="<?php echo $question->id; ?>">
			<input type="hidden" name="source_type"  autocomplete="off" value="question">
			<input type="hidden" name="handle"  autocomplete="off" value="dislike">
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
									if($like->like == 2){
										$like->like = 1 ;
										$like->save() ;
										$question->like += 2 ;
										$question->save() ;
									}
									elseif($like->like == 1 ){
										$like->like = 0 ;
										$like->save() ;
										$question->like-- ;
										$question->save() ;
									}else{
										$like->like = 1 ;
										$flag = $like->save() ;
										if($flag){
											$question->like++ ;
											$question->save()  ;
										}
									}
								}else{
									$flag = Like::create([
										'user_id' => Auth::id() ,
										'source_type' => $source_type ,
										'source_id' => $source_id ,
										'like' => 1 ,
										]);
										if($flag){
											$question->like++ ;
											$question->save()  ;
										}
								}
								break;
							
							case 'dislike':
								if($like){
									if($like->like == 1){
										$like->like = 2 ;
										$like->save() ;
										$question->like -= 2 ;
										$question->save() ;
									}
									elseif($like->like == 1){
										$like->like = 2 ;
										$like->save() ;
										$question->like -= 2 ;
										$question->save() ;
									}
									elseif($like->like == 2 ){
										$like->like = 0 ;
										$like->save() ;
										$question->like++ ;
										$question->save() ;
									}else{
										$like->like = 2 ;
										$flag = $like->save() ;
										if($flag){
											$question->like-- ;
											$question->save()  ;
										}
									}
								}else{
									$flag = Like::create([
										'user_id' => Auth::id() ,
										'source_type' => $source_type ,
										'source_id' => $source_id ,
										'like' => 2 ,
										]);
									 if($flag){
											$question->like-- ;
											$question->save()  ;
										}
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
									if($like->like == 2){
										$like->like = 1 ;
										$like->save() ;
										$answer->like += 2 ;
										$answer->save() ;
									}
									elseif($like->like == 1 ){
										$like->like = 0 ;
										$like->save() ;
										$answer->like-- ;
										$answer->save() ;
									}else{
										$like->like = 1 ;
										$flag = $like->save() ;
										if($flag){
											$answer->like++ ;
											$answer->save()  ;
										}
									}
								}else{
									$flag = Like::create([
										'user_id' => Auth::id() ,
										'source_type' => $source_type ,
										'source_id' => $source_id ,
										'like' => 1 ,
										]);
									if($flag){
											$answer->like++ ;
											$answer->save()  ;
										}
								}
								break;
							
							case 'dislike':
								if($like){
									if($like->like == 1){
										$like->like = 2 ;
										$like->save() ;
										$answer->like -= 2 ;
										$answer->save() ;
									}
									elseif($like->like == 2 ){
										$like->like = 0 ;
										$like->save() ;
										$answer->like++ ;
										$answer->save() ;
									}else{
										$like->like = 2 ;
										$flag = $like->save() ;
										if($flag){
											$answer->like-- ;
											$answer->save()  ;
										}
									}
								}else{
									$flag = Like::create([
										'user_id' => Auth::id() ,
										'source_type' => $source_type ,
										'source_id' => $source_id ,
										'like' => 0 ,
										]);
										if($flag){
											$answer->like-- ;
											$answer->save()  ;
										}
								}
								break;
							}
					}else{
						return Redirect::back()->with('flash_error','No Answer found');
					}
					break;

		}

		return Redirect::back() ;

	}


	 

}