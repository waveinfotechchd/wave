@extends("app")
@section('head_title', 'Shortlists | '.getcong('site_name') )
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

.tab-content > .tab-pane {
  display:block;height:313px;overflow-y:scroll;  
}
.row {
  
  margin-left: opx;
     
margin-right: 10px;	 
}

.label-info {
    color: #00BCD4;
background:none;
border:none;
font-size:13px;
}
.label-default {
    color: #999999;
background:none;
border:none;
font-size:13px;
}
.label-success {
   color: #4CAF50;
background:none;
border:none;
font-size:13px;
}
.label-primary {
    color: #2196F3;
background:none;
border:none;
font-size:13px;
}

.label-2 {
    color: violet;
background:none;
border:none;
font-size:13px;
}
.col-md-3
{

text-align:center;
}
.col-md-3 button
{

margin-top:5px;
margin-bottom:5px;
}
.tool{

margin-left:2%;
}

	</style>
<!-- Page header -->
<div class="page-header">
  <div class="page-header-content">
    <div class="page-title">
      
    </div>
    <!--<div class="heading-elements">
				<div class="heading-btn-group">
					<a href="#" class="btn btn-link btn-float has-text"><i class="icon-bars-alt text-primary"></i><span>Statistics</span></a>
					<a href="#" class="btn btn-link btn-float has-text"><i class="icon-calculator text-primary"></i> <span>Invoices</span></a>
					<a href="#" class="btn btn-link btn-float has-text"><i class="icon-calendar5 text-primary"></i> <span>Schedule</span></a>
				</div>
			</div>-->
  </div>
</div>
<!-- /page header -->
<!-- Page container -->
<div class="page-container">
  <!-- Page content -->
  <div class="page-content">
    <!-- Main content -->
    <div class="content-wrapper">
      <!-- Large size -->
      <div class="row" style="margin-right:0px;">
 
        <div class="col-md-12">
          <div class="panel panel-flat">
            <div class="panel-heading">
              <h6 class="panel-title" style="font-size: 18px;    text-align: -webkit-left;">Shortlist for {{ucFirst(Auth::user()->first_name) }} TEAM
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
                  <div class="tab-pane" style="">@if(isset($shortlist))
				<div class="row hidden-sm hidden-xs" >
				
				<div class="col-md-2">
				<h5>Name</h5>
				</div>
				
				<div class="col-md-2">
				<h5>Role</h5>
				</div>
				<div class="col-md-2">
				<h5>Legal</h5>
				</div>
				<div class="col-md-3"> 
				<h5>Contact</h5>
				</div>
				<div class="col-md-3">
				<h5>Action</h5>
				</div>
				</div>
                                 <?php $gh=0; ?>
				@foreach($shortlist as $lists)
                                  @foreach(\App\User::where('id',$lists->to_user_id)->orderBy('id')->get() as $field)
                                   @foreach(\App\UserSearch::where('user_id',$lists->to_user_id)->get() as $status)
				<div class="row">
				
				<div class="col-md-2">   
				<h6>{{$field->first_name}} {{$field->last_name}}</h6>
				</div>
				
				<div class="col-md-2">
				<h6>{{$field->position}}</h6>
				</div>
				
				<div class="col-md-2">
				<h6>{{$field->company}}</h6>
				</div>
				<div class="col-md-3">
				<ul class="icons-list">
                                <li ><a href="#" ><i class="icon-comment-discussion pull-right"></i> </a></li>
