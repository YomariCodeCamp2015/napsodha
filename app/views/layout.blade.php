
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>ComHun @yield('title')</title>
    @yield('head')
    <link rel="shortcut icon" href="{{asset('assests/icon/icon.ico')}}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{ HTML::style( asset('assests/css/bootstrap.min.css') ) }}
    {{ HTML::style( asset('assests/css/autosuggest.css') ) }}

    <!--{{HTML::style('http://localhost:8080/assests/css/bootstrap.min.css')}}

    --><style>
        body{
            padding-top: 70px;
            background-color: #E5E5E5;
        }

        .navbar-xs { min-height:28px; height: 45px; }

        .label-as-badge {
    border-radius: 1em;
      }

        .input-mysize {   
   height: 33px;
   width: 200px; }

nav {
    word-spacing: 2px;
    background-color: #ffffff;
}
.navbar-default {
  color: black;
    background-color: #ffffff;
    border-color: #E7E7E7;
}
.navbar-default .navbar-brand {
  color: black;
}
.navbar-default .navbar-nav > li > a {
   color: black; /*Change active text color here*/
    }
    .navbar-default .navbar-nav > li > a:hover {
   color: black; /*Change active text color here*/
    }
}
.navbar-brand .navbar-nav > a{
  color: black;
}
.save_button {
    min-width: 80px;
    max-width: 600px;
}
 a:hover.highlight{
            display: block;
            color: black;
            width: 100px;
            height: 58px;
            font-size: 15px;
            background-color: #FFFFFF;
            /*border-style: solid;
            border-color: #ffffff #ffffff #000000;*/
        }
a.menu{
            display: block;
            width: 100px;
            height: 58px;
            
            color: black;
            background-color: #ffffff;
            text-align: center;
            padding-top: 20px;
            text-decoration: none;
            font-size: 13px;
            /*font-family: "Courier New", Times, Monospace;*/
            
        }
<<<<<<< HEAD
a:hover.section{
            
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
            padding-bottom: 5px;
            text-decoration: none;
            font-size: 14px;
            /*font-family: "Courier New", Times, Monospace;*/
            
        }
=======
    a:hover.section{
       
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
        
    }
>>>>>>> 84cdea3dbbcef0bcaa9685cc1a0e90d1508de79a

#title{
            width: 150px;
            font-size: 20px;
            
            font-weight: 900;
            font-family: "Arial", Times, Monospace;
        }
p.title{
    color: black;
    font-size: 15px;
    font-weight: bolder;
 }
 div.bs-component{
    background-color:#FFFFFF;

 }

    </style>

   
        
