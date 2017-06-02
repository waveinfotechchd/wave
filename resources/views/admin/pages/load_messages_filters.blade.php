       @foreach($UserConversations as $convertion)
        @foreach(\App\User::where('id',$convertion->to_user_id)->get() as $touser)
      @foreach(\App\User::where('id',$convertion->user_id)->get() as $fromuser)
	  <div class="row user1" style="">
	  <div class="col-md-12">
	  <div class="col-md-4">
	  <p>{{$convertion->created_at}}, {{ucfirst($fromuser->first_name)}} {{ucfirst($fromuser->last_name)}} to {{ucfirst($touser->first_name)}} {{ucfirst($touser->last_name)}}</p>
	  <p><span class="label label-success">Team : ABC </span></p>
	  </div>
	  <div class="col-md-6">
	  <p>{{$convertion->message}}</p>
	  </div>
	  
	  <div class="col-md-2">
<div class="col-sm-4 text-left">
	   <a href="#"  class="au"><u>Hide</u></a><br/>
</div>
<div class="col-sm-8 text-right">
	   <a href="#" class="au"><u>Suspend Sender</u></a>
</div>
	  </div>
	  
	  </div>
	  </div>
              @endforeach
             @endforeach
	     @endforeach