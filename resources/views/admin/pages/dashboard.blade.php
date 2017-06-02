@extends("admin.admin_app")
    
@section("content")
    
<!-- Page header -->
<div class="page-header">
    <div class="page-header-content">
        <div class="page-title">
            
        </div>
            
    </div>
</div>
<!-- /page header -->
<!-- Page container -->
<div class="page-container">
    <!-- Page content -->
    <div class="page-content">
        <!-- Main content -->
        <div class="content-wrapper">
            
            <div class="row"style="margin-right:0px;">
                <div class="col-md-2">
                </div>
                <div class="col-md-8">
                    <div class="panel panel-flat">
                        
                        <div class="panel-body">
                            <div class="tabbable">
                                
                                <div class="tab-content">
                                    <div class="tab-pane" style="">
                                        <div class="row hidden-sm hidden-xs" >
                                            <div class="col-md-3">
                                                <h5></h5>
                                            </div>
                                            <div class="col-md-3">
                                                <h5>Week</h5>
                                            </div>
                                            <div class="col-md-3">
                                                <h5>Month</h5>
                                            </div>
                                            <div class="col-md-3">
                                                <h5>Year</h5>
                                            </div>
                                                
                                        </div>
                                            
                                        <div class="row">
                                            <div class="col-md-3">
                                                <button type="button" class="btn btn-primary btn-xs" >
                                                    <i class="icon-users position-left"></i>Teams</button>
                                            </div>
                                                <div class="col-md-3">
                                                <h6>{{$count_week_team}}</h6>
                                            </div>
                                            <div class="col-md-3">
                                                <h6>{{$count_month_team}}</h6>
                                            </div>
                                            <div class="col-md-3">
                                                <h6>{{$count_year_team}}</h6>
                                            </div>
                                                
                                        </div>
                                           
                                        <div class="row">
                                            <div class="col-md-3">
                                                <button type="button" class="btn btn-primary btn-xs" >
                                                    <i class="icon-list position-left"></i>Shortlisted</button>
                                            </div>
                                                  <div class="col-md-3">
                                                <h6>{{$count_week_shortlists}}</h6>
                                            </div>
                                            <div class="col-md-3">
                                                <h6>{{$count_month_shortlists}}</h6>
                                            </div>
                                            <div class="col-md-3">
                                                <h6>{{$count_year_shortlists}}</h6>
                                            </div>
                                                 
                                        </div>
                                            
                                        <div class="row">
                                            <div class="col-md-3">
                                                <button type="button" class="btn btn-primary btn-xs" >
                                                    <i class="icon-comments position-left"></i>Invites</button>
                                            </div>
                                            <div class="col-md-3">
                                                <h6>{{$count_week_invites}}</h6>
                                            </div>
                                            <div class="col-md-3">
                                                <h6>{{$count_month_invites}}</h6>
                                            </div>
                                            <div class="col-md-3">
                                                <h6>{{$count_year_invites}}</h6>
                                            </div>
                                                
                                        </div>
                                            
                                        <div class="row">
                                            <div class="col-md-3">
                                                <button type="button" class="btn btn-primary btn-xs" >
                                                    <i class="icon-users position-left"></i>Users</button>
                                            </div>
                                               <div class="col-md-3">
                                                <h6>{{$count_week_users}}</h6>
                                            </div>
                                            <div class="col-md-3">
                                                <h6>{{$count_month_users}}</h6>
                                            </div>
                                            <div class="col-md-3">
                                                <h6>{{$count_year_users}}</h6>
                                            </div>
                                                 
                                        </div>
                                           
                                        <div class="row">
                                            <div class="col-md-3">
                                                <button type="button" class="btn btn-primary btn-xs" >
                                                    <i class="fa fa-credit-card position-left"></i>Payments</button>
                                            </div>
                                            <div class="col-md-3">
                                                <h6>0</h6>
                                            </div>
                                            <div class="col-md-3">
                                                <h6>0</h6>
                                            </div>
                                            <div class="col-md-3">
                                                <h6>0</h6>
                                            </div>
                                                
                                        </div>
                                            
                                        <div class="row">
                                            <div class="col-md-3">
                                                <button type="button" class="btn btn-primary btn-xs" >
                                                    <i class="icon-bubbles4 position-left"></i>Messages</button>
                                            </div>
                                               <div class="col-md-3">
                                                <h6>{{$count_week_message}}</h6>
                                            </div>
                                            <div class="col-md-3">
                                                <h6>{{$count_month_message}}</h6>
                                            </div>
                                            <div class="col-md-3">
                                                <h6>{{$count_year_message}}</h6>
                                            </div>
                                               
                                        </div>
                                       
                                    </div>
                                       
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /panel 1 ends here  -->
                         
                    <!-- /profile info -->
                        
                </div>
            </div>
                
            <!-- Large size -->
            <div class="navbar navbar-default navbar-xs navbar-component">
                <ul class="nav navbar-nav no-border visible-xs-block">
                    <li><a class="text-center collapsed" data-toggle="collapse" data-target="#navbar-filter"><i class="icon-menu7"></i></a></li>
                </ul>
                    
                    
                <div class="navbar-collapse collapse" id="navbar-filter">
                    <p class="navbar-text">Filter:</p>
                    <ul class="nav navbar-nav">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-sort-time-asc position-left"></i> City <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                
                                
                                <li><a href="#">New York</a></li>
                                <li><a href="#">London</a></li>
                                <li><a href="#">USA</a></li>
                                    
                                    
                            </ul>
                        </li>
                            
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-sort-amount-desc position-left"></i> Organisation <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                
                                <li><a href="#">JohnD</a></li>
                                <li><a href="#">JohnD2</a></li>
                                    
                            </ul>
                        </li>
                            
                    </ul>
                        
                    <div class="navbar-right">
                        
                        
                    </div>
                </div>
            </div>
            <!-- /tasks options -->
            <!-- Stacked area chart -->
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-flat">
                        <div class="panel-heading">
                            
                            <div class="heading-elements">
                                <ul class="icons-list">
                                    <li><a data-action="collapse"></a></li>
                                    <li><a data-action="reload"></a></li>
                                    <li><a data-action="close"></a></li>
                                </ul>
                            </div>
                        </div>
                            
                        <div class="panel-body">
                            <div class="chart-container">
                                <div class="chart has-fixed-height" id="stacked_area"></div>
                            </div>
                        </div>
                    </div>
                    <!-- /stacked area chart -->
                        
                </div></div>
        </div>
    </div>
</div>  
    
    
@endsection