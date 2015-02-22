<<<<<<< HEAD
@extends('layout')

@section('body')

<h1>Section Lists</h1>
<?php 

$sections = Section::orderBy('created_at','desc')->simplePaginate() ;

?>

<div class="container">
<ul>
@foreach($sections as $section)

<li><a href="{{asset('/section/show'.$section->id)}}"><strong>{{$section->name}}</strong></a>
<h4>{{$section->about}}</h4>
</li>


@endforeach
</ul>
</div>

@stop
=======
@extends('layout')
>>>>>>> 86ecf584b1c5efe477ce8c775ed841d532543ae8
