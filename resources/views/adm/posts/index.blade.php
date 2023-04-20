@extends('layouts.adm')

@section('title', 'Все посты')

@section('content')

    <div class="table-stats order-table ov-h">
        <table class="table ">
            <thead>
            <tr>
                <th class="serial">#</th>
                <th class="avatar">Avatar</th>
                <th>Post ID</th>
                <th>Fullname</th>
                <th>Post</th>
                <th>Comments</th>
                <th>Likes</th>
                <th>Status</th>
            </tr>
            </thead>
            <tbody>
    @for($i = 0; $i<count($posts); $i++)
        <tr>
            <td class="serial">{{$i+1}}.</td>
            <td class="avatar">
                <div class="round-img">
                    <a href="#"><img class="rounded-circle" src="{{$posts[$i]->user->profile_img}}" alt=""></a>
                </div>
            </td>
            <td>{{$posts[$i]->id}}</td>
            <td><span class="name">{{$posts[$i]->user->firstname . " " . $posts[$i]->user->surname}}</span></td>
            <td><span class="product">{{$posts[$i]->message}}</span></td>
            <td><span class="count">{{count($posts[$i]->comments)}}</span></td>
            <td>{{$posts[$i]->likes}}</td>
            <td>
                <span class="badge badge-complete">Active</span>
            </td>
        </tr>
    @endfor
            </tbody>
        </table>
    </div>

@endsection
