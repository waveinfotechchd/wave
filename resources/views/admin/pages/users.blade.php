@extends("admin.admin_app")

@section("content")
<!-- Page header -->
<div class="page-header">
    <div class="page-header-content">
        <div class="page-title">
            
        </div>
            
    </div>
</div>
<!-- /page header -->
<script type="text/javascript">
  function userfilter(keys,types){
    $.get('./userfilter',{key:keys,type:types}, function (data){
    if(data){  
       // alert(data);
        $('#loaded_user').html(''); 
        $('#loaded_user').html(data);  
    }
    });
}
</script>
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
									<li><a href="javascript:void(0);" onclick="userfilter('{{$city->city}}','city')">{{$city->city}}</a></li>
                                                                        @endforeach
									
								</ul>
							</li>

							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-sort-amount-desc position-left"></i> Role <span class="caret"></span></a>
								<ul class="dropdown-menu">
									
									@foreach(\App\Fieldsets::where('field_type','role')->get() as $role)
									<li><a href="javascript:void(0);" onclick="userfilter('{{$role->field_value}}','role')">{{$role->field_value}}</a></li>
                                                                        @endforeach
									
								</ul>
							</li>

							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-sort-numeric-asc position-left"></i> Membership Status								<span class="caret"></span></a>
								<ul class="dropdown-menu">
                                                                <li><a href="javascript:void(0);" onclick="userfilter('NEW','status')">NEW</a></li>
                                                                <li><a href="javascript:void(0);" onclick="userfilter('MEMBER','status')">MEMBER</a></li>
                                                                <li><a href="javascript:void(0);" onclick="userfilter('SUSPENDED','status')">SUSPENDED</a></li>
                                                                <li><a href="javascript:void(0);" onclick="userfilter('EXPIRED','status')">EXPIRED</a></li>
								</ul>
							</li>
						</ul>

						<div class="navbar-right">
							
							
						</div>
					</div>
				</div>
				<!-- /tasks options -->
				
				
       <div class="row"style="margin-right:0px;">
 
        <div class="col-md-12">
          <div class="panel panel-flat">
            <div class="panel-heading">
              <h6 class="panel-title" style="font-size: 18px;    text-align: -webkit-left;">Users
</h6>
              <div class="heading-elements">
                <ul class="icons-list">
                  <li><a data-action="collapse"></a></li>
                  <li><a data-action="reload"  onclick="location.reload();"></a></li>
                  <li><a data-action="close"></a></li>
                </ul>
              </div>
            </div>
            <div class="panel-body">
			 <div class="tabbable">
          
				 <div class="tab-content">
                  <div class="tab-pane" style="overflow-x:auto;height:400px;">
				<div class="row hidden-sm hidden-xs" >
				<div class="col-md-1">
				<h5>First Name</h5>
				</div>
				<div class="col-md-1">
				<h5>Last Name</h5>
				</div>
				<div class="col-md-2">
				<h5>Join Date</h5>
				</div>
				<div class="col-md-2">
				<h5>Email</h5>
				</div>
				<div class="col-md-1">
				<h5>Mobile</h5>
				</div>
				<div class="col-md-1">
				<h5>City</h5>
				</div>
				<div class="col-md-2">
				<h5>Membership</h5>
				</div>
				<div class="col-md-2">
				<h5>Action</h5>
				</div>
				</div>
                      <div id="loaded_user">
				  @foreach($posts as $i => $users)
				<a href="{{ url('admin/users/adduser/'.$users->id) }}">
				<div class="row">
				<div class="col-md-1">
				<h6>{{ $users->first_name }}</h6>
				</div>
				<div class="col-md-1">
				<h6>{{ $users->last_name }}</h6>
				</div>
				<div class="col-md-2">
				<h6><span class="label label-info">{{ $users->created_at }}</span></h6>
				</div>
				<div class="col-md-2">
				<h6>{{ $users->email}}</h6>
				</div>
				
				<div class="col-md-1">
				<h6>{{ $users->mobile}}</h6>
				</div>
				<div class="col-md-1">
                                @foreach(\App\UserSearch::where('user_id',$users->id)->get() as $city)
				<h6>{{ $city->city}}</h6>
                                @endforeach
				</div>
				<div class="col-md-2">
                                <h6><span class="label <?php if($users->status=='MEMBER'){ echo'label-success'; } if($users->status=='NEW'){ echo'label-info'; } if($users->status=='SUSPENDED'){ echo'label-danger'; } if($users->status=='EXPIRED'){ echo'label-default'; } ?>">{{ $users->status}}</span></h6>
				</div>
				<div class="col-md-2">
                                @if($users->status=='SUSPENDED')
                                <a href="{{URL::to('admin/users/status/'.$users->id.'/NEW')}}" class="btn btn-success btn-xs" >
				<i class="icon-check position-left"></i>Activate</a>
                                @else
                                <a href="{{URL::to('admin/users/status/'.$users->id.'/SUSPENDED')}}" class="btn btn-danger btn-xs" >
				<i class="icon-cross position-left"></i>Suspend</a>
				@endif
				</div>
				
				</div>
				</a>
                               
				   @endforeach
                      </div>     
			{!! $posts->render() !!}
				</div>
				
				
			
				
				
				
			</div>
              </div>
            </div>
          </div>
		   <!-- /panel 1 ends here  -->
		   

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