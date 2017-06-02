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
	
    <link href="{{ URL::asset('admin_assets/css/bootstrap-datetimepicker.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('admin_assets/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet" type="text/css">
</head>
    <body>
     	<div id="page-container" class="sidebar-l sidebar-o side-scroll header-navbar-fixed">
          
            <!-- Header -->
           @include("admin.topbar")
            <!-- END Header -->
 <!-- Sidebar -->
            @include("admin.sidebar")
            <!-- END Sidebar -->
            <!-- Main Container -->
            <main id="main-container">
               
               @yield("content")

            </main>
          <?php $str=$_SERVER['REQUEST_URI']; $str = substr($str,7);  ?>
            <!-- END Main Container -->
             @if($str=='invites' || $str=='conversation' || $str=='payments')
             <!-- Core JS files -->
	<script type="text/javascript" src="{{ URL::asset('admin_assets/js/plugins/loaders/pace.min.js') }}"></script>
	<script type="text/javascript" src="{{ URL::asset('admin_assets/js/core/libraries/jquery.min.js') }}"></script>
	<script type="text/javascript" src="{{ URL::asset('admin_assets/js/core/libraries/bootstrap.min.js') }}"></script>
	<script type="text/javascript" src="{{ URL::asset('admin_assets/js/plugins/loaders/blockui.min.js') }}"></script>
	<script type="text/javascript" src="{{ URL::asset('admin_assets/js/plugins/ui/nicescroll.min.js') }}"></script>
	<script type="text/javascript" src="{{ URL::asset('admin_assets/js/plugins/ui/drilldown.js') }}"></script>
	<!-- /core JS files -->

	<!-- Theme JS files -->
	<script type="text/javascript" src="{{ URL::asset('admin_assets/js/core/libraries/jasny_bootstrap.min.js') }}"></script>
	<script type="text/javascript" src="{{ URL::asset('admin_assets/js/plugins/forms/editable/editable.min.js') }}"></script>
	<script type="text/javascript" src="{{ URL::asset('admin_assets/js/plugins/extensions/mockjax.min.js') }}"></script>
	<script type="text/javascript" src="{{ URL::asset('admin_assets/js/plugins/forms/editable/address.js') }}"></script>
	<script type="text/javascript" src="{{ URL::asset('admin_assets/js/plugins/ui/moment/moment.min.js') }}"></script>
	<script type="text/javascript" src="{{ URL::asset('admin_assets/js/plugins/forms/styling/switchery.min.js') }}"></script>
	<script type="text/javascript" src="{{ URL::asset('admin_assets/js/plugins/forms/styling/uniform.min.js') }}"></script>
	<script type="text/javascript" src="{{ URL::asset('admin_assets/js/plugins/forms/selects/select2.min.js') }}"></script>
	<script type="text/javascript" src="{{ URL::asset('admin_assets/js/plugins/forms/inputs/autosize.min.js') }}"></script>
	<script type="text/javascript" src="{{ URL::asset('admin_assets/js/plugins/forms/inputs/typeahead/typeahead.bundle.min.js') }}"></script>
	<script type="text/javascript" src="{{ URL::asset('admin_assets/js/plugins/forms/tags/tagsinput.min.js') }}"></script>
	<script type="text/javascript" src="{{ URL::asset('admin_assets/js/plugins/forms/inputs/touchspin.min.js') }}"></script>
	<script type="text/javascript" src="{{ URL::asset('admin_assets/js/plugins/forms/inputs/formatter.min.js') }}"></script>

	<script type="text/javascript" src="{{ URL::asset('admin_assets/js/core/app.js') }}"></script>
	<script type="text/javascript" src="{{ URL::asset('admin_assets/js/pages/form_editable.js') }}"></script>
     


       @else
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
        <script type="text/javascript" src="{{ URL::asset('admin_assets/js/bootstrap-datetimepicker.js') }}"></script>
     @endif

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
          