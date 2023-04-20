@extends('layouts.app')

@section('title', 'Редактировать пост')

@section('content')

    <div class="row d-flex justify-content-center">
        <div class="col-sm-8">
        <form action="{{route('posts.update', $post->id)}}" method="post" class="bg-white p-4">
            @csrf
            @method('PUT')
            <div class="mt-3">
                <label for="message">{{__('message.message')}}:</label>
                <textarea name="message" class="form-control" cols="30" rows="10">{{$post->message}}</textarea>
            </div>
            @if($post->img !="noimg")
                <div class="mt-3 text-center">
                    <img src="{{$post->img}}" width="600">
                </div>
            @endif
            <div class="mt-3">
                <label for="message">{{__('message.image')}}:</label>
                <input type="file" class="form-control">
            </div>
            <div class="mt-3">
                <button class="btn btn-primary" type="submit">{{__('message.update')}}</button>
            </div>
        </form>
        </div>
    </div>

@endsection
