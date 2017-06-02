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
				
				
				<div class="col-md-2">
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