</head>
 
 
    
      
        <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
            <div class="container-fluid">

                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- <a class="navbar-brand" href="/"><img alt="Isoconnect" class="img-circle" src="{{asset('assests/icon/iso_logo.png')}}" width="30" height="30"></a> -->
                    <a class="navbar-brand" id="title" href="/home">NEPSODHA</a>

                    <!-- <a class="navbar-brand" href="/"><img alt="Isoconnect" class="img-circle" src="{{asset('assests/icon/iso_logo.png')}}" width="30" height="30"></a> -->
                    <!-- <a class="navbar-brand" href="/">Nepsodha</a> -->

                </div>

                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

                     <ul class="nav navbar-nav navbar-left">
                                                                                                                                                       
                              <li><a href="/question/show" class="menu highlight" >Questions</a></li>
                              <li><a href="/section/show" class="menu highlight " >Sections</a></li>
                              <li><a href="/about" class="menu highlight " >About</a></li>
                              <!-- <li><a href="/user/notification/show" class="menu highlight" >Users</a></li> -->
                    </ul>                     
                                        
                    <ul class="nav navbar-nav navbar">
                     <li><div class="btn-group ">
                               <form class="navbar-form navbar-left" role="search" method="get" action="<?php echo asset('search') ; ?>">
                                <div class="form-group">
                                  <input class="form-control search typeaheadInput" placeholder="Search" type="text" id="users" name="query" autocomplete="off" >
                                   <button type="submit" style="display: none;" class="btn btn-success"><span class="glyphicon glyphicon-search"></span></button>
                                </div>
                              </form></div></li>
                    </ul>
                     @if (Auth::check())

                    <ul class="nav navbar-nav navbar-right">
                                                                                                                                                       
                              
                              <li><a href="/notification/show">Notifications<span id="nav-noti" >({{Auth::user()->NotificationUnseen()}})</span></a></li> 
                                <li><a class="dropdown-toggle btn-md " type="button" id="menu1" data-toggle="dropdown">{{ Auth::user()->name }}<span class="caret"></span></a>
                                  <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="/user/profile">View Profile</a></li>
                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="/user/profile/edit">Edit Profile</a></li>
                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="/user/password">Account Setting</a></li>
                                    <li role="presentation" class="divider"></li>
                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="/logout">Log Out</a></li>
                                    <li role="presentation" class="divider"></li>
                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="/about">About Us</a></li>
                                    <li role="presentation"><a role="menuitem" tabindex="-1" href="/help">Help</a></li>
                                 </ul></li>
                    </ul>
                        @else
                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="/login">Login</a></li>
                            <li><a href="/register">Sign Up</a></li>
                           </ul> 
                        @endif
                    
                    

                </div><!-- /.navbar-collapse -->
            </div>
        </nav>

  

         
     

    <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">

            
             <div class="well bs-component">
                @if (Auth::check())
                <p class="title">Sections</p>

                <?php 
                    $sections = SectionsController::showUser(Auth::id()) ;
                ?>
                @if($sections)
                <ul>
                    @foreach($sections as $section)
                <p><li><a class="section" href='/section/show/{{$section->id}}'>
                {{{$section->name}}}
                </a></li></p>
                    @endforeach
                </ul>
                @else
                    <ul><p>You are not connected to any section Use search to search</p></ul>
                @endif

        <a href="{{asset('section/create')}}" > Create New Section </a>
        @endif
    </div>
    
    @yield('bodyleft')
          </div>
            <div class="col-md-6">
                 @if(Session::has('flash_notice'))
                    <div class="form-group  alert alert-success">
                                <tr class="danger"><ul>
                                    <h4><td>{{ Session::get('flash_notice') }}</td></h4>
                                     
                                </ul></tr>
                        </div>
                    @elseif(Session::has('flash_error'))
                    <div class="form-group  alert alert-danger">
                                <tr class="danger"><ul>
                                    <h4><td>{{ Session::get('flash_error') }}</td></h4>
                                     
                                </ul></tr>
                        </div>
                    @endif
                    @yield('body')
            </div>
            
        </div>
    </div>

    <div class="container-fluid">
        
       
    
    
    </div>


        <!-- Footer -->
       
        <footer>
         <div class="container"><hr>
            <div class="row">
                <div class="col-lg-12">
                    <p><!-- Copyright &copy;  -->CompHunter 2015-<?php echo date("Y") ; ?><span class="text-muted pull-right" ><a href="<?php echo asset('about') ;?>">About Us</a></span></p>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            </div>
        </footer>
        
  
<!--         
<footer class="footer">
      <div class="container">
       <h4><div class="btn">I-so-Connect 2015-<?php echo date("Y") ; ?></div><span class="text-muted pull-right" ><a class='btn' href="<?php echo asset('about') ;?>">About Us</a></span></h4>
      </div>
</footer>
 -->


@show
</body>
</html>



       {{HTML::script(asset('assests/js/jquery.min.js'))}}
       {{HTML::script(asset('assests/js/typeahead.js'))}}
       {{HTML::script(asset('assests/js/bootstrap.min.js'))}}
       {{HTML::script(asset('assests/js/autoscroll.js'))}}
        {{HTML::script(asset('assests/js/handlebars-v3.0.0.js'))}}
       @include('javascript')   
  @yield('javascript')
 
 
 
<?php

//glyphicon glyphicon-thumbs-down
//glyphicon glyphicon-thumbs-up 

?>


