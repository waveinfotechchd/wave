<!-- Second navbar -->
<div class="navbar navbar-default" id="navbar-second">
  <ul class="nav navbar-nav no-border visible-xs-block">
    <li><a class="text-center collapsed" data-toggle="collapse" data-target="#navbar-second-toggle"><i class="icon-menu7"></i></a></li>
  </ul>
  <div class="navbar-collapse collapse" id="navbar-second-toggle">
    <ul class="nav navbar-nav">
      <li class="{{classActivePathSite('dashboard')}}"><a href="{{ URL::to('admin/dashboard') }}" ><i class="icon-display4 position-left"></i> Dashboard</a></li>
       <li class="{{classActivePathSite('teams')}}"> <a href="{{ URL::to('admin/teams') }}"><i class="icon-users position-left"></i>Teams</a></li>
	    <li class="{{classActivePathSite('shortlists')}}"> <a href="{{ URL::to('admin/shortlists') }}"><i class="icon-list position-left"></i>Shortlists</a></li>
	  <li class="{{classActivePathSite('invites')}}"> <a href="{{ URL::to('admin/invites') }}"><i class="icon-comments position-left"></i>Invites </a></li>
      <li class="{{classActivePathSite('users')}}"> <a href="{{ URL::to('admin/users') }}"><i class="icon-users position-left"></i>Users</a></li>
    <li class="{{classActivePathSite('payments')}}"> <a href="{{ URL::to('admin/payments') }}"><i class="fa fa-credit-card position-left"></i> Payments</a></li>
    <li class="{{classActivePathSite('conversation')}}"> <a href="{{ URL::to('admin/conversation') }}"><i class="icon-bubbles4 position-left"></i> Messages</a></li>
    <li class="{{classActivePathSite('cities')}}"> <a href="{{ URL::to('admin/cities') }}"><i class="glyphicon glyphicon-map-marker position-left"></i> Cities</a></li>
   <li class="{{classActivePathSite('coupons')}}"> <a href="{{ URL::to('admin/coupons') }}"><i class="glyphicon glyphicon-scissors position-left"></i> Coupons</a></li>

    </ul>
  </div>
</div>
<!-- /second navbar -->