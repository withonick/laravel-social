@extends('layouts.app')
@section('title', 'Профиль')

@section('content')
    <div style="width: 100%; background: white; padding: 20px">
        {{$user->firstname . " " . $user->surname}} <br>
        <span style="font-size: 14px; color: #DBDBDB">{{__('message.allposts')}}: {{count($user->posts)}}</span>
    </div>

    <div>
        <div class="img-container" style="background: white; padding: 20px">

                <img style="cursor: pointer; border: 1px solid #DBDBDB" src="{{$user->profile_img}}" class="rounded-circle" width="50" height="50">
                    @if(Auth::check() && Auth::user()->whoSubscribed->contains($user->id))
                    <button data-bs-toggle="modal" data-bs-target="#subscribe" style="background: black; color: white; border-radius: 20px; padding: 8px; font-size: 14px; float: right; margin-top: 35px; font-weight: bold">{{__('message.subscribed')}}</button>
            @else
                <form action="{{route('subscribe', $user->id)}}" method="post">
                    @csrf
                    <button type="submit" style="background: black; color: white; border-radius: 20px; padding: 8px; font-size: 14px; float: right; margin-top: 35px; font-weight: bold">{{__('message.subscribe')}}</button>
                </form>
            @endif
            <a href="{{route('messenger.show', $user)}}" style="background: black; color: white; border-radius: 20px; padding: 10px; margin-right: 10px; font-size: 14px; float: right; margin-top: 35px; font-weight: bold">Message</a>
            <div class="modal fade" id="subscribe" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">{{__('message.unsubscribe')}}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{route('subscribe', $user->id)}}" method="post">
                                            @csrf
                                        Are you sure you want to unsubscribe
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('message.cancel')}}</button>
                                        <button type="submit" class="btn btn-primary">{{__('message.unsubscribe')}}</button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
        </div>
        <div style="background: white; padding-left: 20px; padding-bottom: 20px;">
            <span style="font-weight: bold">{{$user->firstname . " " . $user->surname}}</span>
            @if($user->verified)
                <img src="{{asset('https://upload.wikimedia.org/wikipedia/commons/thumb/e/e4/Twitter_Verified_Badge.svg/1200px-Twitter_Verified_Badge.svg.png')}}" alt="" width="15" style="margin-bottom: 1px;">
            @endif
            <br>
            <span style="font-size: 14px; color: #DBDBDB">{{"@" . $user->username}}</span>
            <br>
            <span style="font-size: 14px; color: #C9C9C9">Регистрация: {{$user->created_at->diffForHumans()}}</span>
            <br>
        </div>
        <div class="d-flex justify-content-center" id="profile-links" style="border-bottom: 1px solid #ECECEC; background: white">
            <a href="#">{{__('message.posts')}}</a>
            <a href="#">{{__('message.postandans')}}</a>
            <a href="#">{{__('message.like')}}</a>
        </div>

        <div class="user-posts" style="background: white; padding-top: 30px;">
            @foreach($user->posts as $post)
                <div class="col-md-8" style="margin-right: auto; margin-left: auto">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex">
                                <a href="{{route('profile.show', $post->user)}}"><img src="{{$post->user->profile_img}}" alt="profile" width="50" class="rounded-circle" style="border: 1px solid #DBDBDB"></a>
                                <i class="bi bi-three-dots-vertical" style="position: absolute; right: 25px; cursor:pointer;" data-bs-toggle="dropdown" aria-expanded="false"></i>
                                <ul class="dropdown-menu">
                                    @can('complain', $post)
                                        <li><a class="dropdown-item" href="{{route('posts.complain.form', $post->id)}}">{{__('message.complain')}}</a></li>
                                    @endcan
                                    <li><a class="dropdown-item" href="#">{{__('message.share')}}</a></li>
                                </ul>

                                <span><a href="{{route('profile.show', $post->user)}}" style="margin-left: 15px; margin-top: 5px; color: black">{{$post->user->firstname . " " . $post->user->surname}}
                                        @if($post->user->verified)
                                            <img src="{{asset('https://upload.wikimedia.org/wikipedia/commons/thumb/e/e4/Twitter_Verified_Badge.svg/1200px-Twitter_Verified_Badge.svg.png')}}" alt="" width="15" style="margin-bottom: 1px;">
                                        @endif
                                        <span style="color:gray;">{{"@".$post->user->username}}</span></a>
                            <br>
                            <span style="font-size: 14px; color: gray; margin-left: 15px">{{$post->created_at->diffForHumans()}}</span>
                        </span>
                            </div>
                            <a href="{{route('posts.show', $post->id)}}">
                                <div style="margin-left: 55px; margin-bottom: 10px; margin-top: 5px;">
                                    <p style="color: black">{{$post->message}}</p>
                                </div>
                                @if($post->img != "noimg")
                                    <div id="post-image" style="text-align: center; padding-bottom: 20px">
                                        <a href="{{route('posts.show', $post->id)}}"><img src="{{$post->img}}" id="post_image" alt="post" width="600" style="border-radius: 10px; border: 1px solid #DBDBDB"></a>
                                    </div>
                                @endif
                            </a>
                            <div class="post-btns" style="width: 610px; margin-left: auto; margin-right: auto;">
                                <div style="float: left; display: flex">
                                    @auth()
                                        <form action="{{route('posts.rate', $post->id)}}" method="post">
                                            @csrf
                                            <button style="font-size: 12px; color:{{ Auth::user()->likedPosts->contains($post->id) ? 'black' : 'gray'}}" class="bg-transparent border-0" type="submit">{{__('message.like')}}</button>
                                        </form>
                                        <form action="">
                                            <button style="font-size: 12px; color: gray" class="bg-transparent border-0">{{__('message.comment')}}</button>
                                        </form>
                                    @endauth
                                </div>
                                <div class="post-count" style="float: right">
                                    <span style="font-size: 12px; color: gray">{{$post->likes}} {{__('message.likes')}}</span>
                                    <span style="font-size: 12px; color: gray; margin-left: 10px">{{count($post->comments)}} {{__('message.comments')}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
