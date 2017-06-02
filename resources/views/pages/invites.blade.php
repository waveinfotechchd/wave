@extends("app")
@section('head_title', 'Invites | '.getcong('site_name') )
@section('head_url', Request::url())
@section("content")
@include("_particles.user_sidebar")
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
.col-md-3 button
{
margin-top: 5px;
margin-bottom: 5px;
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
	.icons-list > li > a > i {
    font-size: 20px;
}
.col-md-2 button
{
Width:75%;
}
.label-success {
font-size: 14px;
    background: none;
    color: #4CAF50;
    border: none;
}
.label-default {
border: none;
font-size: 14px;
    background: none;
   color: #999999;
}
.label-danger {
border: none;
font-size: 14px;
    background: none;
    color: #F44336;
}
.tool
{

margin-left:2%;
}

.label-info {
border: none;
font-size: 14px;
background: none;
color: #00BCD4;
}
	</style>
        
<div class="page-container">
  <!-- Page content -->
  <div class="page-content">
    <!-- Main content -->
    <div class="content-wrapper">
      <!-- Large size -->
      <div class="row">
 <div class="col-md-2">
</div>
        <div class="col-md-8">
          <div class="panel panel-flat">
            <div class="panel-heading">
              <h6 class="panel-title" style="font-size: 18px;">Invitations</h6>
              <div class="heading-elements">
                <ul class="icons-list">
                  <li><a data-action="collapse"></a></li>
                  <li><a data-action="reload"></a></li>
                  <li><a data-action="close"></a></li>
                </ul>
              </div>
            </div>
<button type="button" class="hidden clickme" data-toggle="modal" data-target="#myModal"></button>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog sd">
    <!-- Modal content-->
    <div class="modal-content sdf">
      <div class="modal-body ">
        <button type="button" class="close" data-dismiss="modal" onClick="window.location.reload()">&times;</button>
        <div class="message">
      </div>
      </div>
    </div>
  </div>
</div> 
    <!-- Modal -->     
            <div class="panel-body">
			 <div class="tabbable">
          <ul class="nav nav-lg nav-tabs nav-tabs-solid nav-tabs-component nav-justified" style="">
             
<li  class="active"><a href="#large-justified-tab2" data-toggle="tab"><i class="icon-menu7 position-left"></i> Received<span class="badge badge-success position-right">{{$recived_count}}</span></a></li>
<li><a href="#large-justified-tab1" data-toggle="tab"><i class="icon-menu7 position-left"></i> Sent<span class="badge badge-success position-right">{{$sent_count}}</span></a></li>
                </ul>
				 <div class="tab-content">
				 <div class="tab-pane active" id="large-justified-tab2">
                                     @if($recived_count>0)
				<div class="row hidden-sm hidden-xs" >
				<div class="col-md-2">
				<h5>Name</h5>
                                    
				</div>
				<div class="col-md-3">
				<h5>Seeking Role</h5>
				</div>
				<div class="col-md-2">
				<h5>Match</h5>
				</div>
				
				<div class="col-md-2">
				<h5>Invite</h5>
				</div>
				<div class="col-md-3">
				


				</div>
				</div>
                                     @endif
				@foreach($recived_invites as $rec_invites )
                                	  @foreach(\App\User::where('id',$rec_invites->user_id)->orderBy('id')->get() as $field)
				<div class="row">
				<div class="col-md-2">
				<h6>{{$field->first_name}} {{$field->last_name}}</h6>
				</div>
				<div class="col-md-3">
				<h6>{{$field->position}}</h6>
				</div>
				<div class="col-md-2">
				  
                                    <h6>Perfect Match</h6>
                                   
				</div>
                                    
                                    <?php  
                                  $id = Auth::user()->id; 
                                $data =  DB::table('user_subcriptions')->where('user_id',$id)->get();
                               foreach($data as $datas){
                                 $exp_dated =  $datas->expired_date ;
                               } 
                          $current_date=date('Y-m-d H:i:s');
                                    if(empty($exp_dated)){
                                        $exp_dated = '';
                                   }
     ?>
                                    
				 <?php $exp_date=date('Y-m-d H:i:s'); 
                                   ?>
                                       <div class="col-md-3"style="text-align:center">
                                     @if(Auth::user()->status=='MEMBER' && $current_date<$exp_dated)
                                     @if($rec_invites->status=='CANCELLED')
                                     @elseif($exp_date>$rec_invites->expired_date)
                                     @elseif($rec_invites->status=='DECLINED')
                                     <button type="button" 
				class="btn btn-success btn-xs" onclick="shorlistsFunctions({{$rec_invites->id}},'ACCEPTED','Recieve','{{$field->first_name}}')"><i class="icon-check position-left">
				</i>Accept</button>
                                      @elseif($rec_invites->status=='ACCEPTED')
                                   <button type="button" 
				class="btn btn-danger btn-xs" onclick="shorlistsFunctions({{$rec_invites->id}},'DECLINED','Recieve','{{$field->first_name}}')" ><i class="icon-cross position-left">
				</i>Decline</button>
                                     @else
				<button type="button" 
				class="btn btn-success btn-xs" onclick="shorlistsFunctions({{$rec_invites->id}},'ACCEPTED','Recieve','{{$field->first_name}}')"><i class="icon-check position-left">
				</i>Accept</button>
                                    <button type="button" 
				class="btn btn-danger btn-xs" onclick="shorlistsFunctions({{$rec_invites->id}},'DECLINED','Recieve','{{$field->first_name}}')" ><i class="icon-cross position-left">
				</i>Decline</button>
                                    @endif
                                     @else
                                         <a href="{{ URL::to('subscription') }}" type="button" class="btn btn-primary btn-xlg">
                                        Subscribe</a>
                                         @endif
				</div>
				<div class="col-md-2" style="text-align:center">
				<ul class="icons-list">
               @if(Auth::user()->status=='MEMBER')
               @if($rec_invites->status=='ACCEPTED')
                                    <li ><a href="{{URL::to('conversation')}}" ><i class="icon-comment-discussion pull-right"></i> </a></li>
                                    @endif
                   
                            @endif                   
<!--              <li ><a href="#" ><i class="icon-phone2 pull-right"></i> </a></li>
              <li ><a href="#" ><i class="icon-mail5 pull-right"></i> </a></li>-->
            </ul>
				</div>
				</div>
			        @endforeach
                                      @endforeach
				</div>
                  <div class="tab-pane" id="large-justified-tab1">
				                         @if($sent_count>0)
				<div class="row hidden-sm hidden-xs" >
				<div class="col-md-2">
				<h5>Name</h5>
				</div>
				<div class="col-md-3">
				<h5>Seeking Role</h5>
				</div>
				<div class="col-md-2">
				<h5>Match</h5>
				</div>
				
				<div class="col-md-3">
				 <h5>Invite</h5>
				</div>
				<div class="col-md-2">
				
                                

				</div>
				</div>
                                     @endif
				@foreach($sent_invites as $sent_invite )
                               @foreach(\App\User::where('id',$sent_invite->to_user_id)->orderBy('id')->get() as $field)
				<div class="row">
				<div class="col-md-2">
				<h6>{{$field->first_name}} {{$field->last_name}}</h6>
				</div>
				<div class="col-md-3">
				<h6>{{$field->position}}</h6>
				</div>
				<div class="col-md-2">
                                    <h6>Perfect Match</h6>
				</div>
                                  <?php $exp_date=date('Y-m-d H:i:s'); 
                                   ?>
				<div class="col-md-3"style="text-align:center">
				@if(Auth::user()->status=='MEMBER')
                                  
                                     @if($sent_invite->status=='DECLINED')
                                     @elseif($exp_date>$sent_invite->expired_date)
                                   
                                      @elseif($sent_invite->status=='ACCEPTED')
                                   <button type="button" 
				class="btn btn-danger btn-xs" onclick="shorlistsFunctions({{$sent_invite->id}},'CANCELLED','Sent','{{$field->first_name}}')"><i class="icon-cross position-left">
				</i>Cancel</button>
                                     @else
				  <button type="button" 
				class="btn btn-danger btn-xs" onclick="shorlistsFunctions({{$sent_invite->id}},'CANCELLED','Sent','{{$field->first_name}}')"><i class="icon-cross position-left">
				</i>Cancel</button>
                                    @endif 
                                     @else
                                         <a href="{{ URL::to('subscription') }}" type="button" class="btn btn-primary btn-xlg">
                                        Subscribe</a>
                                         @endif
				</div>
				<div class="col-md-2" style="text-align:center">
				<ul class="icons-list">
                                     @if(Auth::user()->status=='MEMBER')
                                    @if($sent_invite->status=='ACCEPTED')
                                    <li ><a href="{{URL::to('conversation')}}" ><i class="icon-comment-discussion pull-right"></i> </a></li>
                                    @endif
                                    @endif
<!--                                    <li ><a href="#" ><i class="icon-phone2 pull-right"></i> </a></li>
                                    <li ><a href="#" ><i class="icon-mail5 pull-right"></i> </a></li>-->
                                </ul>
				</div> 
				</div>
				  @endforeach  @endforeach
				</div>
				 
			</div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- /large size -->
    </div>
    <!-- /main content -->
  </div>
  <!-- /page content -->
  <!-- Footer -->
  <!-- /footer -->
</div>


@endsection