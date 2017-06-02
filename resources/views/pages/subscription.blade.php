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
<div class="panel-heading"><h6 class="panel-title"><b>Membership Plans</b><?php   
         $user_id =  Auth::user()->id;   
         $expdata =  DB::table('user_subcriptions')->where(array('user_id'=>$user_id))->get();
           foreach($expdata as $getdata) {
             $exp_date =   $getdata->expired_date;
              }
              if(isset($exp_date)){
              $newdate = date("Y-m-d", strtotime($exp_date));
              }else{ 
                $newdate = date('Y-m-d',strtotime("+1 day")); 
              }
              $currentdate = date('Y-m-d');
             if($currentdate > $newdate){
              ?>
     
        <b> (Your Membership expired on Date <?php echo $newdate ;  ?>)</b>
             <?php  }  ?></h6></div>

<div class="panel-body">
<div class="col-md-4">

  <div class="panel price panel-gray" style="">
							<div class="panel-heading  text-center" >
								<h3><b>$99 (3 months) </b></h3>
								</div>
								
<!--								<ul class="list-group list-group-flush text-center">
								<li class="list-group-item">
								<i class="icon-ok text-danger"></i>
								Personal Use</li>
								<li class="list-group-item">
								<i class="icon-ok text-danger"></i>
								Unlimited Projects</li>
								<li class="list-group-item">
								<i class="icon-ok text-danger"></i>
								27/7 Support</li>
								</ul>-->
								
								<div class="panel-footer">
                                                                    <input type="radio" onclick="planinsert('99','$99 (3 months)')" name="select-box" class="select-box-radio" />
								 <a class="btn btn-lg btn-block select-btn" >SELECT</a> 
								</div>
								</div>
								
								
								
								
								
								
							</div>
							
							
							 <div class="col-md-4">
  <div class="panel price panel-gray">
							<div class="panel-heading  text-center">
								<h3><b>$149 (6 months) </b></h3>
								</div>
								
<!--								<ul class="list-group list-group-flush text-center">
								<li class="list-group-item">
								<i class="icon-ok text-danger"></i>
								Personal Use</li>
								<li class="list-group-item">
								<i class="icon-ok text-danger"></i>
								Unlimited Projects</li>
								<li class="list-group-item">
								<i class="icon-ok text-danger"></i>
								27/7 Support</li>
								</ul>-->
								
								<div class="panel-footer">
                                                                    <input type="radio" onclick="planinsert('149','$149 (6 months)')" name="select-box" class="select-box-radio"  />
                                                                    <a class="btn btn-lg btn-block select-btn" >SELECT</a>
								</div>
								</div>
								
								
								
								
								
								
							</div>
							 <div class="col-md-4">
  <div class="panel price panel-success">
							<div class="panel-heading  text-center">
								<h3><b>$199 (12 months)</b></h3>
								</div>
								
<!--								<ul class="list-group list-group-flush text-center">
								<li class="list-group-item">
								<i class="icon-ok text-danger"></i>
								Personal Use</li>
								<li class="list-group-item">
								<i class="icon-ok text-danger"></i>
								Unlimited Projects</li>
								<li class="list-group-item">
								<i class="icon-ok text-danger"></i>
								27/7 Support</li>
								</ul>-->
								
								<div class="panel-footer">
                                                                    <input type="radio" onclick="planinsert('199','$199 (12 months)')" name="select-box" class="select-box-radio"  checked="checked" />
                                                                    <a class="btn btn-lg btn-block select-btn" >SELECT</a>
								</div>
								</div>
								
								
								
								
								
								
							</div>
							
							</div>
</div>
    <div class="row">

							
						</div>
</div></div>

<div class="row">
<div class="col-md-12">
<div class="panel panel-">
<div class="panel-heading"><h6 class="panel-title"><b>Payment</b></h6></div>

<div class="panel-body">

<div class="col-md-6">
  <script src="https://js.stripe.com/v3/"></script>
