@extends("app")

@section('head_title', 'Dashboard | '.getcong('site_name') )

@section('head_url', Request::url())

@section("content")
<!-- Theme JS files -->
<script type="text/javascript" src="{{ URL::asset('site_assets/js/plugins/forms/styling/switchery.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('site_assets/js/core/app.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('site_assets/js/pages/tasks_grid.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('site_assets/js/pages/form_checkboxes_radios.js') }}"></script>
<!-- /theme JS files -->
<style>
.contact-details
{

padding-left:65px;
}
.contact-details > ul {
    margin-top:-8%;
}
.icons-list li:first-child{
            margin-left:5px;
            
            }
            .icons-list li{
            padding:5px; 
            
            }
			.icons-list > li > a > i {
    font-size: 20px;
}
.btn-group > .btn:first-child {
    background: gray;
    padding-top: 4px;
    padding-right: 4px;
    padding-bottom: 4px;
    padding-left: 4px;
    margin-left: 0;
    border: gray;
}
.heading-elements {
    /* left: 6px; */
    background-color: inherit;
    position: absolute;
    top: 58%;
    right: 11px;
    height: 36px;
    margin-top: -18px;
}
      
a:focus {
	text-decoration: none;
	color: transparent;
	background-color: transparent;
}
.icons-list li:first-child{
            margin-left:5px;
            
            }
            .icons-list li{
            padding:5px; 
            
            }


.btn-info:active:hover, .btn-info.active:hover, .open > .dropdown-toggle.btn-info:hover, .btn-info:active:focus, .btn-info.active:focus, .open > .dropdown-toggle.btn-info:focus, .btn-info:active.focus, .btn-info.active.focus, .open > .dropdown-toggle.btn-info.focus
{

background-color: gray;
    border-color: gray;

}
.label-success {
    color: #4CAF50;
    background: none;
    border: none;
    font-size: 13px;
}
.bg-pink-300 {
    color: #F06292;
    background: none;
    border: none;
    font-size: 13px;
}
.label-primary
{
color:#2196F3;
background: none;
    border: none;
    font-size: 13px;
}
.bg-purple-3
{

color: #9575CD;
  background: none;
    border: none;
    font-size: 13px;
}
.label-info {
 background: none;
    border: none;
    font-size: 13px;
    color: #00BCD4;
}	
 .label-danger {
    color: #F44336;
	 border: none;
    font-size: 13px;
    background: none;
}     
</style>
 @include("_particles.user_sidebar")
<!-- Page header -->
<div class="page-header">
    <div class="page-header-content">
        <div class="page-title"> </div>
    </div>
</div>
<!-- /page header -->
<!-- Page container -->
<!-- Page container -->
<div class="page-container">
    <!-- Page content -->
    <div class="page-content">
        <!-- Main content -->
        <div class="content-wrapper">
            
            <!-- Tasks options -->
            
            <div class="row">
                 @if($team!=0)
                <div class="col-md-12">
                    <div class="panel panel-white">
                        <div class="panel-heading">
                            
                            <h6 class="panel-title"><b>Team</b></h6>
                            <div class="heading-elements">
                                <div class="btn-group heading-btn">
                                    <button type="button" class="btn btn-info btn-icon dropdown-toggle" data-toggle="dropdown"><i class="icon-menu6"></i> <span class="caret"></span></button>
                                    <ul class="dropdown-menu dropdown-menu-right">
                                        @if(isset($owner))
                                        @if($owner>0)
                                        <li><a href="{{URL::to('teams/delete_team/'.Auth::user()->id)}}" onclick="return confirm('Are you sure? You will not be able to recover this.')">Delete Team</a></li>
                                        @else
                                         <li><a href="{{URL::to('teams/leave_team/'.Auth::user()->id)}}" onclick="return confirm('Are you sure? You will not be able to recover this.')">Leave Team</a></li>
                                        @endif
                                        @endif
                                        
                                      
                                    </ul>
                                </div>
                            </div>
                        
                        </div>
                               
                        <div class="panel-body">
                           
                            <div class="col-md-6">
                                <p><h5>Team : {{$team_name[0]}} </h5><h5>Founder : {{$founder[0]}}</h5></p>
                                <p><button type="button" class="btn btn-primary btn-xlg"><i class="icon-comment-discussion position-left"></i>Finalise Team</button></p>
                                    
                            </div>
