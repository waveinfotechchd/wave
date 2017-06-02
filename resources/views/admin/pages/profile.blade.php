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
     <div class="row">
                <div class="col-md-9">
                    <div class="panel panel-flat">
                        <div class="panel-heading">
                            <h1>Profile information</h1>
                            <div class="heading-elements">
                                <ul class="icons-list">
                                    <li><a data-action="collapse"></a></li>
                                    <li><a data-action="reload"></a></li>
                                 
                                </ul>
                            </div>
                        </div>
                            
                        <div class="panel-body">
                            <div class="col-lg-12 panel" style="padding-top:20px">

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
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            {{ Session::get('flash_message') }}
                                        </div>
                                    @endif

                                        {!! Form::open(array('url' => 'admin/profile','class'=>'form-horizontal padding-15','name'=>'account_form','id'=>'account_form','role'=>'form','enctype' => 'multipart/form-data')) !!}
                
                                       
                                         
                                        <div class="form-group">
                                            <label for="" class="col-sm-3 control-label">First Name</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="first_name" value="{{ Auth::user()->first_name }}" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="col-sm-3 control-label">Last Name</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="last_name" value="{{ Auth::user()->last_name }}" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="col-sm-3 control-label">Email</label>
                                            <div class="col-sm-9">
                                                <input type="email" name="email" value="{{ Auth::user()->email }}" class="form-control" value="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="col-sm-3 control-label">Mobile</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="mobile" value="{{ isset(Auth::user()->mobile) ? Auth::user()->mobile : null }}" class="form-control">
                                            </div>
                                        </div>
                                       
                                      

                                        <hr>
                                      
                                         <div class="form-group">
                                            <label for="avatar" class="col-sm-3 control-label">Profile Picture</label>
                                            <div class="col-sm-9">
                                                <div class="media">
                                                    <div class="media-left">
                                                        @if(Auth::user()->image_icon)
                                                         
                                                            <img src="{{URL::to(Auth::user()->image_icon)}}" width="80" alt="person">
                                                        
                                                        @else
                                                        
                                                            <img src="{{ URL::asset('admin_assets/images/guy.jpg') }}" alt="person" class="img-circle" width="80"/>
                                                    
                                                        @endif
                                                         
                                                                                        
                                                    </div>
                                                    <div class="media-body media-middle">
                                                        <input type="file" name="user_icon" class="filestyle">
                                                        <small class="text-muted bold">Size 200x200px</small>
                                                    </div>
                                                </div>
                            
                                            </div>
                                        </div>
                                        
                                        <hr>
                                        <div class="form-group">
                                            <div class="col-md-offset-3 col-sm-9 ">
                                                <button type="submit" class="btn btn-primary">Save Changes <i class="md md-lock-open"></i></button>
                                                 
                                            </div>
                                        </div>

                                    {!! Form::close() !!}
                                    </div>
                            <br/>
                            <br/>
                             <div class="col-md-12">
                    <div class="panel panel-flat">
                        <div class="panel-heading">
                             <h1>Change Password</h1>
                            <div class="heading-elements">
                                <ul class="icons-list">
                                    <li><a data-action="collapse"></a></li>
                                    <li><a data-action="reload"></a></li>
                                   
                                </ul>
                            </div>
                        </div>
                            
                        <div class="panel-body">
                             <div class="col-lg-6 " >
                                       {!! Form::open(array('url' => 'admin/profile_pass','class'=>'form-horizontal padding-15','name'=>'pass_form','id'=>'pass_form','role'=>'form')) !!}
                
                                        <div class="form-group">
                                            <label for="" class="col-sm-3 control-label">New Password</label>
                                            <div class="col-sm-9">
                                                <input type="password" name="password" value="" class="form-control" value="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="" class="col-sm-3 control-label">Confirm Password</label>
                                            <div class="col-sm-9">
                                                <input type="password" name="password_confirmation" value="" class="form-control" value="">
                                            </div>
                                        </div>
                                         
                                        <hr>
                                        <div class="form-group">
                                            <div class="col-md-offset-3 col-sm-9 ">
                                                <button type="submit" class="btn btn-primary">Save Changes <i class="md md-lock-open"></i></button>
                                            </div>
                                        </div>

                                    {!! Form::close() !!} 
                                    </div>
                        </div>
                    </div>
                    <!-- /stacked area chart -->
                        
                </div>
                        </div>
                        
                    </div>
                    <!-- /stacked area chart -->
                        
                </div>
         
     </div>
               
              </div>
    </div>
</div>       
                
                
@endsection