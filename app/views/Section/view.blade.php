@extends('layout')

@section('body')


<div class="well bs-component">
<h2>Name : {{$section->name}}</h2><br>

About:: {{$section->about}}<br>
</div>
<?php 
$usersection = SectionUser::where('user_id','=',Auth::id())
				->where('section_id','=',$section->id)->first() ;
?>
@if(!$usersection)
<a class="btn btn-xs btn-success" href="{{asset('user/section/add/'.$section->id)}}">Add section {{$section->name}}</a>
@else
<a class="btn btn-xs btn-danger" href="{{asset('user/section/remove/'.$section->id)}}">Remove section {{$section->name}}</a>
@endif
<br>
<hr>
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
                                                
                                            </ul>
                                        </tr>
                                    </div>
                                @endif
                            
                                 
                                <div class="form-group">
                                    {{ Form::label('question' , 'Question'  , array( 'class'=>'col-lg-2 control-label')) }}
                                    <div class="col-lg-10">
                                        {{ Form::text('question' , Input::old('question'),array('placeholder' => 'Ask in this section ' ,'class'=>'form-control')) }}
                                    </div>
                                </div>

                                
                                <input type="hidden" name="section" value="<?php echo $section->name; ?>">
                                


    
                                 
                                <div class="form-group">
                                    <div class="col-lg-10 col-lg-offset-2">
                                        <p>{{ Form::submit('Submit!' , array('class'=>'btn btn-primary btn-sm')) }}</p>
                                    </div>
                                </div>

                                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                        
                        </fieldset>
                        {{ Form::close() }}
                </div>
<div class="row">
<div class="col-md-5">
<hr>
</div>
</div>

<br>

@foreach($questions as $question)
<div class="row">
<div class="col-md-12">
<a class="btn btn-default" href="{{asset('question/'.$question->id)}}">{{$question->question}}<br>
{{$question->created_at->diffForHumans()}}</a>
</div>
</div>
<br>
<br>

@endforeach
</div>
@stop