@extends('layout')

@section('body')


<div class="well bs-component">
<div class="container"> 
<h2>Name : {{$section->name}}</h2><br>
About:: {{$section->about}}<br>

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
</div>
@stop