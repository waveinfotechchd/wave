 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('head_title', getcong('site_name'))</title>
    <meta name="description" content="@yield('head_description', getcong('site_description'))" />

    <meta property="og:type" content="article" />
    <meta property="og:title" content="@yield('head_title',  getcong('site_name'))" />
    <meta property="og:description" content="@yield('head_description', getcong('site_description'))" />
    <meta property="og:keywords" content="@yield('head_keywords', getcong('site_description'))" />
    <meta property="og:image" content="@yield('head_image', url('/upload/logo.png'))" />
    <meta property="og:url" content="@yield('head_url', url('/'))" />
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('site_assets/css/icons/icomoon/styles.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('site_assets/css/icons/fontawesome/styles.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('site_assets/css/bootstrap.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('site_assets/css/core.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('site_assets/css/components.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('site_assets/css/colors.css') }}" rel="stylesheet" type="text/css">
   
</head>
<body>
    @include("_particles.header")
    @yield("content")
    @include("_particles.footer")
        <!-- Core JS files -->
	<script type="text/javascript" src="{{ URL::asset('site_assets/js/plugins/loaders/pace.min.js') }}"></script>
	<script type="text/javascript" src="{{ URL::asset('site_assets/js/core/libraries/jquery.min.js') }}"></script>
	<script type="text/javascript" src="{{ URL::asset('site_assets/js/core/libraries/bootstrap.min.js') }}"></script>
	<script type="text/javascript" src="{{ URL::asset('site_assets/js/plugins/loaders/blockui.min.js') }}"></script>
	<script type="text/javascript" src="{{ URL::asset('site_assets/js/plugins/ui/nicescroll.min.js') }}"></script>
	<script type="text/javascript" src="{{ URL::asset('site_assets/js/plugins/ui/drilldown.js') }}"></script>
	<!-- /core JS files -->
   <!-- Theme JS files -->
	
	<script type="text/javascript" src="{{ URL::asset('site_assets/js/core/app.js') }}"></script>
          @if(classActivePathSite('conversation'))
          
        <!-- Script start for users conversation-->
        <script type="text/javascript" src="{{ URL::asset('site_assets/js/pages/support_chat_layouts.js') }}"></script>
	<script type="text/javascript" src="{{ URL::asset('site_assets/js/credit_card.js') }}"></script>



        @else
        <script type="text/javascript" src="{{ URL::asset('site_assets/js/plugins/forms/styling/uniform.min.js') }}"></script>
	<script type="text/javascript" src="{{ URL::asset('site_assets/js/pages/login.js') }}"></script>
	<!-- /theme JS files -->
        <script type="text/javascript" src="{{ URL::asset('site_assets/js/plugins/notifications/pnotify.min.js') }}"></script>
	<script type="text/javascript" src="{{ URL::asset('site_assets/js/plugins/forms/selects/bootstrap_multiselect.js') }}"></script>
<!-- Script start for users serach-->
	<script type="text/javascript" src="{{ URL::asset('site_assets/js/pages/form_multiselect.js') }}"></script>
        <!-- Script end for users serach-->
       
        <!-- Script end for users conversation-->
        <script>
	
loader = '<div class="md-modal md-show">\
	<img src="http://139.59.64.44/upload/loadingimg.gif" alt="">\
	<h3 class="ldclr"></h3>\
	</div>';
$(document).on('ready', function() {
$("#form-filters").on('submit',(function(e) {
	e.preventDefault();
		$.ajax({
			url: "/search/filters",
			type: "POST",
			data: new FormData(this), 
			contentType: false,      
			cache: false,             
			processData:false,    
			success: function(data){
				$('#searchfilters').html(data);
				$( "#loading-img" ).html('');
			}
		});
	}));
        
            $('.select-box-radio').click(function(){
                $('.price').removeClass("panel-success");
                $('.price').addClass("panel-gray");
                $(this).parents('.price').removeClass("panel-gray").addClass("panel-success");
            });
          
});




$( ".form-submit" ).click(function() {
  $( "#loading-img" ).html(loader);
  $( "#form-filters" ).submit();
});
$( "#search-empty" ).click(function() {
  $(".search-emp").val('');
  $( "#loading-img" ).html(loader);
  $( "#form-filters" ).submit();
});
$( ".role-emp" ).click(function() {
  $("input.experience-emp").removeAttr("disabled");
  $("input.Iavailability-emp").removeAttr("disabled");
  $("input.availability-emp").removeAttr("disabled");
  $("#form-keyword").removeAttr("readonly");
  $("#form-organisation").removeAttr("readonly");
   $("#experience-all").prop('checked', true);
   $("#Iavailability-all").prop('checked', true);
   $("#availability-all").prop('checked', true);
   $(".experience-emp").prop('checked', true);
   $(".Iavailability-emp").prop('checked', true);
   $(".availability-emp").prop('checked', true); 
   $("#loading-img").html(loader);
   $("#form-filters").submit();
});
$( ".experience-emp" ).click(function() {
    $("#experience-all").prop('checked', false);
   $("#loading-img").html(loader);
   $("#form-filters").submit();
});
$( ".Iavailability-emp" ).click(function() {
    $("#Iavailability-all").prop('checked', false);
   $("#loading-img").html(loader);
   $("#form-filters").submit();
});
$( ".availability-emp" ).click(function() {
    $("#availability-all").prop('checked', false);
   $("#loading-img").html(loader);
   $("#form-filters").submit();
});
$( "#role-empty" ).click(function() {
  $(".role-emp").prop('checked', false);
  $(".experience-emp").prop('checked', false);
  $(".Iavailability-emp").prop('checked', false);
  $(".availability-emp").prop('checked', false); 
  $("#form-keyword").val(''); 
  $("#form-organisation").val(''); 

  $("#form-organisation").attr("readonly", true);
  $("#form-keyword").attr("readonly", true);
  $("input.experience-emp").attr("disabled", true);
  $("input.Iavailability-emp").attr("disabled", true);
  $("input.availability-emp").attr("disabled", true);
  
  $( "#loading-img" ).html(loader);
  $( "#form-filters" ).submit();
});

$( "#experience-empty" ).click(function() {
  $(".experience-emp").prop('checked', false);
  $( "#loading-img" ).html(loader);
  $( "#form-filters" ).submit();
});
$( "#Iavailability-empty" ).click(function() {
  $(".Iavailability-emp").prop('checked', false);
  $( "#loading-img" ).html(loader);
  $( "#form-filters" ).submit();
});
$( "#availability-empty" ).click(function() {
  $(".availability-emp").prop('checked', false);
  $( "#loading-img" ).html(loader);
  $( "#form-filters" ).submit();
});
$( "#experience-all" ).click(function() {
//    if (this.checked) {
      $(".experience-emp").prop('checked', true);
//    }else{
//      $(".experience-emp").prop('checked', false);
//    }
});
$( "#Iavailability-all" ).click(function() {
//    if (this.checked) {
      $(".Iavailability-emp").prop('checked', true);
//    }else{
//      $(".Iavailability-emp").prop('checked', false);
//    }
});
$( "#availability-all" ).click(function() {
//    if (this.checked) {
      $(".availability-emp").prop('checked', true);
//    }else{
//      $(".availability-emp").prop('checked', false);
//    }
});

function form_keyword() {
    var keyword = document.getElementById("form-keyword").value;
    if(keyword.length >= 2){
     $( "#loading-img" ).html(loader);
     $( "#form-filters" ).submit();
    }
}
function form_organisation() {
     var organisation = document.getElementById("form-organisation").value;
    if(organisation.length >=2){
      $("#loading-img").html(loader);
      $("#form-filters").submit();
    }
}



</script>
<div id="loading-img"></div>
<style>
#loading-img .md-modal {
  height: auto;
  left: 50%;
  max-width: 630px;
  min-width: 165px;
  position: fixed;
  top: 50%;
  transform: translateX(-50%) translateY(-50%);
  visibility: visible;
  z-index: 9999;
}
#productsloadMore {
    background: #E68019;
    width: 100%;
    border-radius: 0px;
    color: #fff;
    font-weight: 800;
    text-align:center;
} 
</style>
 <!-- /Script end for users serach-->
  <script >
function inviteFunction(key){
    $.get('/users/invite',{user_id: key}, function (data){
    $(".message").html(data);
   // alert(data);
   $(".clickme").click();
    });
}
function shorlistsFunctions(key,status,type,name){
 if(status=="DECLINED"){
 if(window.confirm("Are you sure that you want to stop communicating with "+name+"? They will not be able to invite you again.")){
       $.get('/users/save_actions',{user_id: key,status: status,type: type}, function (data){
        $(".message").html(data);
       // alert(data);
       $(".clickme").click();
        });
 }{
      return false;
 }
 }else{
    $.get('/users/save_actions',{user_id: key,status: status,type: type}, function (data){
    $(".message").html(data);
   // alert(data);
   $(".clickme").click();
    });  
 }
}
function createTeamFunction(key,status,type){

    $.get('/users/save_shorlist_actions',{to_user_id: key,status: status,type: type}, function (data){
    $(".message").html(data);
   // alert(data);
    $(".clickme").click();
    });
}

</script> 
 

@endif
<style>
    .text-danger h1, .h1 {
    font-size: 15px;
    padding-left: 18px;}
 
.sd {
    margin: 46px auto;
    width: 425px;
}
.sdf {
    background-color: #e5f0fb;
    border: 2px solid #00bcda;
    border-radius: 6px;
    box-shadow: none;
    height: 100px;
    text-align: center;
} 
.sd .sdf .message h1{
    font-size:17px;
}
</style>
</body>
</html>