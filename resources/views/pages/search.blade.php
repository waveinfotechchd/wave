@extends("app")
@section('head_title', 'Search | '.getcong('site_name') )
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
@if(isset($saved_search))
@foreach($saved_search as $saved)
<?php 
$role=$saved->role;
$keyword=$saved->keyword;
$role=$saved->role;
$organisation=$saved->organisation;
 $experience=$saved->experience;
 $experience=unserialize($experience);
$availablility=$saved->availablility;
$availablility=unserialize($availablility);
$immediate_availablility=$saved->immediate_availablility;
$immediate_availablility=unserialize($immediate_availablility);
?>
@endforeach

@endif
<!-- /page header -->
<!-- Page container -->
<div class="page-container">
    {!! Form::open(array('url' => '','method'=>'post','role'=>'form','id'=>'form-filters')) !!}
    <!-- Page content -->
    <div class="page-content">
        <!-- Secondary sidebar -->
        <div class="sidebar sidebar-secondary sidebar-default">
            <div class="sidebar-content">
                <!-- Search task -->
                <div class="sidebar-category">
                    <div class="category-title">
                        <span style="font-weight:bolder;font-size:13px;">Search</span>
                        <ul class="icons-list">
                            <li><a href="#" data-action="collapse"></a></li>
                            <li><a id="search-empty" data-action=""><i class="fa fa-times-circle-o" aria-hidden="true"></i></a></li>
                        </ul>
                    </div>
                    <div class="category-content">
                        <div class="">
                            <span>Keyword</span>
                            <input type="search" name="keyword" style="margin-bottom:5px;" value="<?php if(isset($keyword)){ echo $keyword; }  ?>" class="form-control search-emp" id="form-keyword" onkeyup="form_keyword()" placeholder="">
                            <div class="form-control-feedback">
                                
                            </div>
                        </div>
                        <div class="">
                            <span>Organisation</span>
                            <input type="search" name="organisation" value="<?php if(isset($organisation)){ echo $organisation; }  ?>" class="form-control search-emp" id="form-organisation" onkeyup="form_organisation()" placeholder="">
                            <div class="form-control-feedback">
                                
                            </div>
                        </div>
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
                    .btn-xlg, .btn-group-xlg > .btn
                    {
                        
                        float: right;
                    }
                    .label-success
                    {
                        font-size: 13px;
                        background: white;
                        border: white;
                        color: green;
                        
                    }
                    .label-default
                    {
                        font-size: 13px;
                        background: white;
                        border: white;
                        color: #2196F3;
                        
                    }
                    .label-info
                    {
                        font-size: 13px;
                        background: white;
                        border: white;
                        color: blueviolet;
                        
                    }
                </style>

                <!-- Action buttons -->
                <div class="sidebar-category">
                    <div class="category-title">
                        
                        <span style="font-weight:bolder;font-size:13px;">Role</span>
                        <ul class="icons-list">
                            <li><a href="#" data-action="collapse"></a></li>
                            <li><a id="role-empty" data-action=""><i class="fa fa-times-circle-o " aria-hidden="true"></i></a></li>
                        </ul>
                    </div>
                    <div class="category-content">
                        
                        <div class="form-group">
                            <div class="row">
                                @foreach(\App\Fieldsets::where('field_type','role')->orderBy('id')->get() as $field)
                                <div class="control-group">
                                    
                                    <div class="radio">
                                        <label class="control control--radio">{{$field->field_value}}
                                            <input type="radio" name="role" class="form-submit role-emp" style="" <?php if(isset($role)){ if($role==$field->field_value){ echo 'checked' ; } }  ?> value="{{$field->field_value}}">
                                                
                                            <div class="control__indicator"></div>
                                        </label>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /action buttons -->
          
                <div class="sidebar-category">
                    <div class="category-title">
                        <span style="font-weight:bolder;font-size:13px;">Experience</span>
                        <ul class="icons-list">
                            <li><a href="#" data-action="collapse"></a></li>
                            <li><a id="experience-empty"  data-action=""><i class="fa fa-times-circle-o" aria-hidden="true"></i></a></li>
                        </ul>
                    </div>
                    
                    <div class="category-content">
                        <div class="form-group">
                            <div class="row">
                                <div class="control-group">
                                    <div class="radio">
                                        <label class="control control--radio">All
                                            <?php $df1= \App\Fieldsets::where('field_type','experience')->orderBy('id')->count();  ?>
                                            <input type="checkbox"  class="form-submit experience-emp" id="experience-all" name="experience_all" <?php if(isset($experience)){ $adf1=count($experience);if($adf1==$df1){ echo 'checked' ; } }  ?> value="All">
                                            <div class="control__indicator"></div>
                                        </label>
                                    </div>
                                </div>
                                 @foreach(\App\Fieldsets::where('field_type','experience')->orderBy('id')->get() as $field)
                                <div class="control-group">
                                    <div class="radio">
                                        <label class="control control--radio">{{$field->field_value}} @if($field->field_value!='10+ years')Years @endif
                                            <input type="checkbox" name="experience[]"class=" form-submit experience-emp" value="{{$field->field_value}}"  <?php if(isset($experience)){ foreach($experience as $exf){ if($exf==$field->field_value){ echo 'checked' ; } }  }  ?>>
                                            <div class="control__indicator"></div>
                                        </label>
                                    </div>
                                </div>
                                   @endforeach
                              
                                
                                
                                
                            </div>
                        </div>
                    </div>
                </div>
  
                <!-- /action buttons -->
                <div class="sidebar-category">
                    <div class="category-title">
                        <span style="font-weight:bolder;font-size:13px;">Immediate Availability</span>
                        <ul class="icons-list">
                            <li><a href="#" data-action="collapse"></a></li>
                            <li><a id="Iavailability-empty" data-action=""><i class="fa fa-times-circle-o " aria-hidden="true"></i></a></li>
                        </ul>
                    </div>
                    
                    <div class="category-content">
                        <div class="form-group">
                            <div class="row">
                                 <div class="control-group">
                                    <div class="radio">
                                        <label class="control control--radio">All
                                            <?php $df2= \App\Fieldsets::where('field_type','iavailability')->orderBy('id')->count();  ?>
                                            <input type="checkbox"  class=" form-submit Iavailability-emp" id="Iavailability-all" name="Iavailability_all" <?php if(isset($immediate_availablility)){ $adf2=count($immediate_availablility);if($adf2==$df2){ echo 'checked' ; } }  ?> value="All">
                                            <div class="control__indicator"></div>
                                        </label>
                                    </div>
                                </div>
                                  @foreach(\App\Fieldsets::where('field_type','iavailability')->orderBy('id')->get() as $field)
                                <div class="control-group">
                                    <div class="radio">
                                        <label class="control control--radio">{{$field->field_value}}
                                            <input type="checkbox" name="Iavailability[]" <?php if(isset($immediate_availablility)){ foreach($immediate_availablility as $imf){ if($imf==$field->field_value){ echo 'checked' ; }  } }  ?> class=" form-submit Iavailability-emp" value="{{$field->field_value}}">
                                            <div class="control__indicator"></div>
                                        </label>
                                    </div>
                                </div>
                                 @endforeach
                           
                                
                            </div>
                        </div>
                    </div>
                </div>  
                
                <div class="sidebar-category">
                    <div class="category-title">
                        <span style="font-weight:bolder;font-size:13px;">Full Time Availability</span>
                        <ul class="icons-list">
                            <li><a href="#" data-action="collapse"></a></li>
                            <li><a id="availability-empty" data-action=""><i class="fa fa-times-circle-o " aria-hidden="true"></i></a></li>
                        </ul>
                    </div>
                    <div class="category-content">
                        
                        <div class="form-group">
                            <div class="row">
                                <div class="control-group">
                                    <div class="radio">
                                        <label class="control control--radio">All 
                                           <?php $df= \App\Fieldsets::where('field_type','availability')->orderBy('id')->count();  ?>
                                            <input type="checkbox" class=" form-submit availability-emp" id="availability-all" name="availability_all"  <?php if(isset($availablility)){ $adf=count($availablility);if($adf==$df){ echo 'checked' ; } }  ?>  value="All">
                                            <div class="control__indicator"></div>
                                        </label>
                                    </div>
                                </div>
                                @foreach(\App\Fieldsets::where('field_type','availability')->orderBy('id')->get() as $field)
                                <div class="control-group">
                                    <div class="radio">
                                        <label class="control control--radio">{{$field->field_value}}
                                            <input type="checkbox" name="availability[]" <?php if(isset($availablility)){ foreach($availablility as $avf){ if($avf==$field->field_value){ echo 'checked' ; } } }  ?> class=" form-submit availability-emp" value="{{$field->field_value}}">
                                            <div class="control__indicator"></div>
                                        </label>
                                    </div>
                                </div>
                                   @endforeach
                                
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /action buttons -->
                {!! Form::close() !!}   
                
                <!-- Assigned users -->
                <div class="sidebar-category">
                    
                    <div class="radio" style="margin-top: 8px;margin-bottom: 8px;">
                        
                    </div>
                    
                    
                </div>
                <!-- /assigned users -->
                
                
            </div>
        </div>
        <!-- /secondary sidebar -->
        
        
        <!-- Main content -->
        <div class="content-wrapper">
            