<!--                            <div class="col-md-6" style="text-align: -webkit-right;">
                                <h5>Invite</h5>
                                <p>
                                    <a href="#"><i style="font-size: 19px;" class="fa fa-facebook-official"></i></a>&nbsp;&nbsp;
                                    <a href="#"><i style="font-size: 19px;"class="fa fa-twitter-square"></i></a>&nbsp;&nbsp;
                                    <a href="#"><i style="font-size: 19px;"class="fa fa-linkedin-square"></i></a>&nbsp;&nbsp;
                                    <a href="#"><i style="font-size: 19px;"class="fa fa-google-plus-square"></i></a>&nbsp;&nbsp;
                                        
                                    <a href="#"><i style="font-size: 19px;"class="fa fa-envelope-square"></i></a>&nbsp;&nbsp;
                                </p></div>-->
                           
                        </div>
                    </div>
                </div>
                 @else
                 <div class="col-md-12">
                    <div class="panel panel-white"> 
                        <div class="panel-heading">
                        <h6 class="panel-title"><b>Your team will show up here when you either</b></h6>
                        </div>
                        <div class="panel-body">
                            <h5>1.Make an Offer to someone to join you or</h5>
                            <h5>2.You accept an offer to join someone else's team</h5>
                            <h5>3.Please put your First Name, Last Name and City else you will not show up in search result.</h5>
                        </div>
                    </div>
                </div>    
                 @endif
            </div>
            <!-- /tasks options -->
            <!-- Tasks grid -->
            <div class="row">
                @if($team!=0)
                @foreach($team as $tm)
                @foreach(\App\User::where('id',$tm->to_user_id)->orderBy('id')->get() as $field)
                              
                <div class="col-md-6">
                    <div class="panel panel-white">
                        <div class="panel-heading" style="
                             padding-top: 21px;
                             padding-bottom: 21px;
                             ">
                            <h6 class="panel-title"><b></b></h6>
                            <div class="heading-elements">
                                <div class="btn-group heading-btn">
                                    <button type="button" class="btn btn-info btn-icon dropdown-toggle" data-toggle="dropdown"><i class="icon-menu6"></i> <span class="caret"></span></button>
                                    <ul class="dropdown-menu dropdown-menu-right">
                                   
                                @if(isset($owner))
                                        @if($owner>0)
     <li>
                         <a href="{{URL::to('teams/delete_team_member/'.$tm->to_user_id.'/'.$tm->user_id)}}" class="btn btn-danger btn-xs" onclick="return confirm('Are you sure? You will not be able to recover this.')">
                         Remove from team</a></li>                                        @else
                                         <li><a href="{{URL::to('teams/leave_team/'.Auth::user()->id)}}" onclick="return confirm('Are you sure? You will not be able to recover this.')">Leave Team</a></li>
                                        @endif
                                        @endif             
                                    </ul>
                                </div>
                            </div>
                        </div><!--panel title-->
                        <div class="panel panel-body" style="margin-bottom:0px;">
                            <div class="media"> <a href="#" class="media-left"> 
                                              <?php if(isset($field->image_icon)){ ?>
                                    <img  src="{{ URL::asset('upload/members/'.$field->image_icon) }}" class="img-circle img-lg" alt=""><?php }else{ ?> <img  src="{{ URL::asset('site_assets/images/placeholder.jpg') }}" class="img-circle img-lg" alt=""><?php } ?>

                                </a>
                                <div class="media-body">
                                    
                                    <h6 class="media-heading">{{$field->first_name}} {{$field->last_name}}</h6>
                                    <span class="text-muted">{{$field->company}}</span>
                                   @if($tm->nda=='yes')
                                    <span class="text-muted">Doc :&nbsp;&nbsp; <a  href="{{ URL::asset('upload/NDA.docx') }}" ><span class="label bg-green-300">NDA Signed</span></a></span>
                                   @else
                              <span class="text-muted">Doc :&nbsp;&nbsp;<span class="label bg-pink-300">NDA Unsigned</span></span>

                                   @endif
                                </div>
                                    
                      
                                <div class="contact-details" style="background-color:transparent;border:none;padding-top:0px; display:none">
                                    <ul class="list-icons">
                                        <li>Doc :&nbsp;&nbsp; <a  href="{{ URL::asset('upload/NDA.docx') }}" ><span class="label bg-green-300">NDA Signed</span></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                        
                </div>
                @endforeach
                     @endforeach
                      @if(isset($owner))
                                        @if($owner==0)
                       @foreach($other_team_members as $tm)
                @foreach(\App\User::where('id',$tm->to_user_id)->orderBy('id')->get() as $field)
                              
                <div class="col-md-6">
                    <div class="panel panel-white">
                        <div class="panel-heading" style="
                             padding-top: 21px;
                             padding-bottom: 21px;
                             ">
                            <h6 class="panel-title"><b></b></h6>
                            <div class="heading-elements">
                                <div class="btn-group heading-btn">
                     
                           
                                </div>
                            </div>
                        </div><!--panel title-->
                        <div class="panel panel-body" style="margin-bottom:0px;">
                            <div class="media"> <a href="#" class="media-left"> 
                                   <img  src="{{ URL::asset('site_assets/images/placeholder.jpg') }}" class="img-circle img-lg" alt="">
                                </a>
                                <div class="media-body">
                                    
                                    <h6 class="media-heading">Role:- {{$field->position}}</h6>
                                    <span class="text-muted"></span> </div>
                                
                                
                                <div class="media-right media-middle">
                                    
                                    <ul class="icons-list">
