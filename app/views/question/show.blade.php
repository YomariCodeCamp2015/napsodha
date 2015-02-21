@extends('layout')
@section('head')
<style>
p.qn{
	font-size: 16px;
}
p.like{
	font-size: 12px;
}
.divider {
  height: 1px;
  width:100%;
  display:block; /* for use on default inline elements like span */
  margin: 9px 0;
  overflow: hidden;
  background-color: #B8B8FF;
}
</style>
@stop

@section('body')
<div class="well bs-component">
<div class="row">
	<div class="col-md-2">
	<button type="button" class="btn btn-default" aria-label="Left Align">
	<span class="glyphicon glyphicon-user" aria-hidden="true"></span></button>
<p class="title">{{User::find($question->user_id)->name}}</p>
</div>
<p class="qn">{{$question->question}}</p>
<p class="like">{{'Likes :: '}}<span class="badge">{{$question->like}}</span>
<?php echo "\t"; ?>	{{'Answers :: '}}<span class="badge">{{$question->like}}</span>
{{ 'Discussions::'}}<span class="badge">{{$question->like}}</span></p>
</div>




<div class="row">
<?php 

$discussions = Discussion::where('source_type' ,'=' ,'question')->where('source_id','=',$question->id)->orderBy('created_at')->get() ;


foreach ($discussions as $discussion) {
	echo User::find($discussion->user_id)->name.' :: '.$discussion->discussion.'<br>' ;
}
?>
</div>



@if(Auth::check())

<div class="row">


 {{ Form::open(array('url' => 'discussion/question/create')) }}
 <div class="col-md-2">
 </div>
<div class="col-md-8">
{{ Form::label('discussion' , 'Discuss!') }}
{{ Form::textarea('discussion' ,'' ,  array(
'placeholder'   => 'Discuss here!' , 
'class'         => 'form-control'   ,
'rows'          => '2' ,
)) }}

</div>


<div class="col-md-2">
<br><br>	
<p align="center">{{ Form::submit('Discuss!' , array(
'class' => 'btn btn-primary btn-sm'
)) }}</p>
</div>
</div>


<input type="hidden" name="discussion_question_id"  autocomplete="off" value="<?php echo $question->id; ?>">
<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
{{ Form::close() }}






<div class="row">
<div class="col-md-10">
 {{ Form::open(array('url' => 'answer/create')) }}

{{ Form::label('answer' , 'Answer!') }}
{{ Form::textarea('answer' ,'' ,  array(
'placeholder'   => 'Write Answer Here!' , 
'class'         => 'form-control'   ,
'rows'          => '2' ,
)) }}
</p>
</div>
<br><br>
<div class="col-md-2">
<p>{{ Form::submit('Answer!' , array(
'class' => 'btn btn-primary btn-sm'
)) }}</p>
</div>
</div>
<input type="hidden" name="question_id"  autocomplete="off" value="<?php echo $question->id; ?>">
<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
{{ Form::close() }}


@endif








@foreach($answers as $answer)
<span class="divider"></span>

<div class="row">
	<div class="col-md-1">

		<p class="qn"><span class="badge">{{$answer->like}}</span></p>
	</div>
	<div class ="col-md-2">
		<button type="button" class="btn btn-default btn-sm" aria-label="Left Align">
	<span class="glyphicon glyphicon-user" aria-hidden="true"></span></button>
	</div>
	<div class="col-md-9">
	{{$answer->answer}}
{{'<br>'}}
<p class="like">Discussions::<span class="badge">{{$answer->like}}</span></p>
{{'<br>'}}
</div>
</div>
@endforeach


<?php 

$discussions = Discussion::where('source_type' ,'=' ,'answer')->where('source_id','=',$answer->id)->orderBy('created_at')->get() ;
?>



@foreach ($discussions as $discussion)
<div class="row">
<div class="col-md-2">
</div>

<div class="col-md-2">
	<span class="divider"></span>
	<button type="button" class="btn btn-default btn-xs" aria-label="Left Align">
	<span class="glyphicon glyphicon-user" aria-hidden="true"></span></button>

	<p class="like">{{ User::find($discussion->user_id)->name }}</p>
</div>
<div class="col-md-8">
	<span class="divider"></span>
{{ $discussion->discussion }}

</div>
</div>
@endforeach


@if(Auth::check())
{{ Form::open(array('url' => 'discussion/answer/create')) }}
<div class="row">
	<div class="col-md-2">
	</div>
	<div class="col-md-8">

{{ Form::label('discussion' , 'Discuss!') }}
{{ Form::textarea('discussion' ,'' ,  array(
'placeholder'   => 'Discuss here!' , 
'class'         => 'form-control'   ,
'rows'          => '2' ,
)) }}
	</div>
	<div class="col-md-2">
<p align="center">{{ Form::submit('Discuss!' , array(
'class' => 'btn btn-primary btn-sm'
)) }}</p>
</div>
<input type="hidden" name="discussion_answer_id"  autocomplete="off" value="<?php echo $answer->id; ?>">
<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
{{ Form::close() }}
@endif

</div>

@stop