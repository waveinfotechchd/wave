@extends("app")
@section('head_title', 'Conversation | '.getcong('site_name') )
@section('head_url', Request::url())
@section("content")
@include("_particles.user_sidebar")

	<!-- Page header -->
	<div class="page-header">
		<div class="page-header-content">
			<div class="page-title">
			</div>
			<div class="heading-elements">
			</div>
		</div>
	</div>
	<!-- /page header -->
	<!-- Page container -->
	<div class="page-container">
		<!-- Page content -->
		<div class="page-content">

			<!-- Main content -->
                        <div class="content-wrapper" >

				<!-- Inside tabs -->
			
<style>
    .rm_li_active .close {
        position: absolute;
        right: 0;
        top: -2px;
    }
    #conecteduser {
    font-weight: 600;
    padding-left: 24px;
    padding-top: 10px;
    text-align: center;
    }

     li.notify-bar {
    border: 1px solid #249D92;
    background-color: #249D92;
    height: 52px;
} 
span.left-side-notify-section.col-sm-8 {
    color: #fff;
    padding-top: 10px;
    text-align: center;
}
.right-side-notify-btn ul li {
    list-style: none;
    float: left;
    padding-left: 30px;
    margin-top: 4px;
}
.right-side-notify-btn ul li button.btn {
    background: #1E857C;
    color: #fff;
    width: 98px;
}
</style>
<script type="text/javascript">
  
  
function make_offer(username1,key){


  var username=$('#form_user' + key).val();

    var message=$('#form_message' + key).val();
    $.get('/users/make_offer',{to_user_id: key,message:message}, function (data){
    if(data){
        $.get('/users/load_messages',{to_user_id: key}, function (data){
          if(data){

              $('#form_message' + key).val(''); 
              $('#we'+username).html('');
              $('#we'+username).append(data); 
               var height = parseInt($('#we'+username).height());  
        var length = $('#we'+username).children("li").length;
        var abc = height * length
        $('#we'+username).scrollTop($('#we'+username).offset().top+abc); 
          }
          });
    }
    });
}
function offer_recive_Function(key,status,type,username,uid){
if ($('#agree').is(":checked"))
{
  var nda='yes'
}else{
   var nda='no' 
}
    $.get('/users/offer_recive_actions',{to_user_id: key,status: status,type: type,nda: nda}, function (data){
      if(data=='done'){
        $.get('/users/load_messages',{to_user_id: uid}, function (data){
          if(data){
              $('#form_message' + uid).val(''); 
              $('#we'+username).html('');
              $('#we'+username).append(data); 
          var height = parseInt($('#we'+username).height());  
        var length = $('#we'+username).children("li").length;
        var abc = height * length
        $('#we'+username).scrollTop($('#we'+username).offset().top+abc); 
          }
          });
    }else{
        alert(data);
    }
    });
}
 function make_shortlist(key){
  
    $.get('/users/make_shorlist',{to_user_id: key}, function (data){
    if(data){
        $('#form_message' + key).val(''); 
        $('#openshorlist').click();
        $('.shortclr').html('');
        $('.shortclr').append(data);  
    }
    });
}

  function send_message(key){
      
    var username=$('#form_user' + key).val(); 
    var message=$('#form_message' + key).val();
   
    $.get('/users/send_message',{to_user_id: key,message:message}, function (data){
    if(data){
     
        $('#form_message' + key).val(''); 
        $('#we'+username).html('');
        $('#we'+username).append(data); 
        var height = parseInt($('#we'+username).height());  
        var length = $('#we'+username).children("li").length;
        var abc = height * length
        $('#we'+username).scrollTop($('#we'+username).offset().top+abc); 
    }
    });
}
function usermessage(username,uid,img){
    
   var gh;
   var image;
     if(img==''){
         image='http://139.59.64.44/site_assets/images/placeholder.jpg';
     }else{
         image='http://139.59.64.44//upload/members/'+img;
     }
    $(".tab-pane").each(function() { 
        var id = $(this).prop("id");
    if(id==username){ 
         gh='done';
    }
  });
if(gh!='done'){   
    $('.rm_li_active').removeClass("active");  
    $('.rm_tb_active').removeClass("active"); 
    $('.rm_tb_active').removeClass("in");
 

    var tabheading='<li class="closeall active rm_li_active close'+username+' "><a href="#'+username+'" data-toggle="tab"><img  src="'+image+'" alt="" class="img-circle tab-img position-left">'+username+'<span class="status-mark position-right border-success"></span><button type="button" class="close" id="close'+username+'" data-dismiss="modal" onclick="revertback(this.id)">&times;</button></a></li>';
    var tabcontent='<div class="tab-pane fade in active has-padding rm_tb_active close'+username+'" id="'+username+'"><ul class="media-list chat-list content-group" id="we'+username+'"></ul>{!! Form::open(array("url" => "","role"=>"form")) !!}<input type="text" class="hidden" name="username" value="'+username+'" id="form_user'+uid+'"/><textarea id="form_message'+uid+'"  name="enter-message" class="form-control content-group messagedisable" rows="3" cols="1" placeholder="Enter your message..."></textarea> <div class="row subscribe"><div class="col-xs-6">\n\
<button type="button" onclick="make_offer('+username+','+uid+')" class="btn bg-green-700">Make Offer</button><span>  </span><button type="button" onclick="make_shortlist('+uid+')" class="btn bg-green-700">Shortlist</button></div><div class="col-xs-6 text-right"><button type="button" onclick="send_message('+uid+')" class="btn bg-teal-400 btn-labeled btn-labeled-right"><b><i class="icon-circle-right2"></i></b> Send</button></div>{!! Form::close() !!}</div>';
    $("#tabli").append(tabheading);
    $("#addtabcontent").append(tabcontent); 
   resizeFn();
 $.get('/users/load_messages',{to_user_id: uid}, function (data){     
    if(data){      
        $('#form_message' + uid).val(''); 
        $('#we'+username).html('');
        $('#we'+username).append(data);               
        var height = parseInt($('#we'+username).height());  
        var length = $('#we'+username).children("li").length;
        var abc = height * length
        $('#we'+username).scrollTop($('#we'+username).offset().top+abc); 
        <?php    if(Auth::user()->status!='MEMBER'){ ?>
                    <?php    if(Auth::user()->status!='EXPIRED'){ ?>
                     var addbuttn='<div class="col-xs-6"><p class="text-danger h3">Your membership has expired. Please renew your membership to continue your conversations</p></div><div class="col-xs-6 text-right"><a href="/subscription" class="btn bg-teal-400 btn-labeled btn-labeled-right"><b><i class="icon-circle-right2"></i></b>Subscribe</a></div>'     
                     <?php } ?> 
                     <?php    if(Auth::user()->status!='SUSPENDED'){ ?>
                     var addbuttn='<div class="col-xs-6"><p class="text-danger h3">Please subscribe to use the conversation feature.</p></div><div class="col-xs-6 text-right"><a href="/subscription" class="btn bg-teal-400 btn-labeled btn-labeled-right"><b><i class="icon-circle-right2"></i></b>Subscribe</a></div>'     
                     <?php } ?>      
               <?php if(Auth::user()->status!='NEW'){ ?>
                     var addbuttn='<div class="col-xs-6"><p class="text-danger h3">Please subscribe to use the conversation feature.</p></div><div class="col-xs-6 text-right"><a href="/subscription" class="btn bg-teal-400 btn-labeled btn-labeled-right"><b><i class="icon-circle-right2"></i></b>Subscribe</a></div>'     
                     <?php } ?> 
               $('.subscribe').html('');  
               $(".messagedisable").attr("disabled", true);
               $('.subscribe').append(addbuttn); 
        <?php } ?>
    }
    });
    }  
}
/* window resize function */
var resizeFn = function(){
    if ($(window).width() > 960) {
        $('.chat-list').each(function() {
            $(this).height($(window).height() - 406);
        });
    }

}  
/*window resize dunction end */
function revertback(username){
$('.'+username).remove();
}
function connected(key){
    
$('#conecteduser').html('');
$('#conecteduser').html(key);
}
function closealltabs(){
  
$('.closeall').html('');
$('#addtabcontent').html('');

}
function closeother(){
alert('under_progress');
}





