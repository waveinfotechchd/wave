<?php function cmp($a, $b) {
        return $a->id - $b->id;
}
usort($merge, "cmp");
//$merge =array_reverse($merge);
?>
@foreach($merge as $message)
<?php  $touid=$message->to_user_id;  $fromuid=$message->user_id; ?> 
@if($user_id==$message->user_id)
    <li class="media reversed">
        <div class="media-body">
            <div class="media-content">{{$message->message}}</div>
            <span class="media-annotation display-block mt-10">{{$message->created_at}} <a href="#"><i class="icon-pin-alt position-right text-muted"></i></a></span>
        </div>
              @foreach(\App\User::where('id',$message->user_id)->get() as $user)
        <div class="media-right">
            <a href="{{ URL::asset('site_assets/images/placeholder.jpg') }}">
        <?php if(isset($user->image_icon)){ ?><img  src="{{ URL::asset('upload/members/'.$user->image_icon) }}" alt="" class="img-circle"><?php }else{ ?> <img  src="{{ URL::asset('site_assets/images/placeholder.jpg') }}" alt="" class="img-circle"><?php } ?>
       
            </a>
        </div>
              @endforeach
    </li>
  @endif
  @if($user_id==$message->to_user_id)
      
    <li class="media">
           @foreach(\App\User::where('id',$message->user_id)->get() as $user)
        <div class="media-left">
            <a href="{{ URL::asset('site_assets/images/placeholder.jpg') }}">
        <?php if(isset($user->image_icon)){ ?><img  src="{{ URL::asset('upload/members/'.$user->image_icon) }}" alt="" class="img-circle"><?php }else{ ?> <img  src="{{ URL::asset('site_assets/images/placeholder.jpg') }}" alt="" class="img-circle"><?php } ?>
       
            </a>
        </div>
              @endforeach
        <div class="media-body">
            <div class="media-content">{{$message->message}}</div>
            <span class="media-annotation display-block mt-10">{{$message->created_at}} <a href="#"><i class="icon-pin-alt position-right text-muted"></i></a></span>
        </div>
       
    </li>
  @endif  
@endforeach

<?php echo $date = date('Y-m-d H:i:s');?>

 @foreach(\App\UserOffers::where('to_user_id',Auth::user()->id)->where('user_id',$touid)->get() as $lists)
 @foreach(\App\User::where('id',$lists->user_id)->orderBy('id')->get() as $field)
 @foreach(\App\UserSearch::where('user_id',$lists->user_id)->get() as $status)
 @if($date<$lists->expired_date)
 <li class="notify-bar wee{{$field->first_name}}">

     @if($lists->status=='ACCEPTED')
            <span class="left-side-notify-section col-sm-8">   
         {{ucfirst(Auth::user()->first_name)}} accepted {{ucfirst($field->first_name)}} Team's offer
           
            </span>
     @elseif($lists->status=='DECLINED')
     <span class="left-side-notify-section col-sm-8">   
           {{ucfirst(Auth::user()->first_name)}} declined  {{ucfirst($field->first_name)}} Team's offer
            </span> 
     @else
     <span class="left-side-notify-section col-sm-8">   
            Offer recived to join {{ucfirst($field->first_name)}} Team! Offer expire's on {{$lists->expired_date}}<br/>
            <input type="checkbox" checked />i have agreed to <a  href="{{ URL::asset('upload/NDA.docx') }}" >NDA</a> and the terms&conditions 
            </span>
     @endif
     <div class="right-side-notify-btn col-sm-4">
         <ul>
             @if(Auth::user()->status=='MEMBER')
             <li><button type="button"  class="btn" onclick="offer_recive_Function({{$lists->id}},'ACCEPTED','Recieve','{{$field->first_name}}',{{$lists->user_id}})">Accept</button> </li>
             <li><button type="button" class="btn" onclick="offer_recive_Function({{$lists->id}},'DECLINED','Recieve','{{$field->first_name}}',{{$lists->user_id}})">Decline</button></li> 
             @else
             <li><a href="/subscription"  class="btn">Subscribe</a> </li>
             @endif
         </ul>
        
           
            
         
     </div>
  </li>
  @endif
    @endforeach
    @endforeach
    @endforeach

     @foreach(\App\UserOffers::where('user_id',Auth::user()->id)->where('to_user_id',$fromuid)->get() as $lists)
 @foreach(\App\User::where('id',$lists->to_user_id)->orderBy('id')->get() as $field)
 @foreach(\App\UserSearch::where('user_id',$lists->to_user_id)->get() as $status)
 @if($date<$lists->expired_date)
 <li class="notify-bar wee{{$field->first_name}}">

     @if($lists->status=='ACCEPTED')
            <span class="left-side-notify-section col-sm-8">   
         {{ucfirst(Auth::user()->first_name)}} offer accepted by {{ucfirst($field->first_name)}} 
            </span> 
     @elseif($lists->status=='DECLINED')
     <span class="left-side-notify-section col-sm-8">   
           {{ucfirst(Auth::user()->first_name)}} offer declined by {{ucfirst($field->first_name)}} 
            </span> 
     @elseif($lists->status=='Pending')
     <span class="left-side-notify-section col-sm-8">   
            Offer send to {{ucfirst($field->first_name)}} for join your Team! Offer expire's on {{$lists->expired_date}}
            </span>
 
     @endif
     <div class="right-side-notify-btn col-sm-4">
         <ul>
              @if(Auth::user()->status=='MEMBER')
             <li><button type="button"  class="btn" onclick="offer_recive_Function({{$lists->id}},'CANCELED','Recieve','{{$field->first_name}}',{{$lists->to_user_id}})">Cancel Offer</button> </li>
             <li><button type="button" class="btn" onclick="offer_recive_Function({{$lists->id}},'REMOVED','Recieve','{{$field->first_name}}',{{$lists->to_user_id}})">Remove</button></li> 
             @else
             <li><a href="/subscription"  class="btn">Subscribe</a> </li>
             @endif
         </ul>
     </div>
  </li>
  @endif
    @endforeach
    @endforeach
    @endforeach