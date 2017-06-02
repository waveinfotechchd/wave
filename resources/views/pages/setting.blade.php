@extends("app")
@section('head_title', 'Setting | '.getcong('site_name') )
@section('head_url', Request::url())
@section("content")
@include("_particles.user_sidebar")
<!-- Theme JS files -->
	
	
	<!-- /theme JS files -->
<!-- Page header -->
<div class="page-header">
    <div class="page-header-content">
        <div class="page-title">
            
        </div>
            
        <div class="heading-elements">
            <div class="heading-btn-group">
                
            </div>
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
            
            <!-- Multiselect examples -->
            <div class="row">
                <div class="col-md-3">
                </div>
                <div class="col-md-6">
                    <div class="panel panel-flat">
                        <div class="panel-heading">
                            
                            <div class="heading-elements">
                                <ul class="icons-list">
                                    <li><a data-action="collapse"></a></li>
                                    <li><a data-action="reload"></a></li>
                                    <li><a data-action="close"></a></li>
                                </ul>
                            </div>
                        </div>
                            
                        <div class="panel-body">
                           {!! Form::open(array('url' => 'save_search_setting','class'=>'','id'=>'login','role'=>'form')) !!} 
                           <div class="message">
				  @if (count($errors) > 0)
					  <div class="alert alert-danger">
					   <a class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span></a>
						  <ul style="list-style: none;">
							  @foreach ($errors->all() as $error)
								  <li>{{ $error }}</li>
							  @endforeach
						  </ul>
					  </div>
				  @endif
				</div>
				@if(Session::has('flash_message'))
				  <div class="alert alert-success fade in">
					  <a class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span></a>
					 {{ Session::get('flash_message') }}
				   </div>             
				@endif
                            <!-- Default multiselect -->
                            @foreach($usersearch as $setting)
                            <div class="form-group">
                                <label>Visibility</label>
                                <div class="multi-select-full">
                                    <select class="multiselect" name="search_visibility">
                                        <option value="hidden" <?php if(isset($setting->search_visibility)){ if($setting->search_visibility=='hidden'){ echo 'selected'; } } ?>>Hidden</option>
                                        <option value="visible" <?php if(isset($setting->search_visibility)){ if($setting->search_visibility=='visible'){ echo 'selected'; } } ?>>Visible</option>
                                            
                                    </select>
                                </div>
                            </div>
                            <!-- /default multiselect -->
                                
                                
                            <!-- Default multiselect with selected options -->
                            <div class="form-group">
                                <label>Status</label>
                                <div class="multi-select-full">
                                    <select class="multiselect" name='search_status'>
                                        <option value="SEEKING"<?php if(isset($setting->search_status)){ if($setting->search_status=='SEEKING'){ echo 'selected'; } } ?>>SEEKING</option>
                                         <option value="NOT_SEEKING" <?php if(isset($setting->search_status)){ if($setting->search_status=='NOT_SEEKING'){ echo 'selected'; } } ?>>NOT_SEEKING</option>
                                         <option value="FOUNDER" <?php if(isset($setting->search_status)){ if($setting->search_status=='FOUNDER'){ echo 'selected'; } } ?>>FOUNDER</option>
                                         <option value="COMMITTED" <?php if(isset($setting->search_status)){ if($setting->search_status=='COMMITTED'){ echo 'selected'; } } ?>>COMMITTED</option>
                                    </select>
                                </div>
                            </div>
                                
                            <div class="form-group">
                                <label>Contact</label>
                                <div class="multi-select-full">
                                    <select class="multiselect" multiple="multiple" name="contact[]">
                                        <option value="messages"<?php if(isset($setting->setting_messages)){ if($setting->setting_messages=='messages'){ echo 'selected'; } } ?>>Messages</option>
                                        <option value="email"<?php if(isset($setting->setting_email)){ if($setting->setting_email=='email'){ echo 'selected'; } } ?>>Email</option>
                                        <option value="phone"<?php if(isset($setting->setting_phone)){ if($setting->setting_phone=='phone'){ echo 'selected'; } } ?>>Phone</option>
                                            
                                    </select>
                                </div>
                            </div>
                                @endforeach
                            <div class="text-right" style="margin-bottom:1%;text-align: -webkit-left;
                                 width: 50%;
                                 margin-bottom: 1%;
                                 float: left;">
                                <a class="btn btn-danger"><i class="icon-cross position-left"></i>Cancel</a>
                            </div>
                            <div class="text-right" >
                                <button type="submit" class="btn btn-primary">Save<i class="icon-arrow-right14 position-right"></i></button>
                            </div>
                                
                         {!! Form::close() !!}       
                                
                        </div>
                    </div>
                </div>
                    
                    
            </div>
                
                
                
        </div>
    </div>
</div>
    
    
    
@endsection