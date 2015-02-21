@extends('layout')
@section('head')
<style>
p.qn{
	font-size: 16px;
}
p.like{
	font-size: 12px;
}
</style>
@stop

@section('body')


<div class="row">
	<div class="col-md-2">
<p class="title">{{User::find($question->user_id)->name}}</p>
</div>
<p class="qn">{{$question->question}}</p>
<p class="like">{{'Likes :: '}}{{$question->like}}</p>
</div>

<?php 

$like = Like::where('user_id' ,'=' ,Auth::id())
->where('source_type' ,'=' ,'question')  
->where('source_id' ,'=' ,$question->id)
->first() ;



?>

		{{ Form::open(array('url' => 'like')) }}
		<button type='submit' class='btn btn-success' ><span class="glyphicon glyphicon-thumbs-up"></span></button>
		<input type="hidden" name="source_id"  autocomplete="off" value="<?php echo $question->id; ?>">
		<input type="hidden" name="source_type"  autocomplete="off" value="question">
		<input type="hidden" name="handle"  autocomplete="off" value="like">
		<sinput type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
		{{ Form::close() }}
		
		<button type='submit' class='btn btn-primary' ><span class="glyphicon glyphicon-thumbs-down"></span></button>
		 
		<input type="hidden" name="source_id"  autocomplete="off" value="<?php echo $question->id; ?>">
		<input type="hidden" name="source_type"  autocomplete="off" value="question">
		<input type="hidden" name="handle"  autocomplete="off" value="dislike">
		<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
		{{ Form::close() }}


{{'Dicuss::<br>'}}
<?php 

$discussions = Discussion::where('source_type' ,'=' ,'question')->where('source_id','=',$question->id)->orderBy('created_at')->get() ;


foreach ($discussions as $discussion) {
	echo User::find($discussion->user_id)->name.' :: '.$discussion->discussion.'<br>' ;
}
?>

@if(Auth::check())




 {{ Form::open(array('url' => 'discussion/question/create')) }}

{{ Form::label('discussion' , 'Discuss!') }}
{{ Form::textarea('discussion' ,'' ,  array(
'placeholder'   => 'Discuss here!' , 
'class'         => 'form-control'   ,
'rows'          => '2' ,
)) }}
</p>
<p>{{ Form::submit('Discuss!' , array(
'class' => 'btn btn-primary btn-sm'
)) }}</p>
<input type="hidden" name="discussion_question_id"  autocomplete="off" value="<?php echo $question->id; ?>">
<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
{{ Form::close() }}







<hr>
 {{ Form::open(array('url' => 'answer/create')) }}

{{ Form::label('answer' , 'Answer!') }}
{{ Form::textarea('answer' ,'' ,  array(
'placeholder'   => 'Have A Answer!' , 
'class'         => 'form-control'   ,
'rows'          => '2' ,
)) }}
</p>
<p>{{ Form::submit('Answer!' , array(
'class' => 'btn btn-primary btn-sm'
)) }}</p>
<input type="hidden" name="question_id"  autocomplete="off" value="<?php echo $question->id; ?>">
<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
{{ Form::close() }}


@endif







@foreach($answers as $answer)

{{'<br>'}}
Answer::{{$answer->answer}}
{{'<br>'}}
Like::{{$answer->like}}
{{'<br>'}}

		{{ Form::open(array('url' => 'like')) }}
		<p>{{ Form::submit('Good!' , array(
		'class' => 'btn btn-primary'
		)) }}</p>
		<input type="hidden" name="source_id"  autocomplete="off" value="<?php echo $answer->id; ?>">
		<input type="hidden" name="source_type"  autocomplete="off" value="answer">
		<input type="hidden" name="handle"  autocomplete="off" value="like">
		<sinput type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
		{{ Form::close() }}
		
		{{ Form::open(array('url' => 'like')) }}
		<p>{{ Form::submit('Bad!' , array(
		'class' => 'btn btn-primary'
		)) }}</p>
		<input type="hidden" name="source_id"  autocomplete="off" value="<?php echo $answer->id; ?>">
		<input type="hidden" name="source_type"  autocomplete="off" value="answer">
		<input type="hidden" name="handle"  autocomplete="off" value="dislike">
		<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
		{{ Form::close() }}

{{'Dicuss::<br>'}}
<?php 

$discussions = Discussion::where('source_type' ,'=' ,'answer')->where('source_id','=',$answer->id)->orderBy('created_at')->get() ;


foreach ($discussions as $discussion) {
	echo User::find($discussion->user_id)->name.' :: '.$discussion->discussion.'<br>' ;
}
?>


@if(Auth::check())
{{ Form::open(array('url' => 'discussion/answer/create')) }}

{{ Form::label('discussion' , 'Discuss!') }}
{{ Form::textarea('discussion' ,'' ,  array(
'placeholder'   => 'Discuss here!' , 
'class'         => 'form-control'   ,
'rows'          => '2' ,
)) }}
</p>
<p>{{ Form::submit('Discuss!' , array(
'class' => 'btn btn-primary'
)) }}</p>
<input type="hidden" name="discussion_answer_id"  autocomplete="off" value="<?php echo $answer->id; ?>">
<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
{{ Form::close() }}
@endif
@endforeach

@stop