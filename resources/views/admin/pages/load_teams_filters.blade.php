 @if(empty($teams))
 <h1>No Records Found</h1>
 @else
@foreach($teams as $team)
                                              
				<a class="show-detail" href="#">
				<div class="row">
				<div class="col-md-1">
                                    <a href="{{URL::to('admin/teams/members/'.$team->user_id)}}" > <h6>{{$team->team_name}}</h6> </a>
				</div>
				<div class="col-md-2">
				<h6>{{$team->owner_name}}</h6>
				</div>
				<div class="col-md-2">
				<h6><span class="label label-info">{{$team->created_at}}</span></h6>
				</div>
				<div class="col-md-2">
				<h6>{{\App\UserInvites::where('user_id',$team->user_id)->count()}}</h6>
				</div>
				<div class="col-md-2">
				<h6>{{\App\UserShortlists::where('user_id',$team->user_id)->count()}}</h6>
				</div>
				<div class="col-md-2">
				<h6>{{\App\UserTeam::where('user_id',$team->user_id)->count()}}</h6>
				</div>
				<div class="col-md-1">
				<a href="{{URL::to('admin/teams/delete_team/'.$team->user_id)}}"  class="btn btn-danger btn-xs" onclick="return confirm('Are you sure? You will not be able to recover this.')" >
				<i class="icon-cross position-left" ></i>Delete</a>
				</div>
				</div>
				</a>
			  @endforeach
                          @endif