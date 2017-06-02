@extends("app")

@section('head_title', 'Log in to | '.getcong('site_name') )

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
                    {!! Form::open(array('url' => 'login','class'=>'','id'=>'login','role'=>'form')) !!}
                     <div class="panel login-form pading-15">
                            <div class="thumb thumb-rounded">
                                
                                <div class="caption-overflow">
                                    
                                </div>
                            </div>
                         <h2 class="content-group text-center text-semibold no-margin-top">Sign In</h2>
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
				
				
                                <div class="form-group login-options"><input type="email" name="email" placeholder="Email" class="form-control"/></div>
				<div class="form-group login-options has-feedback"><input type="password" name="password" placeholder="password" class="form-control"/>
                                <div class="form-control-feedback">
								<i class="icon-user-lock text-muted"></i>
							</div>
                                </div>
                                 <div class="form-group login-options">
                                    <div class="row">
                                        <div class="col-sm-12 text-right">
                                            <a href="{{ URL::to('password/email') }}" style="color: #1E88E5;
                                               text-decoration: underline;">Forget password?</a>
                                        </div>	
                                        
                                        
                                    </div>
                                </div>
                                <div class="form-group login-options">
                                          <button type="submit" class="btn btn-primary btn-block">Login <i class="icon-arrow-right14 position-right"></i></button>
                                </div>  
                                <div class="form-group login-options">

                                                                        
					<div class="row">
                          <h6 class="content-group text-center text-semibold no-margin-top">New User? <a href="{{ URL::to('register') }}" style="color: #1E88E5;
                                               text-decoration: underline;">Register</a></h6>
                                        
                                    </div>
					
				</div>
			{!! Form::close() !!}
                
                    
                </div>
                <!-- /main content -->
                
            </div>
            <!-- /page content -->
 
            
        </div>
        <!-- /page container -->
 

@endsection
