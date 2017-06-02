@extends("admin.admin_app")
@section("content")

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
				 <!-- Page Content -->
    <div class="row">
        <div class="col-md-4" style="text-align:center;">
            <div class="panel panel-white">
                <div class="panel-heading">
                    <h6 class="panel-title"><b>User</b></h6>
                    <div class="heading-elements">

                    </div>
                </div>

                <div class="panel-body">
                    <div class="col-md-12">

                        <h5 class="user">Joined on : {{ isset($user->created_at) ? $user->created_at : null }}</h5>
                        <h5 class="user">Membership :<span class="label label-success">Active</span></h5><h5 class="user">Expiration: </h5>

                    </div>

                </div>
            </div>
        </div>
                <div class="col-md-8">
                    <div class="panel panel-flat">
                        <div class="panel-heading">
                            
                            <div class="heading-elements">
                                <ul class="icons-list">
                                    <li><a data-action="collapse"></a></li>
                                    <li><a data-action="reload"></a></li>
                                 
                                </ul>
                            </div>
                        </div>

                <!-- Page Content -->
                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-12 col-lg-12">
                            <div class="block">
                               <div class="block-content block-content-narrow"> 
                                @if (count($errors) > 0)
                                <div class="alert alert-danger">
                                     <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endif
                                 @if(Session::has('flash_message'))
                                                <div class="alert alert-success">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                                                    {{ Session::get('flash_message') }}
                                                </div>
                                @endif
                                {!! Form::open(array('url' => array('admin/users/adduser'),'class'=>'form-horizontal padding-15','name'=>'user_form','id'=>'user_form','role'=>'form','enctype' => 'multipart/form-data')) !!} 
                <input type="hidden" name="id" value="{{ isset($user->id) ? $user->id : null }}">
                  
                
            <div class="panel-body">
                                        {!! Form::open(array('url' => 'profile','class'=>'','id'=>'myProfile','role'=>'form','enctype' => 'multipart/form-data')) !!}
                                        <div class="form-group">
                                            
                                                <div class="form-group col-md-6">
                                                    <label for="first_name" class="control-label"><strong>First Name</strong> <span class="required">*</span></label>
                                                    <input type="text" required class="form-control input-md" placeholder="First Name" name="first_name" id="first_name" value="{{ isset($user->first_name) ? $user->first_name : null }}">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="last_name" class="control-label"><strong>Last Name</strong> <span class="required">*</span></label>
                                                    <input type="text" required class="form-control input-md" placeholder="last_name" name="last_name" id="last_name" value="{{ isset($user->last_name) ? $user->last_name : null }}">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="email" class="control-label"><strong>Email</strong> <span class="required">*</span></label>
                                                    <input type="text" class="form-control input-md" placeholder="Email" name="email" id="email" value="{{ isset($user->email) ? $user->email : null }}" >
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="mobile" class="control-label"><strong>Phone</strong> </label>
                                                    <input type="text" class="form-control input-md" placeholder="+01 123 456 78" name="mobile" id="mobile" value="{{ isset($user->mobile) ? $user->mobile : null }}">
                                                </div>
                                               <div class="form-group col-md-6">
                                                   <label><strong>City</strong></label>
                                                    <input type="text" value="<?php if(isset($usersearch[0]['city'])){ ?>{{$usersearch[0]['city']}}<?php  } ?>" name="city"  class="form-control input-md" >
                                                </div>
                                                 <div class="form-group col-md-6">
                                          
                                                
                                                    <label><strong>Group</strong></label>
                                                    <input type="text" value="{{ isset($user->groupe) ? $user->groupe : null }}" name="groupe"  class="form-control" >
                                               
                                            
                                        </div>
                                                <div class="form-group col-md-6 alignselect">
                                                    <label><strong>Experience</strong></label>
                                          <select name="texperience" required="required" data-placeholder="Select position" class="select" >
                                        
                                            <option <?php if(isset($usersearch[0]['experience'])){ if($usersearch[0]['experience']=='0-1'){ echo 'selected'; } } ?> value="0-1">0-1 years</option>
                                            <option <?php if(isset($usersearch[0]['experience'])){ if($usersearch[0]['experience']=='1-3'){ echo 'selected'; } } ?> value="1-3">1-3 years</option>
                                            <option <?php if(isset($usersearch[0]['experience'])){ if($usersearch[0]['experience']=='3-5'){ echo 'selected'; } } ?> value="3-5">3-5 years</option>
                                            <option <?php if(isset($usersearch[0]['experience'])){ if($usersearch[0]['experience']=='5-7'){ echo 'selected'; } } ?> value="5-7">5-7 years</option>
                                            <option <?php if(isset($usersearch[0]['experience'])){ if($usersearch[0]['experience']=='7-10'){ echo 'selected'; } } ?> value="5-7">7-10 years</option>

                                            <option <?php if(isset($usersearch[0]['experience'])){ if($usersearch[0]['experience']=='10+ years'){ echo 'selected'; } } ?> >10+ years</option>

                                            
                                        </select>
                                                </div>
                                                        <div class="form-group col-md-6 alignselect">
                                                           <label><strong>Role</strong></label>
     <select name="position" required="required" data-placeholder="Select position" class="select">
                                         
                                            <option <?php if(isset($usersearch[0]['role'])){ if($usersearch[0]['role']=='Technical - Software'){ echo 'selected'; } } ?>>Technical - Software</option>
                                            <option <?php if(isset($usersearch[0]['role'])){ if($usersearch[0]['role']=='Technical - Hardware'){ echo 'selected'; } } ?>>Technical - Hardware</option>
                                            <option <?php if(isset($usersearch[0]['role'])){ if($usersearch[0]['role']=='Design'){ echo 'selected'; } } ?>>Design</option>
                                            <option <?php if(isset($usersearch[0]['role'])){ if($usersearch[0]['role']=='Product Management'){ echo 'selected'; } } ?>>Product Management</option>
                                            <option <?php if(isset($usersearch[0]['role'])){ if($usersearch[0]['role']=='Sales'){ echo 'selected'; } } ?>>Sales</option>
                                            <option <?php if(isset($usersearch[0]['role'])){ if($usersearch[0]['role']=='Marketing'){ echo 'selected'; } } ?>>Marketing</option>
                                            <option <?php if(isset($usersearch[0]['role'])){ if($usersearch[0]['role']=='Management'){ echo 'selected'; } } ?>>Management</option>
                                            <option <?php if(isset($usersearch[0]['role'])){ if($usersearch[0]['role']=='Other'){ echo 'selected'; } } ?>>Other</option>
                                            
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
                                                 
                                                    <textarea rows="3" class="form-control" placeholder="eg. a technical cofounder for my online entrepreneur matching website." name="descr">{{ isset($user->descr) ? $user->descr : null }}</textarea>
                                                </div>
                                                  <div class="form-group col-md-6">
                                                <h3 class="page-title">User Avatar</h3>              
                                                  <div class="col-md-12 user-picture"> 
                                                          <input type="file" name="user_icon" id="input-file">
                                                  </div>
                                                
                                                </div>
                                            
                                        </div>
                                            
                                            
                                    </div>
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
                                           
                                                
                                                     <div class="col-md-12">
                                                         <label><strong>Organisation</strong></label>
                                                     <input type="text" value="<?php if(isset($usersearch[0]['organisation'])){ ?>{{$usersearch[0]['organisation']}}<?php  } ?>" name="organisation"  class="form-control" >                 
                                                     </div>
                                               
                                                  
                                        </div>
                                       
                                        <div class="form-group alignselect">
                                            
                                                 
                                                 <div class="col-md-12">
                                                     <label><strong>Experience</strong></label>
                                                    <textarea  rows="3" class="form-control" placeholder="Experience" name="experience"  class="form-control">{{ isset($user->experience) ? $user->experience : null }}</textarea>
                                                </div>
                                               
                                                     <div class="col-md-12" style="margin-top: 2%;">
                                                         <label><strong>Education</strong></label>
                                                    <textarea  rows="3" class="form-control" placeholder="Education" name="education"  class="form-control">{{ isset($user->education) ? $user->education : null }}</textarea>
                                                </div>
                                           
                                        </div>
                                        <div class="text-right">
                                            <button type="submit" class="btn btn-primary">Save <i class="icon-arrow-right14 position-right"></i></button>
                                        </div>
                                       
                                </div>
                            </div>
                {!! Form::close() !!} 
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END Page Content -->   
                                </div>
                </div>
            </div>
    </div>
</div> 

@endsection