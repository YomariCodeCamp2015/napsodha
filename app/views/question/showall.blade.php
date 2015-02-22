@extends('layout')



@section('body')

<h1>Recent Question Lists</h1>

<div class="container">
<ul>
@foreach($questions as $question)

<li><a href="{{asset('/question/'.$question->id)}}"><strong>{{$question->question}}</strong></a>
 
</li>


@endforeach
</ul>
</div>


@stop