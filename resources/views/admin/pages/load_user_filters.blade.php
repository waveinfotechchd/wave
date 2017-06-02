  @if(empty($users))
 <h1>No Records Found</h1>
 @else
@foreach($users as $i => $users)
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
                                   @endif