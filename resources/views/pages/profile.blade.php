@extends("app")
    
@section('head_title', 'Profile | '.getcong('site_name') )
    
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
                                        <?php if(isset(Auth::user()->image_icon)){ ?><img class="img-responsive md-margin-bottom-10" src="{{ URL::asset('upload/members/'.Auth::user()->image_icon) }}" alt=""><?php }else{ ?> <img class="img-responsive md-margin-bottom-10" src="{{ URL::asset('site_assets/images/placeholder.jpg') }}" alt=""><?php } ?>
                                            
                                    </div>
                                    <div class="col-md-9" style="background:white;border:1px solid #ddd;height:371px;">
                                        <h2>Name : {{Auth::user()->first_name}} {{Auth::user()->last_name}}<a href="{{ URL::to('edit_profile') }}" style="margin-left:10px;"><span class="label label-info" >Edit</span></a></h2>
                                        <span><strong>City: </strong><?php if(isset($usersearch[0]['city'])){ ?>{{$usersearch[0]['city']}}<?php  } ?></span><br/>
                                        <span><strong>Role: </strong>{{$user->position}}</span><br/>
                                        <span><strong>Experience: </strong>{{$user->totalexperience}} Years</span><br/>
                                        <span><strong>Immediate Availability: </strong><?php if(isset($usersearch[0]['immediate_availablility'])){ ?>{{$usersearch[0]['immediate_availablility']}}<?php  } ?></span><br/>
                                        <span><strong>Full time Availability: </strong><?php if(isset($usersearch[0]['availablility'])){ ?>{{$usersearch[0]['availablility']}}<?php  } ?></span><br/>
                                        <hr>
                                        <p>{{$user->descr}}</p>
                                            
                                            
                                      
<!--                                        <p style="text-align:right;width:100%"><a href="#" style="margin-left:0px;"><button type="button" class="btn btn-primary btn-xlg">Invite</button></a></p>-->
                                    </div> 
                                </div>
                            </div><!--/end row-->
                                
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
                                                                {{Auth::user()->education}}
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