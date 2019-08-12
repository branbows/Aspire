@extends($layout)
@section('content')
<div id="page-wrapper">
            <div class="container-fluid">
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <ol class="breadcrumb">
                            <li><a href="{{PREFIX}}"><i class="mdi mdi-home"></i></a> </li>
                            <li><a href="{{URL_MESSAGES}}">Messages</a> </li>
                            <li class="active"> {{ $title }} </li>
                        </ol>
                    </div>
                </div>
<!-- <h1>Create a new message</h1> -->
 <div class="row">
                    <div class="col-md-7 col-sm-12">
<div class="panel panel-custom">
                    <div class="panel-heading">
                        <h1>{{$title}} </h1>
                    </div>
                    <div id="historybox" class="panel-body packages inbox-messages-replay">
                         
                        <div class="row library-items">

    <div class="col-md-12">
        <h1>{{ ucfirst($thread->subject) }}</h1>
        <?php $current_user = Auth::user()->id; ?>
        @foreach($thread->messages as $message)
        <?php $class='message-sender';
        if($message->user_id == $current_user)
        {
            $class = 'message-receiver';
        }


        ?>
            <div class="{{$class}}">
            <div class="media">
                <a class="pull-left" href="#">
                    <img src="{{getProfilePath($message->user->image)}}" alt="{!! $message->user->name !!}" class="img-circle">
                </a>
                <div class="media-body">
                    <h5 class="media-heading">{!! $message->user->name !!}</h5>
                    <p>{!! $message->body !!}</p>
                    <div class="text-muted"><small>Posted {!! $message->created_at->diffForHumans() !!}</small></div>
                </div>
            </div>
            </div>
        @endforeach

       
 
    </div>
    </div>
                </div>
             <div class="reply-block">
                    <div class="row">
            {!! Form::open(['route' => ['messages.update', $thread->id], 'method' => 'PUT']) !!}
            <div class="col-sm-10">
                {!! Form::textarea('message', null, ['class' => 'form-control']) !!}
            </div>
            <div class="col-sm-2">
                {!! Form::submit('Reply', ['class' => 'btn btn-primary btn-lg btn-width']) !!}
            </div>
            {!! Form::close() !!}
        </div>
            </div>
        
            
</div></div>
</div>
</div>

@stop

@section('footer_scripts')
<script>
 $('#historybox').scrollTop($('#historybox')[0].scrollHeight);
</script>
@stop