<!--                                        <li ><a href="" ><i class="icon-comment-discussion pull-right"></i> </a></li>-->
<!--                                        <li ><a href="#" ><i class="icon-phone2 pull-right"></i> </a></li>
                                        <li ><a href="#" ><i class="icon-mail5 pull-right"></i> </a></li>-->
                                    </ul>
                                </div>
                             
                            </div>
                        </div>
                    </div>
                        
                </div>
                @endforeach
                     @endforeach
                     @endif
                                        @endif      
                     
                @endif       
            </div>
            <div class="row"> </div>
            <!-- /tasks grid -->
            <!-- Pagination -->
                
            <!-- /pagination -->
        </div>
        <!-- /main content -->
            
        <!-- Secondary sidebar -->
        <div class="sidebar sidebar-secondary sidebar-default" style="
             padding-right: 0px;
             left: 15px;
             ">
            <div class="sidebar-content">
                <!-- Search task -->
                <div class="sidebar-category">
                    <div class="category-title"> <span style="font-weight:bolder;font-size:13px;">Notifications</span>
                        <ul class="icons-list">
                            <li><a href="#" data-action="collapse"></a></li>
                        </ul>
                    </div>
                    <div class="category-content clearfix">
                        <div class="col-lg-12">
                            <ul class="media-list content-group">
                                  @if(isset($user_conversations))
                                @foreach($user_conversations as $invite)
                                 @foreach(\App\User::where('id',$invite->user_id)->orderBy('id')->get() as $field)
                                <li class="media stack-media-on-mobile">
                                    <div class="media-body">
                                        <h6 class="media-heading"><a href="{{ URL::to('conversation') }}">{{$invite->created_at}}:</a></h6>
                                        <ul class="list-inline list-inline-separate text-muted mb-5">
                                            <li></li>
                                        </ul>
                                        You have recived message from {{$field->first_name}} </div>
                                </li>
                                @endforeach
                                @endforeach
                                @endif
                                @if(isset($invites))
                                @foreach($invites as $invite)
                                 @foreach(\App\User::where('id',$invite->user_id)->orderBy('id')->get() as $field)
                                <li class="media stack-media-on-mobile">
                                    <div class="media-body">
                                        <h6 class="media-heading"><a href="{{ URL::to('invites') }}">{{$invite->created_at}}:</a></h6>
                                        <ul class="list-inline list-inline-separate text-muted mb-5">
                                            <li></li>
                                        </ul>
                                        You {{$invite->status}} {{$field->first_name}}'s invite </div>
                                </li>
                                @endforeach
                                @endforeach
                                @endif
                                @if(isset($shortlists))
                                  @foreach($shortlists as $invite)
                                 @foreach(\App\User::where('id',$invite->user_id)->orderBy('id')->get() as $field)
                                <li class="media stack-media-on-mobile">
                                    <div class="media-body">
                                        <h6 class="media-heading"><a href="{{ URL::to('invites') }}">{{$invite->created_at}}:</a></h6>
                                        <ul class="list-inline list-inline-separate text-muted mb-5">
                                            <li></li>
                                        </ul>
                                        You added {{$field->first_name}}'s to shortlists</div>
                                </li>
                                   @endforeach
                                @endforeach
                                @endif
                            </ul>
                        </div>
                     
                    </div>
                    <!-- /searxch task -->
                    <style>
                        
                        .control-group {
                            display: inline-block;
                            width: 200px;
                            height: 10;
                            margin: 0px;
                            padding: 10px;
                            text-align: left;
                            /* vertical-align: top; */
                            background: #fff;
                            /* box-shadow: 0 1px 2px rgba(0,0,0,.1); */
                        }
                        .control {
                            font-size: 15px;
                            position: relative;
                            display: block;
                            margin-bottom: 15px;
                            padding-left: 30px;
                            cursor: pointer;
                        }
                        
                        .control input {
                            position: absolute;
                            z-index: -1;
                            opacity: 0;
                        }
                        
                        .control__indicator {
                            position: absolute;
                            top: 2px;
                            left: 0;
                            width: 20px;
                            height: 20px;
                            background: #e6e6e6;
                        }
                        
                        .control--radio .control__indicator {
                            border-radius: 50%;
                        }
                        /* Hover and focus states */
                        .control:hover input ~ .control__indicator,
                        .control input:focus ~ .control__indicator {
                            background: #ccc;
                        }
                        
                        /* Checked state */
                        .control input:checked ~ .control__indicator {
                            background: #2aa1c0;
                        }
                        
                        /* Hover state whilst checked */
                        .control:hover input:not([disabled]):checked ~ .control__indicator,
                        .control input:checked:focus ~ .control__indicator {
                            background: #0e647d;
                        }
                        
                        /* Disabled state */
                        .control input:disabled ~ .control__indicator {
                            pointer-events: none;
                            opacity: .6;
                            background: #e6e6e6;
                        }
                        
                        /* Check mark */
                        .control__indicator:after {
                            position: absolute;
                            display: none;
                            content: '';
                        }
                        
                        /* Show check mark */
                        .control input:checked ~ .control__indicator:after {
                            display: block;
                        }
                        
                        /* Checkbox tick */
                        .control--checkbox .control__indicator:after {
                            top: 4px;
                            left: 8px;
                            width: 3px;
                            height: 8px;
                            transform: rotate(45deg);
                            border: solid #fff;
                            border-width: 0 2px 2px 0;
                        }
                        
                        /* Disabled tick colour */
                        .control--checkbox input:disabled ~ .control__indicator:after {
                            border-color: #7b7b7b;
                        }
                        
                        /* Radio button inner circle */
                        .control--radio .control__indicator:after {
                            top: 7px;
                            left: 7px;
                            width: 6px;
                            height: 6px;
                            border-radius: 50%;
                            background: #fff;
                        }
                        
                        /* Disabled circle colour */
                        .control--radio input:disabled ~ .control__indicator:after {
                            background: #7b7b7b;
                        }
                    </style>
                    <!-- Action buttons -->
                    
                </div>
            </div>
            <!-- /secondary sidebar -->
            <!-- /page content -->
            <!-- Footer -->
            <!-- /footer -->
        </div>
        <!-- /page container -->
            
        @endsection