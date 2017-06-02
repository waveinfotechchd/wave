 @foreach($invites as $user)
                                              @foreach(\App\User::where('id',$user->user_id)->orderBy('id')->get() as $field)
                                              @foreach(\App\User::where('id',$user->to_user_id)->orderBy('id')->get() as $field2)
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <h6>{{$field->first_name}} {{$field->last_name}}</h6>
                                                </div>
                                                <div class="col-md-2">
                                                    <h6>{{$field2->first_name}} {{$field2->last_name}}</h6>
                                                </div>
                                                <div class="col-md-2">
                                                    <h6><span class="label label-info">{{$user->created_at}} </span></h6>
                                                </div>
                                                <div class="col-md-3">
                                                    <h6>{{$field2->position}}</h6>
                                                </div>
                                                
                                                
                                                
                                                <div class="col-md-3">
                                                   <a href="{{URL::to('admin/invites/delete_invite/'.$user->user_id)}}" class="btn btn-danger btn-xs"  onclick="return confirm('Are you sure? You will not be able to recover this.')">
				<i class="icon-cross position-left"></i>Delete</a>
                                                </div>
                                                
                                            </div>
                                            @endforeach
                                                   @endforeach
                                                      @endforeach