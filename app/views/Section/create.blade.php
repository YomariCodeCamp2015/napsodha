@extends('layout')

 @section('title')
 Section Register
 @stop
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="well bs-component">
                        {{ Form::open(array('url' => 'section/create' , 'class' => 'form-horizontal')) }}
                        <fieldset>
                                 
                                @if(($errors->first()))
                                    <div class="form-group alert alert-warning">
                                        <tr class="warning">
                                            <ul>
                                                @if(($errors->has('name')))
                                                    <li><td>{{ $errors->first('name')}}</td></li>
                                                @endif
                                                @if(($errors->has('about')))
                                                    <li><td>{{ $errors->first('about')}}</td></li>
                                                @endif
                                            </ul>
                                        </tr>
                                    </div>
                                @endif
                            
                                 
                                <div class="form-group">
                                    {{ Form::label('name' , 'name'  , array( 'class'=>'col-lg-2 control-label')) }}
                                    <div class="col-lg-10">
                                        {{ Form::text('name' , Input::old('name'),array('placeholder' => 'Name of the section' ,'class'=>'form-control')) }}
                                    </div>
                                </div>

                                <div class="form-group">
                                    {{ Form::label('about' , 'about'  , array( 'class'=>'col-lg-2 control-label')) }}
                                    <div class="col-lg-10">
                                        {{ Form::text('about' , Input::old('about'),array('placeholder' => 'About the section' ,'class'=>'form-control')) }}
                                    </div>
                                </div>
    
                                 
                                <div class="form-group">
                                    <div class="col-lg-10 col-lg-offset-2">
                                        <p>{{ Form::submit('Submit!' , array('class'=>'btn btn-primary')) }}</p>
                                    </div>
                                </div>

                                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                        
                        </fieldset>
                        {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>

 
