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
           <!--  </div>
        </div>
    </div> -->
    @stop

 
