@extends('layout')

@section('head')
<style>
<<<<<<< HEAD
span.divider {
  height: 1px;
  width:100%;
  display:block; /* for use on default inline elements like span */
  margin: 9px 0;
  overflow: hidden;
  background-color: #B8B8FF;
=======
li {
    list-style-type: ;
    margin: 0;
    padding: 0;
}
/*a:hover.qns{
       
        color: black;
        width: 100px;
        height: 58px;
        font-size: 15px;
        background-color: #FFFFFF;
        /*border-style: solid;
        border-color: #ffffff #ffffff #000000;*/
    }
a.section{
       
        width: 100px;
        height: 58px;
        
        color: black;
        background-color: #ffffff;
        text-align: center;
        padding-top: 5px;
        padding-bottom: 20px;
        text-decoration: none;
        font-size: 14px;
        /*font-family: "Courier New", Times, Monospace;*/
        
    }*/
 
p.like{
    font-size: 12px;
>>>>>>> 84cdea3dbbcef0bcaa9685cc1a0e90d1508de79a
}
</style>
@stop

@section('body')
<<<<<<< HEAD
<div class="well bs-component">

<h3>Recent Question Lists</h3>
=======
<!-- <div class="container"> -->
<div class="well bs-component">
<p class="title">Recent Question Lists</p>

>>>>>>> 84cdea3dbbcef0bcaa9685cc1a0e90d1508de79a


<ul>
@foreach($questions as $question)

<<<<<<< HEAD
<span class="divider"></span>

<li><a class="section" href="{{asset('/question/'.$question->id)}}"><strong>{{$question->question}}</strong></a>
 {{$question->created_at->diffForHumans()}}
=======
<li><a class="section" href="{{asset('/question/'.$question->id)}}">{{$question->question}}</a>
 
>>>>>>> 84cdea3dbbcef0bcaa9685cc1a0e90d1508de79a
</li>


@endforeach
</ul>
</div>
<!-- </div> -->


@stop