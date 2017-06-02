<!-- Second navbar -->
<div class="navbar navbar-default" id="navbar-second">
  <ul class="nav navbar-nav no-border visible-xs-block">
    <li><a class="text-center collapsed" data-toggle="collapse" data-target="#navbar-second-toggle"><i class="icon-menu7"></i></a></li>
  </ul>
  <div class="navbar-collapse collapse" id="navbar-second-toggle">
    <ul class="nav navbar-nav">
    <li  class="{{classActivePathSite('dashboard')}}"><a href="{{URL::to('dashboard')}}"><i class="icon-display4 position-left"></i>Dashboard</a></li>
    <li class="{{classActivePathSite('conversation')}}"> <a href="{{URL::to('conversation')}}"><i class="icon-bubbles4"></i>  Conversation</a></li>
<!--    <li class="{{classActivePathSite('shortlists')}}"> <a href="{{URL::to('shortlists')}}"><i class="icon-list position-left"></i>Shortlist</a></li>-->
    <li class="{{classActivePathSite('invites')}}"> <a href="{{URL::to('invites')}}"><i class="icon-comments position-left"></i> Invites</a></li>
    <li class="{{classActivePathSite('search')}}"> <a href="{{URL::to('search')}}"><i class="icon-search4 position-left"></i> Search</a></li>
    <li class="{{classActivePathSite('profile')}}"> <a href="{{URL::to('profile')}}"><i class="icon-user position-left"></i> Profile</a></li>
    <li class="{{classActivePathSite('setting')}}"> <a href="{{URL::to('setting')}}"><i class="icon-gear position-left"></i> Setting</a></li>
    <li class="{{classActivePathSite('subscription')}}"> <a href="{{URL::to('subscription')}}"><i class="icon-pencil position-left"></i> Subscription</a></li>
  
    
    </ul>
  </div>
</div>
<!-- /second navbar -->