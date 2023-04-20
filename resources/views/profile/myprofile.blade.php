@extends('layouts.app')
@section('title', 'Профиль')

@section('content')
    <div style="width: 100%; background: white; padding: 20px">
        {{$user->firstname . " " . $user->surname}} <br>
        <span style="font-size: 14px; color: #DBDBDB">{{__('message.allposts')}}: {{count($user->posts)}}</span>
    </div>

    <div>
        <div class="img-container" style="background: white; padding: 20px">

            <img style="cursor: pointer; border: 1px solid #DBDBDB" data-bs-toggle="modal" data-bs-target="#basicModal" src="{{$user->profile_img}}" class="rounded-circle" width="50" height="50">
            <div class="modal fade" id="basicModal" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">{{__('message.changeimage')}}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{route('profile.updateimg')}}" method="post" enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
                                <input type="file" class="form-control" name="profile_img">

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('cancel')}}</button>
                            <button type="submit" class="btn btn-primary">{{__('message.save')}}</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div style="background: white; padding-left: 20px; padding-bottom: 20px;">
            <span style="font-weight: bold">{{$user->firstname . " " . $user->surname}}
                @if($user->verified)
                    <img src="{{asset('https://upload.wikimedia.org/wikipedia/commons/thumb/e/e4/Twitter_Verified_Badge.svg/1200px-Twitter_Verified_Badge.svg.png')}}" alt="" width="15" style="margin-bottom: 1px;">
                @endif
            </span>
            <br>
            <span style="font-size: 14px; color: #DBDBDB">{{"@" . $user->username}}</span>
            <br>
            <span style="font-size: 14px; color: #C9C9C9">{{__('message.register')}}: {{$user->created_at->diffForHumans()}}</span>
            <br>
            <span style="font-size: 14px; color: #C9C9C9; cursor:pointer;" data-bs-toggle="modal" data-bs-target="#addMoney">Ваш баланс: {{$user->balance}} KZT</span>

            <div class="modal fade" id="addMoney" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Пополнить баланс</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{route('profile.money')}}" method="post">
                            @csrf
                            @method('PUT')
                        <div class="modal-body">
                            <div class="mt-2">
                                <input type="number" class="form-control" name="balance" placeholder="Сумма">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('message.cancel')}}</button>
                            <button type="submit" class="btn btn-primary">{{__('message.send')}}</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
            <br>
                <form action="{{route('logout')}}" method="post">
                    @csrf
                    <button style="background: black; color: white; margin-top: 10px; border-radius: 20px; padding: 6px 12px; font-size: 12px; font-weight: bold">{{__('message.logout')}}</button>
                </form>
        </div>
        <div class="d-flex justify-content-center" id="profile-links" style="border-bottom: 1px solid #ECECEC; background: white">
            <a href="#">{{__('message.posts')}}</a>
            <a href="#">{{__('message.postandans')}}</a>
            <a href="#">{{__('message.like')}}</a>
        </div>

        <div class="user-posts" style="background: white; padding-top: 30px; padding-bottom: 15px">
            @foreach($user->posts as $post)
                <div class="col-md-8" style="margin-right: auto; margin-left: auto;">
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
                                                <a href="#" class="dropdown-item"><button type="submit" class="border-0 bg-transparent">Удалить</button></a>
                                            </form></li>
                                    @endcan
                                </ul>

                                <span><a href="{{route('profile.show', $post->user)}}" style="margin-left: 15px; margin-top: 5px; color: black">{{$post->user->firstname . " " . $post->user->surname}}
                                        @if($user->verified)
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
                                        <form action="{{route('posts.show', $post->id)}}">
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

    {{--    <form action="{{route('logout')}}" method="post">--}}
    {{--        @csrf--}}
    {{--        <button type="submit" class="btn btn-warning">Logout</button>--}}
    {{--    </form>--}}
@endsection
