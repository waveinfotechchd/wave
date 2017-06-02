@extends("admin.admin_app")
    
@section("content")
     
<style>
.label-info
{

color:#00BCD4;
font-size:14px;
border:none;
background:none;
}
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
.col-md-1 button
{
margin-top: 5px;
margin-bottom: 5px;
}
.col-md-1 
{
text-align:center;
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
.col-md-4
{

text-align:center;
}   
.col-md-4 button
{

margin-bottom:5px;
margin-top:5px;
}   

.tab-content > .tab-pane {
  display:block;height:313px;overflow-y:scroll;  
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
<!-- Page header -->
<div class="page-header">
    <div class="page-header-content">
        <div class="page-title">
            
        </div>
        
    </div>
</div>
<script type="text/javascript">
  function invitesfilter(keys,types){
      //alert(keys);
  $.get('./paymentfilters',{key:keys,type:types}, function (data){
    if(data){  
       // alert(data);
        $('#loaded_user').html(''); 
        $('#loaded_user').html(data);  
    }
    });
}function invitesfilter2(){
      
   var dt=$('#datepicker').text(); 
   var types='sendafter'
  $.get('./paymentfilters',{key:dt,type:types}, function (data){
    if(data){  
        
        $('#loaded_user').html(''); 
        $('#loaded_user').html(data);  
    }
    });
}
function invitesfilter3(){
      
  
   var dt=$('#date').text(); 
var types='sendbefore'
  $.get('./paymentfilters',{key:dt,type:types}, function (data){
    if(data){  
       // alert(data);
        $('#loaded_user').html(''); 
        $('#loaded_user').html(data);  
    }
    });
}

</script>
<!-- /page header -->
<!-- Page container -->
<div class="page-container">
    <!-- Page content -->
    <div class="page-content">
        <!-- Main content -->
        <div class="content-wrapper">
            <!-- Large size -->
            <div class="navbar navbar-default navbar-xs navbar-component">
                <ul class="nav navbar-nav no-border visible-xs-block">
                    <li><a class="text-center collapsed" data-toggle="collapse" data-target="#navbar-filter"><i class="icon-menu7"></i></a></li>
                </ul>
                
                
                <div class="navbar-collapse collapse" id="navbar-filter">
                    <p class="navbar-text">Filter:</p>
                    <ul class="nav navbar-nav">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-sort-time-asc position-left"></i> City <span class="caret"></span></a>
                          <ul class="dropdown-menu" style="overflow-y:auto;height:300px">
									@foreach(\App\Cities::orderby('id')->where('status','Active')->get() as $city)
									<li><a href="javascript:void(0);" onclick="invitesfilter('{{$city->city}}','city')">{{$city->city}}</a></li>
                                                                        @endforeach
									
								</ul>
                        </li>
                        
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-sort-amount-desc position-left"></i> Username <span class="caret"></span></a>
                            <ul class="dropdown-menu" style="overflow-y:auto;height:300px">
									@foreach(\App\User::orderby('id')->get() as $User)
									<li><a href="javascript:void(0);" onclick="invitesfilter('{{$User->first_name}}','username')">{{$User->first_name}}</a></li>
                                                                        @endforeach
									
								</ul>
                        </li>
                        
                          <li>
                            
                        <td><a href="#" id="datepicker"  data-placement="bottom" data-type="date" data-viewformat="dd.mm.yyyy" data-pk="1" >Send After</a>  
                            <a href="javascript:void(0);" onclick="invitesfilter2()"><i class="icon-check position-left"></i>click</a></td>
                        
                        </li>
                        <li>
                            
                        <td><a href="#" id="date" data-placement="bottom"data-type="combodate" data-pk="1" data-value="1984-05-15" data-format="YYYY-MM-DD" data-viewformat="DD/MM/YYYY" data-template="D - MMM - YYYY" >Send Before</a>
                          <a href="javascript:void(0);" onclick="invitesfilter3()"><i class="icon-check position-left"></i>click</a>   
                        </td>
                        
                     
                        </li>
                        
                        
                        
                    </ul>
                    
                    <div class="navbar-right">
                        
                        
                    </div>
                </div>
            </div>
            <!-- /tasks options -->
            
            
            <label class="checkbox-inline checkbox-switchery checkbox-right switchery-xs" style="display:none;">
                <input type="checkbox" class="switchery" checked="checked">
                
                
                </div>
                
                </div>
                
               <div class="row"style="margin-right:0px;">
 
        <div class="col-md-12">
          <div class="panel panel-flat">
            <div class="panel-heading">
              <h6 class="panel-title" style="font-size: 18px;    text-align: -webkit-left;">Payments
</h6>
              <div class="heading-elements">
                <ul class="icons-list">
                  <li><a data-action="collapse"></a></li>
                  <li><a data-action="reload"></a></li>
                  <li><a data-action="close"></a></li>
                </ul>
              </div>
            </div>
            <div class="panel-body">
			 <div class="tabbable">
          
				 <div class="tab-content">
                  <div class="tab-pane" style="">
				<div class="row hidden-sm hidden-xs" >
				<div class="col-md-2">
				<h5>Date</h5>
				</div>
				<div class="col-md-2">
				<h5>Payment Id</h5>
				</div>
				<div class="col-md-1">
				<h5>Order Id</h5>
				</div>
				<div class="col-md-1">
				<h5>Amount</h5>
				</div>
				<div class="col-md-2">
				<h5>Name</h5>
				</div>
                                <div class="col-md-1">
				<h5>Coupon</h5>
				</div>    
				<div class="col-md-1">
				<h5>Status</h5>
				</div>
				<div class="col-md-2">
				<h5>Action</h5>
				</div>
				
				
				</div>
                      <div id='loaded_user'>
				@foreach($payments as $user)
                                              @foreach(\App\User::where('id',$user->user_id)->get() as $field)
				<div class="row">
				<div class="col-md-2">
			<h6><span class="label label-info">{{$user->created_at}}</span></h6>
				</div>
				<div class="col-md-2">
				<h6>{{$user->txn_id}}</h6>
				</div>
				<div class="col-md-1">
				<h6>{{$user->order_id}}</h6>
				</div>
				<div class="col-md-1">
				<h6>{{$user->amount}}</h6>
				</div>
				
				<div class="col-md-2">
				<h6>{{$field->first_name}} {{$field->last_name}}</h6>
				</div>
				<div class="col-md-1">
				<h6>@if($user->coupon!='0')<span class="label label-success">{{$user->coupon}}</span>@endif</h6>
				</div>
				
				<div class="col-md-1">
				<h6><span class="label label-success">{{$user->status}}</span></h6>
				</div>
					<div class="col-md-2">
                                          @if($user->status=='Refunds')
				<a href="JavaScript:Void(0);" class="btn btn-primary btn-xs" >
				<i class="icon-check position-left"></i>Refund</a>
                                @else
                                <a href="{{URL::to('admin/payments_refunds/'.$user->id.'/'.$user->txn_id.'/'.$user->user_id)}}" class="btn btn-primary btn-xs" >
				<i class="icon-check position-left"></i>Refund</a>
                                @endif
				</div>
				
				</div>
				
				@endforeach
                                @endforeach
				</div>
				</div>
				
				
				
				
				
			</div>
              </div>
            </div>
          </div>
		   <!-- /panel 1 ends here  -->
		   
		   
		    
  <!-- /profile info -->



  
  
 

</div>
  </div>
        </div>
        @endsection