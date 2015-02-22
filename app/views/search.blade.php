@extends('layout')

@section('title')
	Search
@stop
@section('head')
<style>
li {
    list-style-type: none;
    margin: 0;
    padding: 0;
}
 a.qns{
            color: black;
            width: 100px;
            height: 80px;
            font-size: 15px;
            background-color: #FFFFFF;
            /*border-style: solid;
            border-color: #ffffff #ffffff #000000;*/
        }
a:hover.qns{
            color: black;
            width: 100px;
            height: 80px;
            font-size: 15px;
            background-color: #FFFFFF;
            text-decoration: none;
            /*border-style: solid;
            border-color: #ffffff #ffffff #000000;*/
        }
 
p.like{
    font-size: 12px;
}
</style>
@stop

@section('body')

<div class="container">
    <div class="well bs-component">
        <div class="row">
            <div class="col-md-6">
            	<form class="navbar-form navbar-left" role="search" method="get" action="">
                        <div class="form-group">
                            <input class="form-control search typeaheadInput" placeholder="Search for Questions" type="text" id="group" name="group_name" autocomplete="off" >
                            <button type="submit"  style="display: none;" class="btn btn-success"><span class="glyphicon glyphicon-search"></span></button>
                        </div>
                    </form>

                <div class="row">
                    <div class="col-md-12">
            @if($title == 'questions')
                <h1>{{$title}}</h1>
                <ul>
                @if($title == 'questions')
                    @if($lists->count()<1)
                                <h5>No Questions Found with "{{{Input::get('group_name')}}}"</h5>
                    @endif
                    @foreach($lists as $list)
                    
                            <li><a href="<?php echo asset('question/'.$list->id.'') ?>">{{{$list->question}}}</a><br>
                            
                            @endforeach 
                      @endif
            @endif

            @if($title == 'query')
                    <h3>Questions</h3>
                            @if($questions->count()<1)
                                <h5>No questions Found with "{{{Input::get('query')}}}"</h5>
                            @else
                            @foreach($questions as $list)
                                <span class="divider"></span>
                                <li><h4><a class="qns" href="<?php echo asset('question/'.$list->id) ?>">{{{$list->question}}}</a></h4></li>
                                <li><p class="like">{{'Likes::'}}<span class="badge">{{$list->like}}</span></p></li>
                                @endforeach
                            <?php 
                                Paginator::setPageName('questions') ;
                             echo  $questions->appends(Request::except('page'))->links()  ;
                             ?>
                             @endif
                        @endif
                        </div>
                </div>
            </div>

            <div class="col-md-4">
                    <form class="navbar-form navbar-left" role="search" method="get" action="">
                        <div class="form-group">
                            <input class="form-control typeaheadInput" placeholder="Search for sections" type="text" id="user" name="user_name" autocomplete="off" >
                            <button type="submit"  style="display: none;" class="btn btn-success"><span class="glyphicon glyphicon-search"></span></button>
                        </div>
                    </form>
                 <div class="row">
                    <div class="col-md-12">
             @if($title == 'sections')
                    <h1>{{$title}}</h1>
                      @if($title == 'sections')

                      @if($lists->count()<1)
                                <h5>No Section Found with "{{{Input::get('user_name')}}}"</h5>
                            @endif
                                @foreach($lists as $list)
                                <li><h4><a href="<?php echo asset('section/show/'.$list->id) ?>">{{{$list->name}}}</a></h4></li>
                                @endforeach 
                      @endif
                       <?php echo  $lists->appends(Request::except('page'))->links() ; ?>
                @endif

                 @if($title == 'query')
                 <h3>Sections</h3>
                            @if($sections->count()<1)
                                <h5>No Section Found with "{{{Input::get('query')}}}"</h5>
                            @else
                            @foreach($sections as $list)
                            <li><h4><a href="<?php echo asset('section/show/'.$list->id.'') ?>">{{{$list->name}}}</a></h4>
                                <h6>{{{$list->about}}}</h6></li>
                            @endforeach
                            <?php  
                                Paginator::setPageName('sections') ;
                            echo  $sections->appends(Request::except('page'))->links() ?>
                            @endif
                @endif
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-md-offset-3">
            	@if(!$title)
                    <h1>{{'Use Some More Character Please!'}}</h1>
                @endif
              
         </div>
</div>
</div>
</div>

@stop

 