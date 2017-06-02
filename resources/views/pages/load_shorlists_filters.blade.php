@foreach(\App\UserShortlists::where('user_id',Auth::user()->id)->groupBy('user_id')->where('status','Pending')->get() as $invite)

@foreach(\App\User::where('id',$invite->to_user_id)->where('usertype','!=','Admin')->where('id','!=',Auth::user()->id)->orderBy('id')->groupBy('id')->limit('10')->get() as $user)
@if(!empty($user->first_name))
<li class="media">  

<a href="javascript:void(0);" id="{{$user->first_name}}"  class="media-link " onclick="usermessage('{{$user->first_name}}','{{$user->id}}')">
        <div class="media-left">
      <?php if(isset($user->image_icon)){ ?><img  src="{{ URL::asset('upload/members/'.$user->image_icon) }}" alt="" class="img-circle"><?php }else{ ?> <img  src="{{ URL::asset('site_assets/images/placeholder.jpg') }}" alt="" class="img-circle"><?php } ?>
        </div>
        <div class="media-body">
                <span class="media-heading text-semibold">{{$user->first_name}} {{ $user->last_name}}</span>
                <span class="text-size-small text-muted display-block">{{$user->position}}</span>
        </div>
        <div class="media-right media-middle">
                <span class="status-mark bg-success"></span>
        </div>
</a>
</li>
@endif
@endforeach
@endforeach
