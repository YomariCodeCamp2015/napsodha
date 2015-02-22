@extends('layout')

@section('head')
<style>
span.divider {
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

<h3>Recent Question Lists</h3>


<ul>
@foreach($questions as $question)

<span class="divider"></span>

<li><a class="section" href="{{asset('/question/'.$question->id)}}"><strong>{{$question->question}}</strong></a>
 {{$question->created_at->diffForHumans()}}
</li>


@endforeach
</ul>
</div>


@stop