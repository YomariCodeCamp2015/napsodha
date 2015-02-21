{{User::find($question->user_id)->name}}{{' :: '}}{{$question->question}}
<br>
{{'Likes :: '}}{{$question->like}}


{{'<br>'}}
{{'<br>'}}
{{'<br>'}}

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
'class' => 'btn btn-primary'
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
'class' => 'btn btn-primary'
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