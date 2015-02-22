@extends('layout')


Name:: {{$section->name}}<br>
About:: {{$section->about}}<br>

<?php 
$usersection = SectionUser::where('user_id','=',Auth::id())
				->where('section_id','=',$section->id)->first() ;
?>
@if(!$usersection)
Add to your section :: <a href="{{asset('user/section/add/'.$section->id)}}">{{$section->name}}</a>
@else
Remove from your section :: <a href="{{asset('user/section/remove/'.$section->id)}}">{{$section->name}}</a>
@endif
<br>



<br>

@foreach($questions as $question)

<a href="{{asset('question/'.$question->id)}}">{{$question->question}}<br></a>
{{$question->created_at->diffForHumans()}}
<br>
<br>

@endforeach