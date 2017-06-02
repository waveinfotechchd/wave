@extends("app")
@section('head_title', 'Reset Password | '.getcong('site_name') )
@section('head_url', Request::url())
@section("content")
<style>
    .pading-15 {
    padding: 15px;
}
    </style>
<!-- Page container -->
<div class="page-container login-container">
    
    <!-- Page content -->
    <div class="page-content">
        <!-- Main content -->
        <div class="content-wrapper">
            {!! Form::open(array('url' => 'password/reset','class'=>'','id'=>'passwordform','role'=>'form')) !!} 
              <div class="panel login-form pading-15">
                            <div class="thumb thumb-rounded">
                                <div class="caption-overflow">
                                </div>
                            </div>
                   <h2 class="text-primary">Reset Password</h2>
            <div class="message">
                
                @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <ul style="list-style: none;">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                
            </div>
            @if(Session::has('flash_message'))
            
            <div class="alert alert-success fade in">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                {{ Session::get('flash_message') }}
            </div>
            
            
            @endif
            <input type="hidden" name="token" value="{{ $token }}">
            <div class="form-group login-options">
           
                <input id="email" name="email" type="text" placeholder="Email" class="form-control input-md">
            </div>
            <div class="form-group login-options">
                
                <input id="password" name="password" type="password" placeholder="Password" class="form-control input-md">
            </div>
            <div class="form-group login-options">
               
                <input id="password_confirmation" name="password_confirmation" type="password" placeholder="Confirm Password" class="form-control input-md">
            </div>
            
            <div class="form-group login-options">
                <button id="submit" name="submit" class="btn btn-primary btn-block">Reset Password<i class="icon-arrow-right14 position-right"></i></button>
                <a href="{{ URL::to('login') }}" class="pull-right"> <small>Login ?</small></a> </div>
              </div>
            {!! Form::close() !!} 
            
            
        </div>
        <!-- /main content -->
        
    </div>
    <!-- /page content -->
    
    
</div>
<!-- /page container -->


@endsection
