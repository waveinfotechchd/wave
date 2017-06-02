@extends("app")

@section('head_title', 'Edit Profile | '.getcong('site_name') )

@section('head_url', Request::url())

@section("content")



@include("_particles.user_sidebar")
<style>
    .alignselect .select {
    width: 100%;
    border: 1px solid #ddd;
    padding: 7px 6px;
    border-radius: 4px;
}
</style>
    
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
            <!-- User profile -->
            <div class="row">
                <div class="col-lg-9">
                    <div class="tabbable">
                        <div class="tab-content">
                            <div class="tab-pane fade in active" id="settings">
                                <!-- Profile info -->
                                <div class="panel panel-flat">
                                    <div class="panel-heading">
                                        <h6 class="panel-title"><strong>Profile Summary</strong></h6>
                                        <div class="heading-elements">
                                            <ul class="icons-list">
                                                <li><a data-action="collapse"></a></li>
                                                <li><a data-action="reload"></a></li>
                                                <li><a data-action="close"></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                        {!! Form::open(array('url' => 'profile','class'=>'','id'=>'myProfile','role'=>'form','enctype' => 'multipart/form-data')) !!}
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label for="first_name" class="control-label"><strong>First Name</strong> <span class="required">*</span></label>
                                                    <input type="text" required class="form-control input-md" placeholder="First Name" name="first_name" id="first_name" value="{{$user->first_name}}">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="last_name" class="control-label"><strong>Last Name</strong> <span class="required">*</span></label>
                                                    <input type="text" required class="form-control input-md" placeholder="last_name" name="last_name" id="last_name" value="{{$user->last_name}}">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="email" class="control-label"><strong>Email</strong> <span class="required">*</span></label>
                                                    <input type="text" class="form-control input-md" placeholder="Email" name="email" id="email" value="{{$user->email}}" readonly="readonly">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="mobile" class="control-label"><strong>Phone</strong> </label>
                                                    <input type="text" class="form-control input-md" placeholder="+01 123 456 78" name="mobile" id="mobile" value="{{$user->mobile}}">
                                                </div>
                                               <div class="form-group col-md-6 alignselect">
                                                   <label><strong>City</strong></label>

                                               <select name="city" required="required" data-placeholder="Select position" class="select" >
                                                   <option value="">Select City</option>
                                                   @foreach(\App\Cities::orderby('id')->where('status','Active')->get() as $city)
                                                <option <?php if(isset($usersearch[0]['city'])){ if($usersearch[0]['city']==$city->city){ echo 'selected'; } } ?> value="{{$city->city}}">{{$city->city}}</option>
                                                @endforeach
                                                </select>
                                                    </div>
                                                 <div class="form-group col-md-6">
                                          
                                                
                                                    <label><strong>Group</strong></label>
                                                    <input type="text" value="{{$user->groupe}}" name="groupe"  class="form-control" >
                                               
                                            
                                        </div>
                                                <div class="form-group col-md-6 alignselect">
                                                    <label><strong>Experience</strong></label>
                                          <select name="texperience" required="required" data-placeholder="Select position" class="select" >
                                             @foreach(\App\Fieldsets::where('field_type','experience')->get() as $experience)
                                            <option <?php if(isset($usersearch[0]['experience'])){ if($usersearch[0]['experience']==$experience->field_value){ echo 'selected'; } } ?> value="{{$experience->field_value}}">{{$experience->field_value}} years</option>
                                               @endforeach

                                            
                                        </select>
                                                </div>
                                                        <div class="form-group col-md-6 alignselect">
                                                           <label><strong>Role</strong></label>
     <select name="position" required="required" data-placeholder="Select position" class="select">
                                           @foreach(\App\Fieldsets::where('field_type','role')->get() as $experience)
                                            <option <?php if(isset($usersearch[0]['role'])){ if($usersearch[0]['role']==$experience->field_value){ echo 'selected'; } } ?>>{{$experience->field_value}}</option>
                                            @endforeach
                                             
                                        </select>                                                </div>
                                                         <div class="form-group col-md-6 alignselect" >
                                                            <label><strong>Immediate Availability</strong></label>
                                             <select name="immediate_availablility" required="required" data-placeholder="Select Immediate Availability" class="select" >
                                         
                                            <option<?php if(isset($usersearch[0]['immediate_availablility'])){ if($usersearch[0]['immediate_availablility']=='Full Time'){ echo 'selected'; } } ?>>Full Time</option>
                                            <option <?php if(isset($usersearch[0]['immediate_availablility'])){ if($usersearch[0]['immediate_availablility']=='Part Time'){ echo 'selected'; } } ?>>Part Time</option>
                                            <option<?php if(isset($usersearch[0]['immediate_availablility'])){ if($usersearch[0]['immediate_availablility']=='Flexible'){ echo 'selected'; } } ?>>Flexible</option>
                                            <option <?php if(isset($usersearch[0]['immediate_availablility'])){ if($usersearch[0]['immediate_availablility']=='Unsure'){ echo 'selected'; } } ?>>Unsure</option>
                                             <option <?php if(isset($usersearch[0]['immediate_availablility'])){ if($usersearch[0]['immediate_availablility']=='Not available'){ echo 'selected'; } } ?>>Not Available</option>

                                             </select>
                                                </div>
                                               <div class="form-group col-md-6 alignselect" >
                                                   <label><strong>Full Time Availability</strong></label>
                                             <select name="availablility" required="required" data-placeholder="Select Full Time Availability" class="select" >
                                          
                                            <option<?php if(isset($usersearch[0]['availablility'])){ if($usersearch[0]['availablility']=='Immediate'){ echo 'selected'; } } ?>>Immediate</option>
                                            <option <?php if(isset($usersearch[0]['availablility'])){ if($usersearch[0]['availablility']=='2 weeks notice'){ echo 'selected'; } } ?>>2 weeks notice</option>
                                            <option<?php if(isset($usersearch[0]['availablility'])){ if($usersearch[0]['availablility']=='1 month notice'){ echo 'selected'; } } ?>>1 month notice</option>
                                            <option <?php if(isset($usersearch[0]['availablility'])){ if($usersearch[0]['availablility']=='2 months'){ echo 'selected'; } } ?>>2 months</option>
                                            <option<?php if(isset($usersearch[0]['availablility'])){ if($usersearch[0]['availablility']=='3 months'){ echo 'selected'; } } ?>>3 months</option>
                                            <option <?php if(isset($usersearch[0]['availablility'])){ if($usersearch[0]['availablility']=='6 months or more'){ echo 'selected'; } } ?>>6 months or more</option>
                             
                                        </select>
                                                </div>
                                                 <div class="col-md-12" style="margin-top: 2%;">
                                                    <label><strong>Description</strong></label>
                                                 
                                                    <textarea rows="3" class="form-control" placeholder="eg. a technical cofounder for my online entrepreneur matching website." name="descr">{{$user->descr}}</textarea>
                                                </div>
                                                  <div class="form-group col-md-6">
                                                <h3 class="page-title">User Avatar</h3>              
                                                  <div class="col-md-12 user-picture"> 
                                                          <input type="file" name="user_icon" id="input-file">
                                                  </div>
                                                
                                                </div>
                                            </div>
                                        </div>
                                            
                                            
                                    </div>
                                </div>
                                <!-- /profile info -->
                                    
                                    
                                <!-- Account settings -->
                               </div>
                            <!-- /account settings -->
                                
                                
                            <!-- Account settings -->
                            <div class="panel panel-flat" style="
                                 margin-bottom: 0px;
                                 ">
                                <div class="panel-heading">
                                    <h6 class="panel-title"><strong>Background</strong></h6>
                                    <div class="heading-elements">
                                        <ul class="icons-list">
                                            <li><a data-action="collapse"></a></li>
                                            <li><a data-action="reload"></a></li>
                                            <li><a data-action="close"></a></li>
                                        </ul>
                                    </div>
                                </div>
                                    
                                <div class="panel-body">
                                  
                                        <div class="form-group alignselect">
                                            <div class="row">
                                                
                                                     <div class="col-md-12">
                                                         <label><strong>Organisation</strong></label>
                                                     <input type="text" value="<?php if(isset($usersearch[0]['organisation'])){ ?>{{$usersearch[0]['organisation']}}<?php  } ?>" name="organisation"  class="form-control" >                 
                                                     </div>
                                               
                                                     </div>
                                        </div>
                                       
                                        <div class="form-group alignselect">
                                            <div class="row">
                                                 
                                                 <div class="col-md-12">
                                                     <label><strong>Experience</strong></label>
                                                    <textarea  rows="3" class="form-control" placeholder="Experience" name="experience"  class="form-control">{{$user->experience}}</textarea>
                                                </div>
                                               
                                                     <div class="col-md-12" style="margin-top: 2%;">
                                                         <label><strong>Education</strong></label>
                                                    <textarea  rows="3" class="form-control" placeholder="Education" name="education"  class="form-control">{{$user->education}}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <button type="submit" class="btn btn-primary">Save <i class="icon-arrow-right14 position-right"></i></button>
                                        </div>
                                        {!! Form::close() !!} 
                                </div>
                            </div>
                            <!-- /account settings -->
                                
                        </div>
                             
                    </div>
                </div>
            </div>
                
        </div>
        <!-- /user profile -->
            
    </div>
    <!-- /main content -->
        
</div>
<!-- /page content -->

@endsection