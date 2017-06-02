@if(count($user)>0 && $user!='a')
@foreach($user as $us)
<div class="col-md-6">
    <div class="panel panel-body">
        <div class="media">
            <a href="{{ URL::to('users/'.$us->id.'/'.$us->first_name.' '.$us->last_name) }}" class="media-left">
            <?php if(isset($us->image_icon)){ ?><img  src="{{ URL::asset('upload/members/'.$us->image_icon) }}" class="img-circle img-lg" alt=""><?php }else{ ?> <img class="img-circle img-lg" src="{{ URL::asset('site_assets/images/placeholder.jpg') }}" alt=""><?php } ?>
            </a>
            <div class="media-body">
        <div class="media-heading text-semibold"> <a href="{{ URL::to('users/'.$us->id.'/'.$us->first_name.' '.$us->last_name) }}" class="media-left">{{ucfirst($us->first_name)}} {{ucfirst($us->last_name)}}</a></div>
        <span class="text-muted">Role : {{$us->position}}</span> <br/>
                <span class="text-muted">Experience : {{$us->totalexperience}}  Years</span>
            </div>
            <div class="media-right">
                <div class="media-heading text-semibold">

                                    <span class="label label-success" 
                                          style>Perfect Match</span>

                </div>
            </div>
            <div class="media-right media-middle">
                <ul class="icons-list icons-list-vertical">
                    <li class="dropdown">
                        
                    </li>
                </ul>
            </div>
            <div class="contact-details" style="background-color:transparent;border:none;">
                <ul class="list-extended list-unstyled list-icons">
                      <li>
                          @if(Auth::user()->status=='MEMBER')
                                    <button type="button" class="btn btn-primary btn-xlg" onclick="inviteFunction({{$us->id}})">
                                        Invite</button>
                                         @else
                                         <a href="{{ URL::to('subscription') }}" type="button" class="btn btn-primary btn-xlg">
                                        Invite</a>
                                         @endif
                    </li>
                   
                </ul>
            </div>
            
        </div>
    </div>
</div>
@endforeach      


@else
<div class="navbar navbar-default navbar-xs navbar-component">
<h1>No Records Founds Please Change Search Parameters</h1>
</div>
@endif



