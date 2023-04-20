@extends('layouts.app')

@section('title', 'Жалоба')

@section('content')

    <div class="col-md-12 d-flex justify-content-center">
        <form action="{{route('posts.complain')}}" method="post">
            @csrf
            <input type="hidden" value="{{$post->id}}" name="post_id">
            <label for="complain" >Напишите причину жалобы:</label>
            <div class="mt-2">
                <textarea name="explanation" class="form-control" cols="30" rows="10"></textarea>
            </div>
            <div class="mt-2">
                <button type="submit" class="btn btn-danger">Отправить жалобу</button>
            </div>
        </form>
    </div>

@endsection
