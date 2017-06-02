@extends("app")
    
@section('head_title', 'User Profile | '.getcong('site_name') )
    
@section('head_url', Request::url())
    
@section("content")
  
@include("_particles.user_sidebar")
    
<!-- Page header -->
<div class="page-header">
    <div class="page-header-content">
        <div class="page-title">
            
        </div>
    </div>
</div>
<!-- /page header -->
<!-- Page container -->
<div class="page-container">
    <!-- Page content -->
    <div class="page-content">
        <!-- Main content -->
        <div class="content-wrapper">
            <div class="panel">
                <div class="panel-body">
                    <div class="col-md-12">
                        
                        <div class="profile-body">
                            <div class="profile-bio">
                                <div class="row">
                                    
                                    <div class="col-md-3">
                                        <?php if(isset($user->image_icon)){ ?><img class="img-responsive md-margin-bottom-10" src="{{ URL::asset('upload/members/'.$user->image_icon) }}" alt=""><?php }else{ ?> <img class="img-responsive md-margin-bottom-10" src="{{ URL::asset('site_assets/images/placeholder.jpg') }}" alt=""><?php } ?>
                                            
                                    </div>
                                    <div class="col-md-9" style="background:white;border:1px solid #ddd;height:371px;">
                                        <h2>Name : {{$user->first_name}} {{$user->last_name}} </h2>
                                        <span><strong>City: </strong>{{$usersearch[0]['city']}}</span><br/>
                                        <span><strong>Role: </strong>{{$user->position}}</span><br/>
                                        <span><strong>Experience: </strong>{{$user->totalexperience}}  Years</span><br/>
                                        <span><strong>Immediate Availability: </strong>{{$usersearch[0]['immediate_availablility']}}</span><br/>
                                        <span><strong>Full time Availability: </strong>{{$usersearch[0]['availablility']}}</span><br/>
                                        <hr>
                                        <p>{{$user->descr}}</p>
                                            
                                            
<!--                                        <p style="text-align:left;">
                                            <a href="{{$user->facebook_url}}"><i style="font-size: 19px;" class="fa fa-facebook-official"></i></a>&nbsp;&nbsp;
                                            <a href="{{$user->twitter_url}}"><i style="font-size: 19px;"class="fa fa-twitter-square"></i></a>&nbsp;&nbsp;
                                            <a href="{{$user->linkedin_url}}"><i style="font-size: 19px;"class="fa fa-linkedin-square"></i></a>&nbsp;&nbsp;
                                            <a href="{{$user->dribbble_url}}"><i style="font-size: 19px;"class="fa fa-google-plus-square"></i></a>&nbsp;&nbsp;
                                                
                                            <a href="#"><i style="font-size: 19px;"class="fa fa-envelope-square"></i></a>&nbsp;&nbsp;
                                        </p>-->
                                        <p style="text-align:right;width:100%">
                                            
                                            @if(Auth::user()->status=='MEMBER')
                                             <button type="button" class="btn btn-primary btn-xlg" onclick="inviteFunction({{$user->id}})">Invite</button>
                                         @else
                                         <a href="{{ URL::to('subscription') }}" type="button" class="btn btn-primary btn-xlg">
                                        Invite</a>
                                         @endif
                                        </p>
                                    </div>
                                </div>
                            </div><!--/end row-->
                               <button type="button" class="hidden clickme" data-toggle="modal" data-target="#myModal"></button>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
     
      <div class="modal-body ">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <div class="message">
      </div>
      </div>
     
    </div>

  </div>
</div>             
                            <hr>
                                
                                <?php if(!empty($user->experience)){ ?> 
                            <!-- Timeline -->
                            <div class="timeline timeline-left content-group">
                                <div class="timeline-container" style="padding-top:4px;">
                                    <div class="timeline-row" style="padding-left:0px;">
                                        
                                        
                                        <div class="panel panel-flat timeline-content">
                                            <div class="panel-heading">
                                                <h6 class="panel-title">Experience</h6>
                                                <div class="heading-elements">
                                                    <ul class="icons-list">
                                                        <li class="dropdown">
                                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                                
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                               
                                            <div class="panel-body">
                                                <ul class="media-list chat-list content-group">
                                                    <li class="media date-step">
                                                            <!--<span>Today</span>-->
                                                    </li>
                                                    <li class="media">
                                                        <div class="media-body">
                                                            <div class="media-content">{{$user->experience}}</div>
                                                        </div>
                                                            
                                                    </li>
                                                        
                                                </ul>
                                                    
                                            </div>
                                              
                                        </div>
                                    </div>
                                    <!-- /messages -->
                                </div>
                            </div>
                                
                                  <?php } ?>
                                <?php if(!empty($user->education)){ ?> 
                            <div class="timeline timeline-left content-group">
                                <div class="timeline-container" style="padding-top:4px;">
                                    <div class="timeline-row" style="padding-left:0px;">
                                        
                                        <div class="panel panel-flat timeline-content">
                                            <div class="panel-heading">
                                                <h6 class="panel-title">Education</h6>
                                                <div class="heading-elements">
                                                    <ul class="icons-list">
                                                        <li class="dropdown">
                                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                                                
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                                
                                            <div class="panel-body">
                                                <ul class="media-list chat-list content-group">
                                                    <li class="media date-step">
                                                            <!--<span>Today</span>-->
                                                    </li>
                                                        
                                                    <li class="media ">
                                                        <div class="media-body">
                                                            <div class="media-content">
                                                                {{$user->education}}
                                                            </div></div>
                                                    </li>
                                                        
                                                </ul>
                                                    
                                                    
                                                    
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /messages -->
                                </div>
                            </div>
                                <?php  } ?>
                            <!-- /timeline -->
                                
                        </div>
                    </div>
                </div></div>
            <!-- End Profile Content -->
               
            <!-- /pagination -->
                
        </div>
        <!-- /main content -->
            
        <!-- /page content -->
            
    </div>
    <!-- /page container -->
        
    @endsection