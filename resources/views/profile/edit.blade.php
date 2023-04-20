@extends('layouts.app')

@section('title', 'Редактировать профиль')

@section('content')
    <div class="col-ms-12 d-flex justify-content-center mt-4">
    <div class="col-md-6 bg-white p-4">
        <form action="{{route('profile.update')}}" method="post" class="row g-3 p-4">
            @csrf
            @method('PUT')
            <div class="col-12">
                <label for="inputNanme4" class="form-label">Имя:</label>
                <input type="text" class="form-control" id="inputNanme4" name="firstname" value="{{$user->firstname}}">
            </div>
            <div class="col-12">
                <label for="inputNanme4" class="form-label">Фамилия:</label>
                <input type="text" class="form-control" id="inputNanme4" name="surname" value="{{$user->surname}}">
            </div>
            <div class="col-12">
                <label for="inputNanme4" class="form-label">Логин:</label>
                <input type="text" class="form-control" id="inputNanme4" name="username" value="{{$user->username}}">
            </div>
            <div class="col-12">
                <label for="inputEmail4" class="form-label">Email</label>
                <input type="email" class="form-control" id="inputEmail4" name="email" value="{{$user->email}}">
            </div>
            <div class="col-12">
                <label for="inputAddress" class="form-label">Профиль</label>
                <input type="file" class="form-control" name="profile_img" value="{{$user->profile_img}}">
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary">Обновить профиль</button>
            </div>
        </form>
    </div>
    </div>
@endsection
