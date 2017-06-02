@if(isset(Auth::user()->usertype))
<!-- Main navbar -->
<div class="navbar navbar-inverse">
  <div class="navbar-header"> 
      <a href="{{ URL::to('/') }}" class="navbar-brand">
				  @if(getcong('site_logo'))
				  <img src="{{ URL::asset('upload/'.getcong('site_logo')) }}"  alt="logo" class="img-responsive">
				  @else
					<img src="{{ URL::asset('site_assets/images/logomain.png') }}"  alt="logo" class="img-responsive">
				  @endif					  
				</a>
    <ul class="nav navbar-nav pull-right visible-xs-block">
      <li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
    </ul>
  </div>
  <div class="navbar-collapse collapse" id="navbar-mobile">
    <ul class="nav navbar-nav navbar-right">
      <li class="dropdown">
        <div class="dropdown-menu dropdown-content width-350">
          <ul class="media-list dropdown-content-body">
            <li class="media">
              <div class="media-left"> <img src="{{ URL::asset('site_assets/images/placeholder.jpg') }}" class="img-circle img-sm" alt=""> <span class="badge bg-danger-400 media-badge">5</span> </div>
              <div class="media-body"> <a href="#" class="media-heading"> <span class="text-semibold">James Alexander</span> <span class="media-annotation pull-right">04:58</span> </a> <span class="text-muted">who knows, maybe that would be the best thing for me...</span> </div>
            </li>
            <li class="media">
              <div class="media-left"> <img src="{{ URL::asset('site_assets/images/placeholder.jpg') }}" class="img-circle img-sm" alt=""> <span class="badge bg-danger-400 media-badge">4</span> </div>
              <div class="media-body"> <a href="#" class="media-heading"> <span class="text-semibold">Margo Baker</span> <span class="media-annotation pull-right">12:16</span> </a> <span class="text-muted">That was something he was unable to do because...</span> </div>
            </li>
            <li class="media">
              <div class="media-left"><img src="{{ URL::asset('site_assets/images/placeholder.jpg') }}" class="img-circle img-sm" alt=""></div>
              <div class="media-body"> <a href="#" class="media-heading"> <span class="text-semibold">Jeremy Victorino</span> <span class="media-annotation pull-right">22:48</span> </a> <span class="text-muted">But that would be extremely strained and suspicious...</span> </div>
            </li>
            <li class="media">
              <div class="media-left"><img src="{{ URL::asset('site_assets/images/placeholder.jpg') }}" class="img-circle img-sm" alt=""></div>
              <div class="media-body"> <a href="#" class="media-heading"> <span class="text-semibold">Beatrix Diaz</span> <span class="media-annotation pull-right">Tue</span> </a> <span class="text-muted">What a strenuous career it is that I've chosen...</span> </div>
            </li>
            <li class="media">
              <div class="media-left"><img src="{{ URL::asset('site_assets/images/placeholder.jpg') }}" class="img-circle img-sm" alt=""></div>
              <div class="media-body"> <a href="#" class="media-heading"> <span class="text-semibold">Richard Vango</span> <span class="media-annotation pull-right">Mon</span> </a> <span class="text-muted">Other travelling salesmen live a life of luxury...</span> </div>
            </li>
          </ul>
          <div class="dropdown-content-footer"> <a href="#" data-popup="tooltip" title="All messages"><i class="icon-menu display-block"></i></a> </div>
        </div>
      </li>
      <li class="dropdown dropdown-user"> <a class="dropdown-toggle" data-toggle="dropdown"> <img alt="User Photo" src="<?php if(isset(Auth::user()->image_icon)){ ?>{{URL::to(Auth::user()->image_icon)}}<?php }else{ ?> {{ URL::asset('site_assets/images/placeholder.jpg') }}<?php } ?>"> 
              <span><?php if(!empty(Auth::user()->first_name)){ ?>{{Auth::user()->first_name }}<?php }else{ echo 'User'; } ?></span> <i class="caret"></i> </a>
        <ul class="dropdown-menu dropdown-menu-right">
          <li><a href="{{ URL::to('admin/profile') }}"><i class="icon-user-plus"></i> My profile</a></li>
         
						
		  <li><a href="{{ URL::to('logout') }}"><i class="icon-switch2"></i> Logout</a></li>
        </ul>
      </li>
    </ul>
  </div>
</div>
<!-- /main navbar -->
@else

<!-- Main navbar -->
<div class="navbar navbar-inverse">
    <div class="navbar-header">
        <a href="{{ URL::to('/') }}" class="navbar-brand">
				  @if(getcong('site_logo'))
				  <img src="{{ URL::asset('upload/'.getcong('site_logo')) }}"  alt="logo" class="img-responsive">
				  @else
					<img src="{{ URL::asset('site_assets/images/logomain.png') }}"  alt="logo" class="img-responsive">
				  @endif					  
				</a>
    </div>
    <div class="navbar-collapse collapse" id="navbar-mobile">
        <a class=""href="{{ URL::to('/') }}" >
            <p class="navbar-text"><span class="label bg-success-400" style="width: 50px;height: 24px;padding-top: 4px;">Home</span></p>
        </a>
        <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
            </li>
            <li class="dropdown dropdown-user">
                <a class="" href="{{ URL::to('admin/login') }}" >
                    <p class="navbar-text" style="padding-top: 5px;"><span class="label bg-success-400" style="width: 50px;height: 24px; padding-top: 4px;">Login</span></p>
                </a>
            </li>
        </ul>
    </div>
</div>
<!-- /main navbar -->
@endif
<!-- /main navbar -->