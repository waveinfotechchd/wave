@extends("admin.admin_app")

@section("content")
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
.col-md-2 button
{
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
.label-success {
background:none;
border:none;
font-size:14px;
    color: #4CAF50;
padding:0px;
}
.label-info {
background:none;
border:none;
font-size:14px;
    color: #00BCD4;
}
.label-danger {
background:none;
border:none;
font-size:14px;
   color: #F44336;
}
.label-default {
background:none;
border:none;
font-size:14px;
   color: #999999;
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
  display:block;height:313px;overflow-y:scroll;  
}

.nav > li > a
{
float:center;

}

.row {
  
  margin-left: opx;
     
margin-right: 10px;	 
}

.col-md-12
{
height: 62px;
margin-top:1%;
}
.col-sm-8
{
padding-left:9px;

}
.au
{
float:left;
}
.user{
font-size:15px;
border:0px;
margin:0px;
padding:0px;
margin-bottom:5%;
}
.user1{
margin-top: 0%;border: 1px solid #ddd;
margin-left:0px;
margin-right:0px;
margin-top:0px;
font-size:15px;
margin-bottom: 1%;
padding:0px;

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
  function messagefilter(keys,types){
  $.get('./message_filters',{key:keys,type:types}, function (data){
    if(data){  
       // alert(data);
        $('#loaded_user').html(''); 
        $('#loaded_user').html(data);  
    }
    });
}
  function messagefilter2(){
      var user2=$('#getusername2').val(); 
      var user1=$('#getusername1').val(); 
      var types='username';
      if(user1!=''){
          $('#show_required').addClass('hidden'); 
      if(user2.length>=4){
          
  $.get('./message_filters',{username1:user1,username2:user2,type:types}, function (data){
    if(data){  
       // alert(data);
        $('#loaded_user').html(''); 
        $('#loaded_user').html(data);  
    }
    });
      }
      }else{
           $('#show_required').removeClass('hidden'); 
      }
}
function invitesfilter2(){
      
   var dt=$('#datepicker').text(); 
   var types='sendafter'
  $.get('./message_filters',{key:dt,type:types}, function (data){
    if(data){  
        
        $('#loaded_user').html(''); 
        $('#loaded_user').html(data);  
    }
    });
}
function invitesfilter3(){
      
  
   var dt=$('#date').text(); 
var types='sendbefore'
  $.get('./message_filters',{key:dt,type:types}, function (data){
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
								<ul class="dropdown-menu">
									@foreach(\App\Cities::orderby('id')->where('status','Active')->get() as $city)
									<li><a href="javascript:void(0);" onclick="messagefilter('{{$city->city}}','city')">{{$city->city}}</a></li>
                                                                        @endforeach
								</ul>
							</li>
							<li>
<td><a href="#" id="datepicker" data-placement="bottom" data-type="date" data-viewformat="dd.mm.yyyy" data-pk="1" >After Date</a><a href="javascript:void(0);" onclick="invitesfilter2()"><i class="icon-check position-left"></i>click</a></td>
<label class="checkbox-inline checkbox-switchery checkbox-right switchery-xs" style="display:none;">
<input type="checkbox" class="switchery" checked="checked">
							</li>
							<li>
<td><a href="#" id="datepicker" data-type="combodate"data-placement="bottom" data-pk="1" data-value="1984-05-15" data-format="YYYY-MM-DD" data-viewformat="DD/MM/YYYY" data-template="D - MMM - YYYY" >Before Date</a><a href="javascript:void(0);" onclick="invitesfilter3()"><i class="icon-check position-left"></i>click</a></td>
						</li>
						</ul>
						<div class="navbar-right">
						</div>
					</div>
				</div>
				<!-- /tasks options -->
				
       <div class="row"style="margin-right:0px;">
 
	  <div class="panel panel-flat" style="width: 99%;
    margin-left: 1%;" >

  <div class="panel-body">
  <form action="#">
  <div class="form-group" style="margin-bottom:0px;">
  <div class="row user" style="margin-bottom:0px;">
  <div class="col-md-6">
  <label>Team</label>
  <input type="text" value=""  placeholder="Team" id="getteam" class="form-control">
   <p class="text-danger hidden" id="show_required">Please enter username2</p>
  </div>
  <div class="col-md-3">
  <label>Between Users</label>
  <input type="text" value=""  placeholder="Username1" id="getusername1" class="form-control">
  <p class="text-danger hidden" id="show_required">Please enter username1</p>
  </div>
  <div class="col-md-3">
  <label></label>
  <input type="text" value="" onkeyup="messagefilter2()" placeholder="Username2" id="getusername2" class="form-control">
  </div>
  </div>
  </div>

  </form>
  </div>
  </div>
	  </div>
      <!-- /large size -->
	  <!-- start panel for conversation -->
	  <div class="panel panel-flat" style="overflow-y:scroll;height:400px;">
	  <div class="panel-body">
              <div id='loaded_user'>
              @foreach($UserConversations as $convertion)
        @foreach(\App\User::where('id',$convertion->to_user_id)->get() as $touser)
      @foreach(\App\User::where('id',$convertion->user_id)->get() as $fromuser)
	  <div class="row user1" style="">
	  <div class="col-md-12">
	  <div class="col-md-4">
	  <p>{{$convertion->created_at}}, {{ucfirst($fromuser->first_name)}} {{ucfirst($fromuser->last_name)}} to {{ucfirst($touser->first_name)}} {{ucfirst($touser->last_name)}}</p>
	  <p><span class="label label-success">@foreach(\App\UserTeam::where('user_id',$convertion->user_id)->where('to_user_id',$convertion->to_user_id)->limit(1)->get() as $team)Team :{{$team->team_name}} @endforeach @foreach(\App\UserTeam::where('to_user_id',$convertion->user_id)->where('user_id',$convertion->to_user_id)->limit(1)->get() as $team)Team :{{$team->team_name}} @endforeach</span></p>
	  </div>
	  <div class="col-md-6">
	  <p>{{$convertion->message}}</p>
	  </div>
	  
	  <div class="col-md-2">
<div class="col-sm-4 text-left">
	   <a href="#"  class="au"><u>Hide</u></a><br/>
</div>
<div class="col-sm-8 text-right">
	   <a href="#" class="au"><u>Suspend Sender</u></a>
</div>
	  </div>
	  
	  </div>
	  </div>
              @endforeach
             @endforeach
	     @endforeach
             
	   {!! $UserConversations->render() !!}
            </div>
	  </div>
	  </div>
	  
		<!-- /inside accordion -->
	  
    </div>
    <!-- /main content -->
  </div>
  <!-- /page content -->
  <!-- Footer -->
  <!-- /footer -->
</div>
<!-- /page container -->
@endsection