 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<title>{{getcong('site_name')}} Admin</title>   
    <meta name="description" content="@yield('head_description', getcong('site_description'))" />

    <meta property="og:type" content="article" />
    <meta property="og:title" content="@yield('head_title',  getcong('site_name'))" />
    <meta property="og:description" content="@yield('head_description', getcong('site_description'))" />
    <meta property="og:keywords" content="@yield('head_keywords', getcong('site_description'))" />
    <meta property="og:image" content="@yield('head_image', url('/upload/logo.png'))" />
    <meta property="og:url" content="@yield('head_url', url('/'))" />
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('admin_assets/css/icons/icomoon/styles.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('admin_assets/css/icons/fontawesome/styles.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('admin_assets/css/bootstrap.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('admin_assets/css/core.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('admin_assets/css/components.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('admin_assets/css/colors.css') }}" rel="stylesheet" type="text/css">
	
</head>
    <body>
      
<style>
    .pading-15 {
    padding: 15px;
}
    </style>
        <!-- Login Footer -->
     
        
         <div class="page-container login-container">
            
            <!-- Page content -->
            <div class="page-content">
                
                <!-- Main content -->
                <div class="content-wrapper">
                    {!! Form::open(array('url' => 'admin/login','class'=>'','id'=>'login','role'=>'form')) !!}
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
                                         <div class="col-sm-6 text-left">
                                     
                                        <label class="css-input switch switch-sm switch-primary">
                                            <input type="checkbox" id="login-remember-me" name="remember"><span></span> Remember Me?
                                        </label>
                                     
                                </div>
                                        <div class="col-sm-6 text-right">
                                            <a href="{{ URL::to('password/email') }}" style="color: #1E88E5;
                                               text-decoration: underline;">Forget password?</a>
                                        </div>	
                                        
                                        
                                    </div>
                                </div>
                                <div class="form-group login-options">
                                          <button type="submit" class="btn btn-primary btn-block">Login <i class="icon-arrow-right14 position-right"></i></button>
                                </div>  
                           
			{!! Form::close() !!}
                
                    
                </div>
                <!-- /main content -->
                
            </div>
            <!-- /page content -->
 
            
        </div>
        <!-- /page container -->
                 <!-- END Main Container -->
  <!-- Core JS files -->
	<script type="text/javascript" src="{{ URL::asset('admin_assets/js/plugins/loaders/pace.min.js') }}"></script>
	<script type="text/javascript" src="{{ URL::asset('admin_assets/js/core/libraries/jquery.min.js') }}"></script>
	<script type="text/javascript" src="{{ URL::asset('admin_assets/js/core/libraries/bootstrap.min.js') }}"></script>
	<script type="text/javascript" src="{{ URL::asset('admin_assets/js/plugins/loaders/blockui.min.js') }}"></script>
	<script type="text/javascript" src="{{ URL::asset('admin_assets/js/plugins/ui/nicescroll.min.js') }}"></script>
	<script type="text/javascript" src="{{ URL::asset('admin_assets/js/plugins/ui/drilldown.js') }}"></script>
	<!-- /core JS files -->
 
        <!-- /theme JS files -->
	<!-- Theme JS files -->
        <script type="text/javascript" src="{{ URL::asset('admin_assets/js/plugins/visualization/echarts/echarts.js') }}"></script>
	<script type="text/javascript" src="{{ URL::asset('admin_assets/js/core/app.js') }}"></script>
       
	<script type="text/javascript" src="{{ URL::asset('admin_assets/js/charts/echarts/lines_areas.js') }}"></script>


<!-- /theme JS files --> 
	<!-- /theme JS files -->
<!-- /theme JS files -->
<style>

.row
{
border-bottom:1px solid #ddd;
}
.col-md-2
{
padding-right: 0px;
padding-left: 0px;
}
.col-md-2
{
padding-right: 0px;
padding-left: 0px;
text-align:center;
}
.col-md-3
{
text-align: center;
}
.col-md-3 button
{
text-align:left;
width:80%;
margin-top: 5px;
margin-bottom: 5px;

}
h6
{

padding-left:0px;
padding-right:0px;
text-align:center;
font-size: 13px;
border-bottom:none;
}
h5{
padding-top:20px;
padding-bottom:20px;
font-size:22px;
text-align:center;
    border-bottom:none;
}
.btn.disabled, .btn[disabled], fieldset[disabled] .btn {
    cursor: not-allowed;
    opacity: 0.3;
	}
	.icons-list
	{
	margin-top:9px;
	
    margin-bottom: 9px;

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
      

.tab-content > .tab-pane {
  display:block;  
}
.row {
  
  margin-left: opx;
     
margin-right: 10px;	 
}

.user{
font-size:15px;
border:0px;
margin:0px;
padding:0px;
margin-bottom:5%;
}
								
	</style>
</body>
</html>
          