</script>
				<div class="tabbable tab-content-bordered content-group-lg" id="container-1">
					<ul class="nav nav-tabs nav-lg nav-tabs-highlight" id='tabli'>



						<li class="dropdown pull-right" >
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-cog7"></i> <span class="visible-xs-inline-block position-right">Options</span> <span class="caret"></span></a>
							<ul class="dropdown-menu dropdown-menu-right">
                                                            <li><a href="#chat-tab3" data-toggle="tab" onclick="closealltabs()">Close all tabs</a></li>
                                                            <li><a href="#chat-tab4" data-toggle="tab" onclick="closeother()">Close other tabs</a></li>
							</ul>
						</li>
					</ul>

					<div class="tab-content" id="addtabcontent">


					</div>
				</div>
				<!-- /inside tabs -->


			</div>
			<!-- /main content -->
<!-- Secondary sidebar -->

			<div class="sidebar sidebar-secondary sidebar-default" style="padding-right: 0px;padding-left: 20px;">
				<div class="sidebar-content"><span class="pull-left" id='conecteduser'>Connected Users</span>
<ul class="nav nav-tabs nav-lg nav-tabs-highlight" id='tabli'>
					<li class="dropdown pull-right">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-users"></i> <span class="visible-xs-inline-block position-right">Options</span> <span class="caret"></span></a>
							<ul class="dropdown-menu dropdown-menu-right">
                                                            <li><a href="#connected_users" data-toggle="tab" onclick="connected('Connected Users')">Connected Users</a></li>
								<li><a href="#shortlisted_users" data-toggle="tab" id="openshorlist" onclick="connected('Shortlisted Users')">Shortlisted Users</a></li>
							</ul>
						</li>
