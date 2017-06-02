@extends("app")
@section('head_title', 'Subscription | '.getcong('site_name') )
@section('head_url', Request::url())
@section("content")
@include("_particles.user_sidebar")

<style>
a:focus {
	text-decoration: none;
	color: transparent;
	background-color: transparent;
}
.cardForm-Field50 {
  float: left;
  width: 50%;
}



/* Makes the default card text easier to read */
.jp-card .jp-card-front .jp-card-display, .jp-card .jp-card-back .jp-card-display {
  text-shadow: 0 1px 2px #1D1F20;
}
/* Changes the default styles */
.jp-card .jp-card-front, .jp-card .jp-card-back {
  background: #27ae60!important;
}
.card-container form {
 max-width: 350px;
 text-align: center;
}
.form-container form {
  margin: 10px auto;
}
.form-container input {
  margin: 0 0 10px 0;
  /* padding: 0; */
  font-size: 16px;
  float: left;
  padding: 5px 0;
  box-sizing: border-box;
  webkit-box-shadow: none;
  box-shadow: none;
  /* width: 50%; */
  display: block;
}
input.secondRow {
  float: left;
  display: block;
  width: 100%;
}

.form-container label {
  text-align: left;
  float: left;
  padding: 5px 0 0px 5px;
  width: 100%;
  font-family: arial;
  text-transform: uppercase;
  font-size: 14px;
  /* font-weight: bold; */
}

input.button {
  width: 100%;
  padding: 11px;
  border: none;
  box-shadow: none;
  border-radius: 0;
  /* background: #CCCCCC; */
}
/*input.button:hover {
  background: #27ae60;
  color: #fff;
  text-shadow: 0 1px 2px rgba(0, 0, 0, 0.3);
}*/
 input:not([type=submit]):not([type=file]) {
   /* omg so much cleaner */
  border: 1px solid #DDD;
    -webkit-box-shadow: 
      inset 0 0 0px  rgba(0,0,0,0.1),
            0 0 0px rgba(0,0,0,0.1); 
    -moz-box-shadow: 
      inset 0 0 0px  rgba(0,0,0,0.1),
            0 0 0px rgba(0,0,0,0.1); 
    box-shadow: 
      inset 0 0 0px  rgba(0,0,0,0.1),
            0 0 0px rgba(0,0,0,0.1); 
    padding: 10px;
}
.form-container input[name="name"]{
  width: 100%;
}
.form-container input[name="number"]{
  width: 100%;
}
.form-container input[name="cvc"]{
  border-left: 0px;
}

.CardDefault, .CardDefault:hover {
  background: gray;
  color: #fff;
  text-shadow: 0 1px 2px rgba(0, 0, 0, 0.3);
}
.CardWarning,.CardWarning:hover {
  background: red;
  color: #fff;
  text-shadow: 0 1px 2px rgba(0, 0, 0, 0.3);
}
.CardGood, .CardGood:hover {
  background: #27ae60;
  color: #fff;
  text-shadow: 0 1px 2px rgba(0, 0, 0, 0.3);
}

.form-container input.incorrectInfo {
  border: red solid 1px;
}
</style>

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
<div class="col-md-12">
<div class="panel ">
<div class="panel-heading" style="padding:0px;" ><h6 class="panel-title"><b></b></h6></div>
<div class="panel-body"  >
<div class="col-md-4">

  
</div>
    <div class="row">
        <?php   
         $user_id =  Auth::user()->id;   
         $expdata =  DB::table('user_subcriptions')->where(array('user_id'=>$user_id))->get();
           foreach($expdata as $getdata) {
             $exp_date =   $getdata->expired_date;
              }
              $newdate = date("Y-m-d", strtotime($exp_date));
                ?>
     
        <label> Your Membership expires on Date <?php echo $newdate ;  ?></label>
							
						</div>
</div></div>


	</div>

  <!-- /tasks grid -->
  <!-- Pagination -->
  
  <!-- /pagination -->
</div>
<!-- /main content -->


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
</style>

      <!-- Action buttons -->
      <!-- /action buttons -->
      
      <!-- /action buttons -->
      <!-- Assigned users -->
      
      <!-- /assigned users -->
    </div>
  </div>
  <!-- /secondary sidebar -->
  <!-- /page content -->
  <!-- Footer -->
  <!-- /footer -->
</div>
<!-- /page container -->


@endsection