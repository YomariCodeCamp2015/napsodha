@extends('layout')


Name:: {{section->name}}<br>
About:: {{section->about}}<br>


<br>



<br>

@foreach($questions as $question)

{{$question->question}}<br>
{{$question->created_at->diffForHumans()}}
<br>
<br>

@endforeach