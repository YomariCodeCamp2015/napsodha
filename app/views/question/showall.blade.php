@extends('layout')

@section('head')
<style>
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
}
</style>
@stop

@section('body')
<!-- <div class="container"> -->
<div class="well bs-component">
<p class="title">Recent Question Lists</p>



<ul>
@foreach($questions as $question)

<li><a class="section" href="{{asset('/question/'.$question->id)}}">{{$question->question}}</a>
 
</li>


@endforeach
</ul>
</div>
<!-- </div> -->


@stop