<!--<script>
function RoleFunction(key){
  //  return false;
    $.get('/search/filters',{role: key}, function (data){
    $("#searchfilters").html(data);
    });
}
function AvailabilityFunction(key){
  //  return false;
    $.get('/search/filters',{availability: key}, function (data){
    $("#searchfilters").html(data);
    });
}
function ExperienceFunction(key){
  //  return false;
    $.get('/search/filters',{experience: key}, function (data){
    $("#searchfilters").html(data);
    });
}
</script> -->
            <!-- Tasks options -->
            <div class="navbar navbar-default navbar-xs navbar-component">
                <ul class="nav navbar-nav no-border visible-xs-block">
                    <li><a class="text-center collapsed" data-toggle="collapse" data-target="#navbar-filter"><i class="icon-menu7"></i></a></li>
                </ul>
                <h1>Search Results</h1>
                
<!--                <div class="navbar-collapse collapse" id="navbar-filter">
                    <p class="navbar-text">Filter:</p>
                    <ul class="nav navbar-nav">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-sort-time-asc position-left"></i> By Role <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                
                                <li><a href="javascript:RoleFunction('Technical - Software')">Technical - Software</a></li>
                                <li><a href="javascript:RoleFunction('Technical - Hardware')">Technical - Hardware</a></li>
                                <li><a href="javascript:RoleFunction('Design')">Design</a></li>
                                <li><a href="javascript:RoleFunction('Product Management')">Product Management</a></li>
                                <li><a href="javascript:RoleFunction('Sales')">Sales</a></li>
                                <li><a href="javascript:RoleFunction('Marketing')">Marketing</a></li>
                                <li><a href="javascript:RoleFunction('Management')">Management</a></li>
                                <li><a href="javascript:RoleFunction('Other')">Other</a></li> 
                            </ul>
                        </li>
                        
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-sort-amount-desc position-left"></i> By Full Time Availability <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                
                                
                                
                                <li><a href="javascript:AvailabilityFunction('Immediate')">Immediate</a></li>
                                <li><a href="javascript:AvailabilityFunction('2 weeks notice')">2 weeks notice</a></li>
                                <li><a href="javascript:AvailabilityFunction('1 month notice')">1 month notice</a></li>
                                <li><a href="javascript:AvailabilityFunction('2 months')">2 months</a></li>
                                <li><a href="javascript:AvailabilityFunction('3 months')">3 months</a></li>
                                <li><a href="javascript:AvailabilityFunction('6 months or more')">6 months or more</a></li>
                                    
                            </ul>
                        </li>
                        
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-sort-numeric-asc position-left"></i> By Experience								<span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                
                                <li><a href="javascript:ExperienceFunction('0-1')">0-1 Years</a></li>
                                <li><a href="javascript:ExperienceFunction('1-3')">1-3 Years</a></li>
                                <li><a href="javascript:ExperienceFunction('3-5')">3-5 Years</a></li>
                                <li><a href="javascript:ExperienceFunction('5-7')">5-7 Years</a></li>
                                <li><a href="javascript:ExperienceFunction('7-10')">7-10 Years</a></li>
                                <li><a href="javascript:ExperienceFunction('10+')">10 + More Years</a></li>
                            </ul>
                        </li>
                    </ul>
                    
                    <div class="navbar-right">
                        
                        
                    </div>
                </div>-->
            </div>
            <!-- /tasks options -->
            
        
            <!-- Tasks grid -->
            <div class="content-group text-muted content-divider">
            </div>
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
            
              <div class="row" id="searchfilters">
                  @if(!isset($role))
                   <div class="col-md-12">
                    
                    <div class="panel panel-body">
                        <h1>Please select your search preferences on the left side</h1>
                    </div>
                </div>
                  @else
                @foreach($user as $us)
                    
                    
                <div class="col-md-6">
                  <?php    
                                  $id = Auth::user()->id; 
                                $data =  DB::table('user_subcriptions')->where('user_id',$id)->get();
                               foreach($data as $datas){
                                 $exp_date =  $datas->expired_date ;
                               } 
                          $current_date=date('Y-m-d H:i:s');
                                    if(empty($exp_date)){
                                        $exp_date = '';
                                   }
                          $authID =  Auth::user()->id;
                        $us->id; 
                                           ?>   
                    <div class="panel panel-body <?php if($authID==$us->id) { ?> you <?php }  ?>">
                        <div class="media">
                            <a href="{{ URL::to('users/'.$us->id.'/'.$us->first_name.' '.$us->last_name) }}" class="media-left">
            <?php if(isset($us->image_icon)){ ?><img  src="{{ URL::asset('upload/members/'.$us->image_icon) }}" class="img-circle img-lg" alt=""><?php }else{ ?> <img class="img-circle img-lg" src="{{ URL::asset('site_assets/images/placeholder.jpg') }}" alt=""><?php } ?>
                            </a>
                            <div class="media-body">
                                <div class="media-heading text-semibold"> <a href="{{ URL::to('users/'.$us->id.'/'.$us->first_name.' '.$us->last_name) }}" class="media-left">{{ucfirst($us->first_name)}} {{ucfirst($us->last_name)}}</a></div>
                                <span class="text-muted">Role : {{$us->position}}</span> <br/>
                                <span class="text-muted">Experience : {{$us->totalexperience}}  Years</span>
                            </div>
                            <div class="media-right">
                                <div class="media-heading text-semibold">
                                    <?php if($authID==$us->id) { ?>  
                    <span class="label label-success" 
                                style>You</span>
                                          <?php }else{ ?>
                    <span class="label label-success" 
                                style>Perfect Match</span>
                                          <?php }  ?>
                                </div>
                            </div>
                            
                            <div class="media-right media-middle">
                                <ul class="icons-list icons-list-vertical">
                                    <li class="dropdown">
                                        
                                    </li>
                                </ul>
                            </div>
                            <div class="contact-details" style="background-color:transparent;border:none;">
                                <ul class="list-extended list-unstyled list-icons">
                                     <li> 
                                        <?php if(Auth::user()->status=='MEMBER' && $current_date<$exp_date && $authID!=$us->id) { ?>
                                    <button type="button" class="btn btn-primary btn-xlg" onclick="inviteFunction({{$us->id}})">
                                        Invite</button> 
                                         <?php } elseif($authID==$us->id){?>
                          
                       
                                         <?php  }else{  ?>
                                         <a href="{{ URL::to('subscription') }}" type="button" class="btn btn-primary btn-xlg">
                                         Invite</a>
                                         <?php } ?>
                                    </li>
                                    
                                    
                                    
                                </ul>
                            </div>
                            
                        </div>
                    </div>
                </div>
                @endforeach      
                
                
                
            </div>
            
            
            <!-- /tasks grid -->
            
            
            <!-- Pagination -->
        
            @endif
            <!-- /tasks grid -->
            
            
            <!-- Pagination -->
            
            <!-- /pagination -->
        </div>
        <!-- /main content -->
    </div>
    <!-- /page content -->
        
</div>
<!-- /page container -->

@endsection