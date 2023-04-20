@extends('layouts.messenger')

@section('title', 'Messenger')

@section('content')

    <div class="col-sm-8 conversation">
        <div class="row heading">
            <div class="col-sm-2 col-md-1 col-xs-3 heading-avatar">
                <div class="heading-avatar-icon">
                    <img src="{{$user->profile_img}}">
                </div>
            </div>
            <div class="col-sm-8 col-xs-7 heading-name">
                <a href="{{route('profile.show', $user)}}" class="heading-name-meta">{{$user->firstname . " " . $user->surname}}
                    @if($user->verified)
                        <img src="{{asset('https://upload.wikimedia.org/wikipedia/commons/thumb/e/e4/Twitter_Verified_Badge.svg/1200px-Twitter_Verified_Badge.svg.png')}}" alt="" width="15" style="margin-bottom: 1px;">
                    @endif
                </a>
                <span class="heading-online">Online</span>
            </div>
            <div class="col-sm-1 col-xs-1  heading-dot pull-right">
                <i class="fa fa-ellipsis-v fa-2x  pull-right" aria-hidden="true"></i>
            </div>
        </div>

        <div class="row message" id="conversation">
            @foreach($message as $message)

                @if($message->messagefrom_id == Auth::user()->id && $message->messageto_id == $user->id)
                    <div class="row message-body">
                        <div class="col-sm-12 message-main-sender">
                            <div class="sender">
                                <div class="message-img">
                                    @if($message->message_img != 'noimg')
                                        <img style="border-radius: 20px" src="{{$message->message_img}}" alt="" width="400">
                                    @endif
                                </div>
                                <div class="message-text">
                                    {{$message->message_text}}
                                </div>
                                <span class="message-time pull-right">
                                    {{$message->created_at}}
                        </span>
                            </div>
                        </div>
                    </div>
                @elseif($message->messageto_id == Auth::user()->id && $message->messagefrom_id == $user->id)
                    <div class="row message-body">
                        <div class="col-sm-12 message-main-receiver" style="margin-top: 10px;">
                            <div class="receiver">
                                <div class="message-img">
                                    @if($message->message_img != 'noimg')
                                        <img style="border-radius: 20px" src="{{$message->message_img}}" alt="" width="400">
                                    @endif
                                </div>
                                <div class="message-text">
                                    {{$message->message_text}}
                                </div>
                                <span class="message-time pull-right">
                                    {{$message->created_at}}
              </span>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>

        <form action="{{route('messenger.store')}}" method="post" id="myForm" enctype="multipart/form-data">
            @csrf
            <input type="hidden" value="{{$user->id}}" name="messageto_id">
            <div class="row reply">
                <div class="col-sm-10 col-xs-9 reply-main">
                    <textarea class="form-control" rows="1" name="message_text" id="comment"></textarea>
                </div>
                <div class="col-sm-1 reply-send" >
                    <i class="fa-solid fa-image" style="font-size: 20px" id="img_btn"></i>
                    <input type="file" name="message_img" style="display: none" id="img_input">
                </div>
                <div class="col-sm-1 reply-send">
                    <i class="fa-sharp fa-solid fa-paper-plane" id="message_submit" style="font-size: 20px"></i>
                </div>
            </div>
        </form>
    </div>

    <script>
        const myForm = document.getElementById("myForm");
        document.querySelector("#message_submit").addEventListener("click", function(){

            myForm.submit();

        });

        let img_btn = document.getElementById('img_btn');
        let img_input = document.getElementById('img_input');

        img_btn.addEventListener('click', ()=>{
            img_input.click();
        })
    </script>

@endsection
