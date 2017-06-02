@extends("app")

@section('head_title', 'Register | '.getcong('site_name') )

@section('head_url', Request::url())

@section("content")
<!-- Page container -->
<style>
    .pading-15 {
    padding: 15px;
}
    </style>
<div class="page-container login-container">
    
    <!-- Page content -->
    <div class="page-content">
        
        <!-- Main content -->
        <div class="content-wrapper">
           
            {!! Form::open(array('url' => 'register','class'=>'','id'=>'register','role'=>'form')) !!} 
              <div class="panel login-form pading-15">
                            <div class="thumb thumb-rounded">
                                
                                <div class="caption-overflow">
                                    
                                </div>
                            </div>
                   <h2 class="content-group text-center text-semibold no-margin-top">Register</h2>
            <div class="message">
                
                @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
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
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                {{ Session::get('flash_message') }}
            </div>
            
            
            @endif
             <div class="form-group has-feedback">
                                    
                                    <div class="form-group">
                                        
                                        <select name="need__for_position" data-placeholder="Select position" class="select" style="
                                                cursor: pointer;
                                                outline: 0;
                                                display: block;
                                                height: 36px;
                                                padding: 7px 0;
                                                line-height: 1.5384616;
                                                position: relative;
                                                border: 1px solid transparent;
                                                white-space: nowrap;
                                                border-radius: 3px;
                                                -webkit-user-select: none;
                                                -moz-user-select: none;
                                                -ms-user-select: none;
                                                user-select: none;
                                                border-color: #ddd;
                                                display: block;
                                                width: 100%;
                                                height: 36px;
                                                padding: 7px 12px;
                                                font-size: 13px;
                                                line-height: 1.5384616;
                                                color: #999999;
                                                background-color: #fff;
                                                background-image: none;
                                                border: 1px solid #ddd;
                                                border-radius: 3px;
                                                -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
                                                box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
                                                -webkit-transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
                                                -o-transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
                                                transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
                                                " required="required">
                                            <option value=""  <?php if(!isset($inputs)){echo 'selected' ;}?>  disabled="disabled">I am looking for </option>
                                            @foreach(\App\Fieldsets::where('field_type','role')->orderBy('id')->get() as $field)
                                             <option <?php if(isset($inputs)) { if($inputs['need__for_position']==$field->field_value){ echo 'selected' ; } } ?>>{{$field->field_value}} </option>
                                             @endforeach
                                        </select>
                                    </div>
                                      <div class="form-group">
                                        
                                        <select name="experience" required="required" data-placeholder="Select position" class="select" style="
                                                cursor: pointer;
                                                outline: 0;
                                                display: block;
                                                height: 36px;
                                                padding: 7px 0;
                                                line-height: 1.5384616;
                                                position: relative;
                                                border: 1px solid transparent;
                                                white-space: nowrap;
                                                border-radius: 3px;
                                                -webkit-user-select: none;
                                                -moz-user-select: none;
                                                -ms-user-select: none;
                                                user-select: none;
                                                border-color: #ddd;
                                                display: block;
                                                width: 100%;
                                                height: 36px;
                                                padding: 7px 12px;
                                                font-size: 13px;
                                                line-height: 1.5384616;
                                                color: #999999;
                                                background-color: #fff;
                                                background-image: none;
                                                border: 1px solid #ddd;
                                                border-radius: 3px;
                                                -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
                                                box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
                                                -webkit-transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
                                                -o-transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
                                                transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
                                                ">
                                            <option value="" <?php if(!isset($inputs)){echo 'selected' ;}?> disabled="disabled">With experience </option>
                                               @foreach(\App\Fieldsets::where('field_type','experience')->orderBy('id')->get() as $field)
                                             <option <?php if(isset($inputs)) { if($inputs['experience']==$field->field_value){ echo 'selected' ; } } ?> value="{{$field->field_value}}">{{$field->field_value}} years</option>
                                               @endforeach
                                            
                                        </select>
                                    </div>
                                    
                                    <div class="form-group">
                                        
                                        <select name="position" required="required" data-placeholder="Select position" class="select" style="
                                                cursor: pointer;
                                                outline: 0;
                                                display: block;
                                                height: 36px;
                                                padding: 7px 0;
                                                line-height: 1.5384616;
                                                position: relative;
                                                border: 1px solid transparent;
                                                white-space: nowrap;
                                                border-radius: 3px;
                                                -webkit-user-select: none;
                                                -moz-user-select: none;
                                                -ms-user-select: none;
                                                user-select: none;
                                                border-color: #ddd;
                                                display: block;
                                                width: 100%;
                                                height: 36px;
                                                padding: 7px 12px;
                                                font-size: 13px;
                                                line-height: 1.5384616;
                                                color: #999999;
                                                background-color: #fff;
                                                background-image: none;
                                                border: 1px solid #ddd;
                                                border-radius: 3px;
                                                -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
                                                box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
                                                -webkit-transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
                                                -o-transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
                                                transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
                                                ">
                                            <option value="" <?php if(!isset($inputs)){echo 'selected' ;}?>  disabled="disabled">My Role </option>
                                             @foreach(\App\Fieldsets::where('field_type','role')->orderBy('id')->get() as $field)
                                             <option <?php if(isset($inputs)) { if($inputs['position']==$field->field_value){ echo 'selected' ; } } ?> >{{$field->field_value}}</option>
                                             @endforeach
                                        </select>
                                    </div>
                                    
                                  
                                    
                                    
                                    
                                    
                                    <div class="form-control-feedback">
                                        
                                    </div>
                                </div>
<!--            <div class="form-group login-options">
                    <input id="first_name" name="first_name" type="text" value="" class="form-control input-md" placeholder="First Name">
                </div>
                <div class="form-group login-options">
                    <input id="last_name" name="last_name" type="text" value="" class="form-control input-md" placeholder="Last Name">
                </div>-->
                <div class="form-group login-options">
                 
                    <input id="email" name="email" type="email" value="<?php if(isset($inputs)) { echo $inputs['email']; } ?>" class="form-control input-md" placeholder="Email">
                </div>
                <div class="form-group login-options">
                   
                    <input id="password" name="password" type="password" value="" class="form-control input-md" placeholder="Password">
                </div>
                <div class="form-group login-options">
             
                    <input id="password_confirmation" name="password_confirmation" type="password" value="" class="form-control input-md" placeholder="Confirm Password">
                </div>
  
                                  
                            
                <div class="form-group login-options">
                    <p><input type="checkbox"required="required"> I have read the <a href="{{ URL::to('termsandconditions') }}" target="_blank">{{getcong('terms_of_title')}}</a> and agree to them.</p><br/>
                     
                    <button id="submit" name="submit" class="btn btn-primary btn-block">Register <i class="icon-arrow-right14 position-right"></i></button>
                    
                     <div class="row">
                          <h6 class="content-group text-center  ">Already registered? <a href="{{ URL::to('login') }}" style="color: #1E88E5;
                                               text-decoration: underline;">Login</a></h6>
                                        
                                    </div>
                </div>
            </div>
                {!! Form::close() !!} 
                
                
           
            <!-- /main content -->
            
        </div>
        <!-- /page content -->
 
        
    </div>
    <!-- /page container -->
    
    
    @endsection
