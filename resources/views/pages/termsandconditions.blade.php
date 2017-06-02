@extends("app")

@section('head_title', getcong('terms_of_title').' | '.getcong('site_name') )

@section('head_url', Request::url())

@section("content")
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
            <!-- User profile -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="tabbable">
                        <div class="tab-content">
                            <div class="tab-pane fade in active" id="settings">
                                <!-- Profile info -->
                                <div class="panel panel-flat">
                                    <div class="panel-heading">
                                        <h6 class="panel-title"><strong>{{getcong('terms_of_title')}}</strong></h6>
                                        <div class="heading-elements">
                                            <ul class="icons-list">
                                               
                                                <li><a data-action="reload"></a></li>
                                             
                                            </ul>
                                        </div>
                                    </div>
                                    {!!getcong('terms_of_description')!!}
                                  </div>
           
                        </div>
                             
                    </div>
                </div>
            </div>
                
        </div>
        <!-- /user profile -->
            
    </div>
    <!-- /main content -->
        
</div>
<!-- /page content -->

@endsection
