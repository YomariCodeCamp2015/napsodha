@extends('layout')

 @section('title')
 Home
 @stop
 @section('head')
 <style>
 p.title{
    color: black;
    font-size: 20px;
    font-weight: bolder;
 }
 </style>
 @stop

 @section('body')
   <!--  <div class="container-fluid">
        <<div class="row">
            <div class="col-md-6"> -->
                <div class="well bs-component">
                        {{ Form::open(array('url' => 'question/create' , 'class' => 'form-horizontal')) }}
                        <fieldset>
                                 
                                @if(($errors->first()))
                                    <div class="form-group alert alert-warning">
                                        <tr class="warning">
                                            <ul>
                                                @if(($errors->has('question')))
                                                    <li><td>{{ $errors->first('question')}}</td></li>
                                                @endif
                                                @if(($errors->has('section')))
                                                    <li><td>{{ $errors->first('section')}}</td></li>
                                                @endif
                                            </ul>
                                        </tr>
                                    </div>
                                @endif
                            
                                 
                                <div class="form-group">
                                    {{ Form::label('question' , 'Question'  , array( 'class'=>'col-lg-2 control-label')) }}
                                    <div class="col-lg-10">
                                        {{ Form::text('question' , Input::old('question'),array('placeholder' => 'Write your question here' ,'class'=>'form-control')) }}
                                    </div>
                                </div>

                                <div class="form-group">
                                    {{ Form::label('section' , 'Sections'  , array( 'class'=>'col-lg-2 control-label')) }}
                                    <div class="col-lg-10">
                                        {{ Form::text('section' , Input::old('section'),array('placeholder' => 'Section separate by spaces ...eg: php mysql' ,'class'=>'form-control')) }}
                                    </div>
                                </div>


    
                                 
                                <div class="form-group">
                                    <div class="col-lg-10 col-lg-offset-2">
                                        <p>{{ Form::submit('Submit!' , array('class'=>'btn btn-primary btn-sm')) }}</p>
                                    </div>
                                </div>

                                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                        
                        </fieldset>
                        {{ Form::close() }}
                </div>
                <div class="well bs-component">

                 <?php 
                    $sections = SectionsController::showUser(Auth::id()) ;
                ?>

                @if($sections)
                @foreach($sections as $section)

                <h3>{{$section->name}} <h5>Recent Questions</h5></h3>

                <?php 


                    $question_lists = Questionsection::where('section_id' , '=' , $section->id)
                    ->orderBy('created_at','desc')->simplePaginate(4) ;

                    if($question_lists){                 
                        $questions = array() ;

                        foreach ($question_lists as $question_list) {
                            $questions[] = Question::find($question_list->question_id) ;
                 
                        }
                    }else{
                        $questions = array() ;
                    }

                 ?>
                <div class="row">
                @foreach($questions as $question)
                <a href="{{asset('question/'.$question->id)}}"><div class="col-md-3">
                {{$question->question}}
                </div></a>
                @endforeach
                </div>
                

                @endforeach
                @else
                    Add some section Use search bar
                @endif
                </div>
           <!--  </div>
        </div>
    </div> -->
    @stop

 