<!--                                <li ><a href="#" ><i class="icon-phone2 pull-right"></i> </a></li>
                                <li ><a href="#" ><i class="icon-mail5 pull-right"></i> </a></li>-->
                              </ul>
				</div>
				<div class="col-md-3">
                                    <?php $offercount=\App\UserOffers::where('to_user_id',$lists->to_user_id)->count() ;?>
                                    @if($offercount>0)
                                    <button type="button" 
				class="btn btn-danger btn-xs" onclick="createTeamFunction({{$lists->id}},'CANCELLED','Sent')" ><i class="icon-cross position-left">
				</i>Cancel offer</button>
                                    <button type="button" 
				class="btn btn-danger btn-xs" onclick="createTeamFunction({{$lists->id}},'Removed','Sent')" onclick="return confirm('Are you sure? You will not be able to recover this.')"><i class="icon-cross position-left">
				</i>Remove</button>
                                    @else
                               @if($status->search_status=='SEEKING')
                               <button type="button" class="btn btn-success btn-xs"  data-toggle="modal" data-target="#myModal<?php echo $gh; ?>">
				<i class="icon-check position-left"></i>Offer</button>
                                 <button type="button" 
				class="btn btn-danger btn-xs" onclick="createTeamFunction({{$lists->id}},'Removed','Sent')" onclick="return confirm('Are you sure? You will not be able to recover this.')"><i class="icon-cross position-left">
				</i>Remove</button>
                                <!-- Modal -->
                                    <div id="myModal<?php echo $gh; ?>" class="modal fade" role="dialog">
                                      <div class="modal-dialog">

                                        <!-- Modal content-->
                                        <div class="modal-content"> 
                                          <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">Offer To {{$field->first_name}} {{$field->last_name}}</h4>
                                          </div>
                                          <div class="modal-body">
                                             {!! Form::open(array('url' => 'users/offer_message','class'=>'','method'=>'post','role'=>'form' )) !!}
                                             <input type="hidden" name="to_user_id" value="{{$field->id}}">
                                        <div class="form-group">
                                           
                                            <div class="col-md-12" style="margin-top: 2%;">
                                                    <label><strong>Message</strong></label>
                                                    <textarea rows="3" class="form-control" placeholder="Message" name="message" required="required"></textarea>
                                        
                                        </div>
                                           
                                          <div class="modal-footer">
                                           <div class="text-right">
                                            <button type="submit" class="btn btn-primary">Send<i class="icon-arrow-right14 position-right"></i></button>
                                        </div>
                                        {!! Form::close() !!} 
                                          </div>
                                        </div>

                                      </div>
                                    </div> 
                                        <!-- Modal --> 
                                
                               @elseif($status->search_status=='COMMITTED')
                               
                               @else
                               <button type="button" 
				class="btn btn-danger btn-xs" onclick="createTeamFunction({{$lists->id}},'Removed','Sent')"><i class="icon-cross position-left">
				</i>Remove</button>
                               @endif
				
                 
				</div>
				
				</div>
                                     @endif 
                                    <?php  $gh++; ?>
                                   @endforeach
				@endforeach
                                @endforeach
				
				</div>
				
				@endif
				
			</div>
              </div>
            </div>
          </div>
                <button type="button" class="hidden clickme" data-toggle="modal" data-target="#myModal"></button>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" onClick="window.location.reload()">&times;</button>
      </div>
      <div class="modal-body message">
        
      </div>
      
    </div>

  </div>
</div> 
    <!-- Modal -->    
		   <!-- /panel 1 ends here  -->
		            <div class="panel panel-flat">
            <div class="panel-heading">
              <h6 class="panel-title" style="font-size: 18px;    text-align: -webkit-left;">
			  Teams you are shortlisted for

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
                  <div class="tab-pane" style="display:block;">
				<div class="row hidden-sm hidden-xs" >
				<div class="col-md-2">
				<h5>Team</h5>
				</div>
				<div class="col-md-2">
				<h5>Name</h5>
				</div>
				
				<div class="col-md-2">
				<h5>Role</h5>
				</div>
				<div class="col-md-2">
				<h5>Legal</h5>
				</div>
				<div class="col-md-2">
				<h5>Contact</h5>
				</div>
				<div class="col-md-2">
				<h5></h5>
				</div>
				</div>
				@foreach($shortlisted as $lists)
                                  @foreach(\App\User::where('id',$lists->user_id)->orderBy('id')->get() as $field)
                                  @foreach(\App\UserSearch::where('user_id',$lists->user_id)->get() as $status)
				<div class="row">
				<div class="col-md-2">
				<h6>{{$field->first_name}} Team</h6>
				</div>
				<div class="col-md-2">
				<h6>{{$field->first_name}} {{$field->last_name}}</h6>
				</div>
				
				<div class="col-md-2">
				<h6>{{$field->position}}</h6>
				</div>
				
				<div class="col-md-2">
				<h6>{{$field->company}}</h6>
				</div>
				<div class="col-md-2">
				<ul class="icons-list">
              <li ><a href="#" ><i class="icon-comment-discussion pull-right"></i> </a></li>
<!--              <li ><a href="#" ><i class="icon-phone2 pull-right"></i> </a></li>
              <li ><a href="#" ><i class="icon-mail5 pull-right"></i> </a></li>-->
            </ul>
				</div>
				<div class="col-md-2">
                                @if($status->search_status=='COMMITTED')
				<button type="button" 
				class="btn btn-danger btn-xs" onclick="createTeamFunction({{$lists->id}},'DECLINED','Recieve')"><i class="icon-cross position-left">
				</i>Decline</button>
                               @else
                               <button type="button" class="btn btn-success btn-xs " onclick="createTeamFunction({{$lists->id}},'ACCEPTED','Recieve')">
				<i class="icon-check position-left" ></i>Accept</button>
				<button type="button" 
				class="btn btn-danger btn-xs" onclick="createTeamFunction({{$lists->id}},'DECLINED','Recieve')" ><i class="icon-cross position-left">
				</i>Decline</button>
                               @endif
				</div>
				</div>
                                  @endforeach
				@endforeach
                                @endforeach
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
<!-- /page container -->


@endsection