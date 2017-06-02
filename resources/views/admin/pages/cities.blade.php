@extends("admin.admin_app")
@section("content")
<style>
.btn.disabled, .btn[disabled], fieldset[disabled] .btn {
    cursor: not-allowed;
    opacity: 0.3;
	}
.label-info {
background:none;
border:none;
font-size:14px;
    color: #00BCD4;
}
.label-warning {
 color: #FF5722;
background:none;
border:none;
font-size:14px;
}
.label-success {
background:none;
border:none;
font-size:14px;
    color: #4CAF50;
}
	</style>
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
      <!-- Large size -->
      <div class="row">
 
        <div class="col-md-12">
          <div class="panel panel-flat">
            <div class="panel-heading">
              <h6 class="panel-title"><b>Cities</b>
			  </h6>
                  @if(Session::has('flash_message'))
                  <div class="alert alert-success" style="width:400px;margin:0 auto">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                                        {{ Session::get('flash_message') }}
                                    </div>
                          @endif
                           <div class="text-right" style="margin-right:8%;">
                                                      <button type="submit" class="btn btn-primary" data-toggle="modal" data-target="#addcity">Add City<i class="icon-add position-right"></i></button>
                                              </div>
              <div class="heading-elements"> 
                       
                <ul class="icons-list"> 
                  <li><a data-action="collapse"></a></li>
                  <li><a data-action="reload"></a></li>
                  <li><a data-action="close"></a></li>
                </ul>
              </div>
            </div> 
            <div class="panel-body">
              <div class="tabbable">
                
                <div class="tab-content">
                  <div class="tab-pane active" id="large-justified-tab1">
                    <div class="datatable-scroll">
                      <table class="table datatable-show-all dataTable no-footer" id="DataTables_Table_0" role="grid" aria-describedby="DataTables_Table_0_info">
                        <thead>
                          <tr role="row">
                            <th class="sorting_asc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-sort="ascending" aria-label="First Name: activate to sort column descending">City</th>
                            <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Job Title: activate to sort column ascending">Status</th>
                            <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Status: activate to sort column ascending">Start Date</th>
                            <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" aria-label="Status: activate to sort column ascending">Members</th>
                         <th class="text-center sorting_disabled" rowspan="1" colspan="1" aria-label="Invite" style="width: 100px;">Action</th>
                         <th class="text-center sorting_disabled" rowspan="1" colspan="1" aria-label="Invite" style="width: 100px;">Delete</th>
                          </tr> 
                        </thead>
                        <tbody>
                            @foreach($cities as $city)
                          <tr role="row" class="odd">
                            <td class="sorting_1"><a href="#">{{$city->city}}</a></td>
                            <td><span class="label label-<?php if(isset($city->status)){if($city->status=='Active'){ echo 'success' ; }else{ echo 'warning' ; } } ?>">{{$city->status}}</span></td>
                            <td>{{$city->created_at}}</td>
                            <td><span class="label label-info">0</span></td>
                          <td ><p>
                                  <?php if(isset($city->status)){if($city->status=='Active'){ ?> <a href="{{URL::to('admin/cities/status/'.$city->id.'/Suspended')}}" class="btn btn-warning btn-xs" ><i class="icon-cross position-left"></i>Suspend</a> <?php }else{ ?><a href="{{URL::to('admin/cities/status/'.$city->id.'/Active')}}" class="btn btn-success btn-xs" ><i class="icon-check position-left"></i>Activate</a> <?php  } } ?>
                          </td><td>
                                  <a href="{{URL::to('admin/cities/delete/'.$city->id)}}" class="btn btn-warning btn-xs" onclick="return confirm('Are you sure? You will not be able to recover this.')"><i class="icon-cross position-left">Delete</i></a>      
						  </p></td>
                          
						  </tr>
                           @endforeach
                           <tr><td colspan="6">{!! $cities->render() !!}</td></tr>
                        </tbody> 
						
                      </table>
          
                    </div>
                  </div>
                  
                </div>
                  <!-- Modal -->
<div id="addcity" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add City</h4>
      </div>
      <div class="modal-body">
        {!! Form::open(array('url' => array('admin/cities/addcity'),'class'=>'form-horizontal padding-15','role'=>'form')) !!} 
 <input type="hidden" name="id" value="{{ isset($cat->id) ? $cat->id : null }}">
        <div class="form-group">
            <label for="" class="col-sm-3 control-label">City Name</label>
              <div class="col-sm-9">
                  <input type="text" name="city_name"  class="form-control" placeholder="City Name" required="required">
            </div>
        </div>

    

     
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Add City</button>
      </div>
    </div>
   {!! Form::close() !!} 
  </div>
</div>
                   <!-- Modal -->
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- /large size -->
    </div>
    <!-- /main content -->
  </div>
  <!-- /page content -->
  <!-- Footer -->
  <!-- /footer -->
</div>
<!-- /page container -->
@endsection