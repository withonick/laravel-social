@extends('layouts.app')

@section('title', 'Пост')

@section('content')
    <style>
        .img-sm {
            width: 46px;
            height: 46px;
        }

        .panel {
            border-radius: 0;
            border-bottom: 1px solid #DBDBDB;
            margin-bottom: 15px;
        }

        .panel .panel-footer, .panel>:last-child {
            border-bottom-left-radius: 0;
            border-bottom-right-radius: 0;
        }

        .panel .panel-heading, .panel>:first-child {
            border-top-left-radius: 0;
            border-top-right-radius: 0;
        }

        .panel-body {
            padding: 25px 20px;
        }


        .media-block .media-left {
            display: block;
            float: left
        }

        .media-block .media-right {
            float: right
        }

        .media-block .media-body {
            display: block;
            overflow: hidden;
            width: auto
        }

        .middle .media-left,
        .middle .media-right,
        .middle .media-body {
            vertical-align: middle
        }

        .thumbnail {
            border-radius: 0;
            border-color: #e9e9e9
        }

        .tag.tag-sm, .btn-group-sm>.tag {
            padding: 5px 10px;
        }

        .tag:not(.label) {
            background-color: #fff;
            padding: 6px 12px;
            border-radius: 2px;
            border: 1px solid #cdd6e1;
            font-size: 12px;
            line-height: 1.42857;
            vertical-align: middle;
            -webkit-transition: all .15s;
            transition: all .15s;
        }
        .text-muted, a.text-muted:hover, a.text-muted:focus {
            color: #acacac;
        }
        .text-sm {
            font-size: 0.9em;
        }
        .text-5x, .text-4x, .text-5x, .text-2x, .text-lg, .text-sm, .text-xs {
            line-height: 1.25;
        }

        .btn-trans {
            background-color: transparent;
            border-color: transparent;
            color: #929292;
        }

        .btn-icon {
            padding-left: 9px;
            padding-right: 9px;
        }

        .btn-sm, .btn-group-sm>.btn, .btn-icon.btn-sm {
            padding: 5px 10px !important;
        }

        .mar-top {
            margin-top: 15px;
        }
    </style>
    <div class="col-md-8" style="margin-left: auto; margin-right: auto;">
        <div class="card">
            <div class="card-header" style="border-bottom: 1px solid #DBDBDB;">
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
                    </ul>

                    <span><a href="{{route('profile.show', $post->user)}}" style="margin-left: 15px; margin-top: 5px; color: black">{{$post->user->firstname . " " . $post->user->surname}} <span style="color:gray;">{{"@".$post->user->username}}</span></a>
                            <br>
                            <span style="font-size: 14px; color: gray; margin-left: 15px">{{$post->created_at->diffForHumans()}}</span>
                        </span>
                </div>
                <div style="margin-left: 55px; margin-bottom: 10px; margin-top: 5px;">
                    <p style="color: black">{{$post->message}}</p>
                </div>
                @if($post->img != "noimg")
                    <div id="post-image" style="text-align: center; padding-bottom: 20px">
                        <img src="{{$post->img}}" id="post_image" alt="post" width="600" style="border-radius: 10px; border: 1px solid #DBDBDB">
                    </div>
                @endif

                <div class="post-btns" style="width: 610px; margin-left: auto; margin-right: auto;">
                    <div style="float: left; display: flex">
                        @auth()
                            <form action="{{route('posts.rate', $post->id)}}" method="post">
                                @csrf
                                <button style="font-size: 12px; color:{{ Auth::user()->likedPosts->contains($post->id) ? 'black' : 'gray'}}" class="bg-transparent border-0" type="submit">{{__('message.like')}}</button>
                            </form>
                        @endauth
                    </div>
                    <div class="post-count" style="float: right">
                        <span style="font-size: 12px; color: gray">{{$post->likes}} {{__('message.likes')}}</span>
                        <span style="font-size: 12px; color: gray; margin-left: 10px">{{count($post->comments)}} {{__('message.comments')}}</span>
                    </div>
                </div>
            </div>
            <div class="comment-section">
                <div class="container bootdey">
                    <div class="col-md-12 bootstrap snippets">
                        <div class="panel">
                            <div class="panel-body">
                                <form action="{{route('comment.store')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                <textarea class="form-control" name="text" rows="2" placeholder="{{__('message.entercomm')}}"></textarea>
                                <div class="mar-top clearfix">
                                    <input type="hidden" name="post_id" value="{{$post->id}}">
                                    <i id="comment_img" style="cursor:pointer;" class="bi bi-card-image"></i>
                                    <input id="comment_input" type="file" style="display: none" name="comment_image">
                                    <button class="btn btn-sm btn-primary pull-right" type="submit">{{__('message.comment')}}</button>
                                </div>
                                </form>
                            </div>
                        </div>
                        @foreach($post->comments as $comm)
                            <div class="panel">
                                <div class="panel-body">
                                    <div class="media-block">
                                        <a class="media-left" href="#"><img style="margin-right: 10px" class="img-circle img-sm rounded-circle" alt="Profile Picture" src="{{$comm->user->profile_img}}"></a>
                                        <div class="media-body">
                                            <div class="mar-btm">
                                                <a href="{{route('profile.show', $comm->user->id)}}" style="color: black; text-decoration: none" class="btn-link text-semibold media-heading box-inline">{{$comm->user->firstname . " " . $comm->user->surname}}</a>
                                                <p class="text-muted text-sm">{{$comm->created_at->diffForHumans()}}</p>
                                            </div>
                                            <p>{{$comm->text}}</p>
                                            <div class="comment-img">
                                                @if($comm->comment_image != "noimg")
                                                    <img style="border: 1px solid #DBDBDB; border-radius: 20px" src="{{$comm->comment_image}}", width="600">
                                                @endif
                                            </div>
                                            <div class="pad-ver" style="margin-top: 10px;">
                                                <div class="btn-group">
                                                    <a style="font-size: 12px" class="btn btn-sm btn-default btn-hover-success" href="#">{{__('message.like')}}</a>
                                                    <a style="font-size: 12px" class="btn btn-sm btn-default btn-hover-danger" href="#">{{__('message.report')}}</a>

                                                    <form action="{{route('comment.delete', $comm->id)}}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button style="font-size: 12px; padding: 0; margin: 0" type="submit" class="border-0 bg-transparent">{{__('message.delete')}}</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        let commentimg = document.getElementById('comment_img');
        let commentinput = document.getElementById('comment_input');

        commentimg.addEventListener('click', () => {
            commentinput.click();
        });

    </script>
@endsection
