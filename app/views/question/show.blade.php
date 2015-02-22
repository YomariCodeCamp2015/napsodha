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
button.btn-success{
	color: #000000;
	font-size: 18px;
	background-color: #ffffff;
	border:0px;
}
button.btn-success:hover{
	color: #000000;
	font-size: 20px;
	background-color: #ffffff;
}
 button.btn-success:active{
	color: #000000;
	font-size: 20px;
	background-color: #ffffff;
	border:0px;
	border-color: #ffffff #ffffff #ffffff;
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
<div class="col-md-10">
	<p class="qn">{{$question->question}}</p>
		<div class="col-md-10">
	
<p class="like">{{'Likes :: '}}<span class="badge">{{$question->like}}</span>
<?php echo "\t"; ?>	{{'Answers :: '}}<span class="badge">{{$question->like}}</span>
{{ 'Discussions::'}}<span class="badge">{{$question->like}}</span></p>
	</div>
		<div class="col-md-1" >
		{{ Form::open(array('url' => 'like')) }}
		<button type='submit' class='btn btn-success btn-sm' ><span class="glyphicon glyphicon-thumbs-up"></span></button>
		<input type="hidden" name="source_id"  autocomplete="off" value="<?php echo $question->id; ?>">
		<input type="hidden" name="source_type"  autocomplete="off" value="question">
		<input type="hidden" name="handle"  autocomplete="off" value="like">
		<sinput type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
		{{ Form::close() }}
	</div>
	<div class="col-md-1" >
		{{ Form::open(array('url' => 'like')) }}
		<button type='submit' class='btn btn-success btn-sm' ><span class="glyphicon glyphicon-thumbs-down"></span></button>
		<input type="hidden" name="source_id"  autocomplete="off" value="<?php echo $question->id; ?>">
		<input type="hidden" name="source_type"  autocomplete="off" value="question">
		<input type="hidden" name="handle"  autocomplete="off" value="dislike">
		<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
		{{ Form::close() }}
	</div>
	
</div>


<?php 

$like = Like::where('user_id' ,'=' ,Auth::id())
->where('source_type' ,'=' ,'question')  
->where('source_id' ,'=' ,$question->id)
->first() ;





?>


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
<?php $username = User::find($answer->user_id)->name; ?>

<div class="row">
	<div class="col-md-1">
		<br>
		<p class="qn"><span class="badge">{{$answer->like}}</span></p>
	</div>
	<div class ="col-md-2">
		<button type="button" class="btn btn-default btn-sm" aria-label="Left Align">
	<span class="glyphicon glyphicon-user" aria-hidden="true"></span></button>
	<p class="like">{{$username}}</p>
	</div>
	<div class="col-md-9">
	{{$answer->answer}}
<br><br>
<div class="col-md-10">
<p class="like">Discussions::<span class="badge">{{$answer->like}}</span></p>
</div>

<div class="col-md-1">





		{{ Form::open(array('url' => 'like')) }}
		<button type='submit' class='btn btn-success btn-xs' ><span class="glyphicon glyphicon-thumbs-up"></span></button>
		<input type="hidden" name="source_id"  autocomplete="off" value="<?php echo $answer->id; ?>">
		<input type="hidden" name="source_type"  autocomplete="off" value="answer">
		<input type="hidden" name="handle"  autocomplete="off" value="like">
		<sinput type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
		{{ Form::close() }}
		</div>
		<div class="col-md-1">
		{{ Form::open(array('url' => 'like')) }}
		<button type='submit' class='btn btn-success btn-xs' ><span class="glyphicon glyphicon-thumbs-down"></span></button>
		<input type="hidden" name="source_id"  autocomplete="off" value="<?php echo $answer->id; ?>">
		<input type="hidden" name="source_type"  autocomplete="off" value="answer">
		<input type="hidden" name="handle"  autocomplete="off" value="dislike">
		<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
		{{ Form::close() }}
	
</div>
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
		<br><br>
<p align="center">{{ Form::submit('Discuss!' , array(
'class' => 'btn btn-primary btn-sm'
)) }}</p>
</div>
<input type="hidden" name="discussion_answer_id"  autocomplete="off" value="<?php echo $answer->id; ?>">
<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
{{ Form::close() }}
</div>
@endif

@stop