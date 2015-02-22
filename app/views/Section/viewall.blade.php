
@extends('layout')

@section('body')
<div class="well bs-component">
<h3>Section Lists</h3>
<?php 

$sections = Section::orderBy('created_at','desc')->simplePaginate() ;

?>


<ul>
@foreach($sections as $section)

<li><a href="{{asset('/section/show/'.$section->id)}}"><strong>{{$section->name}}</strong></a>
<h4>{{$section->about}}</h4>
</li>


@endforeach
</ul>
</div>

@stop
 
 
 