<form>
 <h1 class="text-info" id="changemsg"><span id="messageshown">Single payment of $199 (12 months) membership</span></h1> 
    <hr>
    <div class="row credit-card-details">
        <div class="col-md-6">
            
            <label for="name">Name</label>
            <input type="text" name="cardholder-name" class="field is-empty form-control" value="{{ucfirst(Auth::user()->first_name)}} {{ucfirst(Auth::user()->last_name)}}" placeholder="Jane Doe"  style="width:100%"/>
         </div>
        
         <div class="col-md-6">
             <label for="name">Phone</label>
             <input style="width:100%" class="field is-empty form-control" name="cardholder-phone" value="{{Auth::user()->mobile}}" type="tel" placeholder="(123) 456-7890" />
         </div>
      
    
    <div class="row credit-card-details">
     <div class="col-md-12">
    <label for="name">Card Number</label>
    <div id="card-element" class="field is-empty form-control"></div>
    </div>
                 <div class="col-md-12 ">
    <label for="name">Coupon</label>
  <input style="width:78% ;float:left" class="field is-empty form-control" id="newcoupon"  name="coupon" value="" type="text" placeholder="Enter coupon for discount" />
  <span class="paybuttonuse"> <input type="button" style="width:20% ;float:right" class="btn btn-primary pay-button" value="Apply" onclick="apply_copoun()"/> </span>

                 </div>
        <div class="col-md-12 "><span class="copuons-message hidden"></span></div>
    </div> 
    </div>
  <div class="text-right ">
      
      
      <button type="submit" class="btn btn-primary pay-button " onclick="load_img()">Pay<i class="icon-arrow-right14 position-right"></i></button>
    
  </div>
    
  <div class="outcome">
    <div class="error"></div>
    <div class="success">
      <span class="token"></span>
    </div>
  </div>
    <input id="newamount" name="amount" value="199" type="hidden">
            <input id="newamounts" name="amounts" value="199" type="hidden">
            <input id="newplan" name="plan" value="$199(12 months)" type="hidden">
</form>  
    </body>
    <style>
 * {
  font-family: "Helvetica Neue", Helvetica;
  font-size: 15px;
  font-variant: normal;
  padding: 0;
  margin: 0;
}
.credit-card-details label {
    color: #333333;
    font-size: 14px;
    height: 31px;
    margin-left: 0;
    text-transform: uppercase;
}
.row.credit-card-details {
    margin-bottom: 20px;
}
.credit-card-details .__PrivateStripeElement {
     margin-top: -10px !important;
}
.row.credit-card-details #card-element {
    width: 100%;
}
.pay-button {
    float: right;
    width: 93px;
}
form {
  width: 480px;
  margin: 20px auto;
}

.group {
  background: white;
  box-shadow: 0 7px 14px 0 rgba(49,49,93,0.10),
              0 3px 6px 0 rgba(0,0,0,0.08);
  border-radius: 4px;
  margin-bottom: 20px;
}

label {
  position: relative;
  color: #8898AA;
  font-weight: 300;
  height: 40px;
  line-height: 40px;
  margin-left: 20px;
  display: block;
}

.group label:not(:last-child) {
  border-bottom: 1px solid #F0F5FA;
}

label > span {
  width: 20%;
  text-align: left;
  float: left;
  text-transform: uppercase;
  color:#333333;
  padding-left: 40px;
}

.field {
  background: transparent;
  font-weight: 300;
  border: 0;
  color: #31325F;
  outline: none;
  padding-right: 10px;
  padding-left: 10px;
  cursor: text;
  width: 70%;
  height: 36px;
  float: right;
  border-radius:3px;
  border: 1px solid #dddddd;
}