</ul>
                                    <div class="tab-content" id="addtabcontent">
                                        <div class="tab-pane fade in active " id="connected_users">
					<!-- Online users -->
					<div class="sidebar-category">
 
						

						<div class="category-content no-padding">
							<ul class="media-list media-list-linked">
                                                           
                                                            @foreach(\App\UserInvites::where(array('user_id'=>Auth::user()->id,'status'=>'ACCEPTED'))->get() as $invite)
                                                          
                                                            @foreach(\App\User::where('id',$invite->to_user_id)->where('usertype','!=','Admin')->where('id','!=',Auth::user()->id)->orderBy('id')->groupBy('id')->limit('10')->get() as $user)
                                                              
                                                            @if(!empty($user->first_name))
                                                           
								<li class="media">  
                                                                   
									<a href="javascript:void(0);" id="{{$user->first_name}}"  class="media-link " onclick="usermessage('{{$user->first_name}}','{{$user->id}}','{{$user->image_icon}}')">
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
                                                                 @foreach(\App\UserInvites::where(array('to_user_id'=>Auth::user()->id,'status'=>'ACCEPTED'))->get() as $invite)
                                                               
                                                            @foreach(\App\User::where('id',$invite->user_id)->where('usertype','!=','Admin')->where('id','!=',Auth::user()->id)->orderBy('id')->groupBy('id')->limit('10')->get() as $user)
                                                            @if(!empty($user->first_name))
								<li class="media">  
                                                                   
									<a href="javascript:void(0);" id="{{$user->first_name}}"  class="media-link " onclick="usermessage('{{$user->first_name}}','{{$user->id}}','{{$user->image_icon}}')">
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
							</ul>
						</div>
					</div>

                                        
					<!-- /online users -->

                                    </div>
                                        <div class="tab-pane fade " id="shortlisted_users">
                                          <div class="sidebar-category">
 
						

						<div class="category-content no-padding">
							<ul class="media-list media-list-linked shortclr">
                                                           
                                                            @foreach(\App\UserShortlists::where('user_id',Auth::user()->id)->groupBy('user_id')->get() as $invite)
                                                      
                                                            @foreach(\App\User::where('id',$invite->to_user_id)->where('usertype','!=','Admin')->where('id','!=',Auth::user()->id)->orderBy('id')->groupBy('id')->limit('10')->get() as $user)
                                                            @if(!empty($user->first_name))
								<li class="media">  
                                                                   
									<a href="javascript:void(0);" id="{{$user->first_name}}"  class="media-link " onclick="usermessage('{{$user->first_name}}','{{$user->id}}','{{$user->image_icon}}','{{$user->image_icon}}')">
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
                                                             
							</ul>
						</div>
					</div>
                                        </div>
					<!-- Latest messages 
					<div class="sidebar-category">
						<div class="category-title">
							<span>Latest messages</span>
							<ul class="icons-list">
								<li><a href="#" data-action="collapse"></a></li>
							</ul>
						</div>

						<div class="category-content no-padding">
							<ul class="media-list media-list-linked">
								<li class="media">
									<a href="#" class="media-link">
										<div class="media-left"><img src="{{ URL::asset('site_assets/images/placeholder.jpg') }}" class="img-circle" alt=""></div>
										<div class="media-body">
											<span class="media-heading text-semibold">Will Samuel</span>
											<span class="text-muted">And he looked over at the alarm clock, ticking..</span>
										</div>
									</a>
								</li>

								<li class="media">
									<a href="#" class="media-link">
										<div class="media-left"><img src="{{ URL::asset('site_assets/images/placeholder.jpg') }}" class="img-circle" alt=""></div>
										<div class="media-body">
											<span class="media-heading text-semibold">Margo Baker</span>
											<span class="text-muted">However hard he threw himself onto..</span>
										</div>
									</a>
								</li>

								<li class="media">
									<a href="#" class="media-link">
										<div class="media-left"><img src="{{ URL::asset('site_assets/images/placeholder.jpg') }}" class="img-circle" alt=""></div>
										<div class="media-body">
											<span class="media-heading text-semibold">Monica Smith</span>
											<span class="text-muted">Yes, but was it spanossible to quietly sleep through..</span>
										</div>
									</a>
								</li>

								<li class="media">
									<a href="#" class="media-link">
										<div class="media-left"><img src="{{ URL::asset('site_assets/images/placeholder.jpg') }}" class="img-circle" alt=""></div>
										<div class="media-body">
											<span class="media-heading text-semibold">Jordana Mills</span>
											<span class="text-muted">What should he do now? The next train went at..</span>
										</div>
									</a>
								</li>

								<li class="media">
									<a href="#" class="media-link">
										<div class="media-left"><img src="{{ URL::asset('site_assets/images/placeholder.jpg') }}" class="img-circle" alt=""></div>
										<div class="media-body">
											<span class="media-heading text-semibold">John Craving</span>
											<span class="text-muted">Gregor then turned to look out the window..</span>
										</div>
									</a>
								</li>
							</ul>
						</div>
					</div>
					<!-- /latest messages -->

				</div>

			</div>
			
			<!-- /secondary sidebar -->
		</div>
		<!-- /page content -->


		<!-- Footer -->
		
		<!-- /footer -->

	</div>
	<!-- /page container -->
@endsection