@extends('layouts.app')

@section('title', 'Главная страница')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @auth()
                <div class="card">
                    <div class="card-header d-flex">
                        <a href="{{route('profile.show', Auth::user())}}"><img style="border: 1px solid #DBDBDB; border-radius: 50%" src="{{Auth::user()->profile_img}}" alt="profile" width="50" height="50"></a>
                        <div id="post-review" contenteditable="true" style="outline: none; padding: 10px; width: 90%"></div>
                    </div>
                    <div id="post-image" style="text-align: center;">
                        <img src="#" id="post_image" alt="post" style="display: none">
                    </div>
                    <form action="{{route('posts.store')}}" class="d-flex align-items-center justify-content-center" method="post" enctype="multipart/form-data" style="padding: 10px;">
                        <i id="post_image_button" class='bi bi-card-image' style="cursor:pointer;"></i>
                        @csrf
                        <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                        <input type="file" style="display: none" id="post_image_input" name="img" onchange="readURL(this)" />
                        <textarea name="message" id="message" style="display: none"></textarea>
                        <button type="submit" class="btn btn-primary" style="margin-left: 600px">{{__('message.send')}}</button>
                    </form>
                </div>
            @endauth
        </div>
        @foreach($posts as $post)
            <div class="col-md-8">
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
                                @can('update', $post)
                                    <li><a class="dropdown-item" href="{{route('posts.edit', $post->id)}}">{{__('message.edit')}}</a></li>
                                @endcan
                                @can('delete', $post)
                                    <li>
                                        <form action="{{route('posts.destroy', $post->id)}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <a href="#" class="dropdown-item"><button type="submit" class="border-0 bg-transparent">
                                                {{__('message.delete')}}</button></a>
                                        </form></li>
                                    @endcan
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
                                    <button style="font-size: 12px; color: gray" class="bg-transparent border-0"><a style="color: gray"
                                            href="{{route('posts.show', $post->id)}}">{{__('message.comment')}}</a></button>
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