.field::-webkit-input-placeholder { color: #999999;opacity: 1; }
.field::-moz-placeholder { color: #999999;opacity: 1;}
.field:-ms-input-placeholder { color: #999999;opacity: 1; }

button {
  float: left;
  display: block;
  background: #666EE8;
  color: white;
  box-shadow: 0 7px 14px 0 rgba(49,49,93,0.10),
              0 3px 6px 0 rgba(0,0,0,0.08);
  border-radius: 4px;
  border: 0;
  margin-top: 20px;
  font-size: 15px;
  font-weight: 400;
  width: 100%;
  height: 40px;
  line-height: 38px;
  outline: none;
}

button:focus {
  background: #555ABF;
}

button:active {
  background: #43458B;
}

.outcome {
  float: left;
  width: 100%;
  padding-top: 8px;
  min-height: 24px;
  text-align: center;
}

.success, .error {
  display: none;
  font-size: 13px;
}

.success.visible, .error.visible {
  display: inline;
}

.error {
  color: #E4584C;
}

.success {
  color: #666EE8;
}

.success .token {
  font-weight: 500;
  font-size: 20px;
}  </style>
    
    
    <script>
        var stripe = Stripe('pk_test_xZEBsa3JyHNJonOsJuXR4N7M');
var elements = stripe.elements();

var card = elements.create('card', {
  style: {
    base: {
      iconColor: '#666EE8',
      color: '#31325F',
      lineHeight: '40px',
      fontWeight: 300,
      fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
      fontSize: '15px',

      '::placeholder': {
        color: '#333333',
      },
    },
  }
});
card.mount('#card-element');

function setOutcome(result) {
  var successElement = document.querySelector('.success');
  var errorElement = document.querySelector('.error');
  successElement.classList.remove('visible');
  errorElement.classList.remove('visible');
console.log(result);
  if (result.token) {
    // Use the token to create a charge or a customer
    // https://stripe.com/docs/charges
  
   var amount=$("#newamount").val();
   var amounts=$("#newamounts").val();
   var plan=$("#newplan").val();
  var coupon=$("#newcoupon").val();
   if(coupon==''){
       coupon='0';
   }
         $.get('/stripe',{token: result.token.id,amount:amount,amounts:amounts,plan:plan,coupon:coupon}, function (data){
          if(data){
              $( "#loading-img" ).html('');
               var temp = plan.split("(");
               var message='Payment of $'+amount+' ('+temp[1]+' membership was SUCCESSFULL';
              // successElement.querySelector('.token').textContent = message;
              //  successElement.classList.add('visible');
               $("#messageshown").html(message);
                $("#changemsg").removeClass('text-info');
                $("#changemsg").addClass('text-success');
                $(".is-empty").val('');
                var delay = 5000; 
                setTimeout(function(){ window.location = ('/'); }, delay);
               
          }
            }); 
  } else if (result.error) {
    errorElement.textContent = result.error.message;
    errorElement.classList.add('visible');
    $( "#loading-img" ).html('');
  }
}

card.on('change', function(event) {
  setOutcome(event);
});

document.querySelector('form').addEventListener('submit', function(e) {
  e.preventDefault();
  var form = document.querySelector('form');
  var extraDetails = {
    name: form.querySelector('input[name=cardholder-name]').value,
    phone: form.querySelector('input[name=cardholder-phone]').value,
  };
  stripe.createToken(card, extraDetails).then(setOutcome); 
});
function planinsert(amount,plan){
    var amnt=amount;
	
    var plan=plan;
  
   $("#messageshown").html('');
   $("#newamount").val(amnt);
   $("#newplan").val(plan);
   var messageshown='Single payment of ' +plan+ ' membership';
    $("#messageshown").html(messageshown);
}
 function apply_copoun() {
      var amount=$("#newamount").val();
  
   var plan=$("#newplan").val();
  
   var coupon=$("#newcoupon").val();
   if(coupon==''){
       $("#newcoupon").focus();
       coupon='0';
   }else{
         $.get('/copoun_apply',{amount:amount,plan:plan,coupon:coupon}, function (data){
          if(data!='notworking'){
                var tmp = data.split(",");
                 
                var temp = plan.split("(");
             
           var message='Single payment of $'+tmp[0]+' ('+temp[1]+' membership with '+tmp[1]+'% discount';
           $('#messageshown').html('');
          
             $("#changemsg").addClass('text-info');
             $("#changemsg").removeClass('text-success');
             $("#changemsg").removeClass('text-danger');
             $('#messageshown').html(message);
           //$('.copuons-message').removeClass('hidden');
          // $('.copuons-message').addClass('text-success');
           $("#newcoupon").val('');
           $('.paybuttonuse').html('');
           
           $("#newamount").val(tmp[0]);
              }
           if(data=='notworking'){
           var message='Invalid Coupon!';
           $('#messageshown').html('');
          
             $("#changemsg").removeClass('text-info');
             $("#changemsg").removeClass('text-success');
             $('#changemsg').addClass('text-danger');
             $('#messageshown').html(message);
           
              } 
              }); 
          }      
 }
 function cal(){
	 var amount=$("#newamount").val();
     var coupon=$("#newcoupon").val(); 
	alert(coupon);
 }

function load_img(){
$( "#loading-img" ).html(loader);
}
    </script>
  </div>
	</div>
	
	<div class="col-md-6">
<div class='card-wrapper'></div>
</div>
	</div>
	</div>
	</div>
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