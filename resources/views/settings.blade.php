@extends('layouts.app')

@section('title', 'Настройки')

@section('content')

{{--    <div class="bg-white" style="padding-top: 20px; padding-left: 20px">--}}
{{--        <label for="dropdown">{{__('message.selectln')}} </label>--}}
{{--        <div class="mt-2">--}}
{{--            <div class="dropdown">--}}
{{--                <a class="btn btn-outline-primary dropdown-toggle" style="width: 150px" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">--}}
{{--                    {{config('app.languages')[app()->getLocale()]}}--}}
{{--                </a>--}}

{{--                <ul class="dropdown-menu">--}}
{{--                    @foreach(config('app.languages') as $ln => $lang)--}}
{{--                        <li><a class="dropdown-item" href="{{route('switch.lang', $ln)}}">{{$lang}}</a></li>--}}
{{--                    @endforeach--}}
{{--                </ul>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}




<div class="container bg-white" style="border-radius: 20px">
    <ul class="sidebar-nav p-4">
        @auth()
            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#account-settings" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-menu-button-wide"></i><span>Ваша учетная запись</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="account-settings" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="components-alerts.html" data-bs-toggle="modal" data-bs-target="#account-info">
                            <i class="bi bi-person-fill" style="font-size: 18px"></i><span>Сведения об учетной записи</span>
                        </a>


                        <div class="modal fade" id="account-info" tabindex="-1" aria-labelledby="accountinfoModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Сведение об аккаунте</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body p-4">
                                        <form action="{{route('profile.update')}}" method="post">
                                            @csrf
                                            @method('PUT')
                                        <div class="mt-2">
                                            <label for="name">Имя:</label>
                                            <input class="form-control" name="firstname" type="text" value="{{Auth::user()->firstname}}">
                                        </div>
                                        <div class="mt-2">
                                            <label for="name">Фамилия:</label>
                                            <input class="form-control" name="surname" type="text" value="{{Auth::user()->surname}}">
                                        </div>
                                        <div class="mt-2">
                                            <label for="name">Логин:</label>
                                            <input class="form-control" name="username" type="text" value="{{Auth::user()->username}}">
                                        </div>
                                        <div class="mt-2">
                                            <label for="name">Email:</label>
                                            <input class="form-control" type="email" name="email" value="{{Auth::user()->email}}">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
                                        <button type="submit" class="btn btn-primary">Обновить</button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </li>
                    <li>
                        <a href="#">
                            <i class="bi bi-key" style="font-size: 18px"></i><span>Изменения пароля</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" data-bs-toggle="modal" data-bs-target="#verify-modal">
                            <i class="bi bi-check2-circle" style="font-size: 18px"></i><span>Подтверждение аккаунта</span>
                        </a>

                        <div class="modal fade" id="verify-modal" tabindex="-1" aria-labelledby="verify-modalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Запросить подтверждение</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <h4>Подтвердить известность</h4>

                                                <form action="{{route('profile.verify')}}" method="post" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="mt-4">
                                                        <label for="name">Имя пользователя</label>
                                                        <input type="text" class="form-control" disabled value="{{Auth::user()->username}}">
                                                        <input type="hidden" value="{{Auth::user()->id}}" name="user_id">
                                                    </div>
                                                    <div class="mt-4">
                                                        <label for="passport">Паспорт или удостворение личности</label>
                                                        <input type="file" name="passport" class="form-control">
                                                    </div>
                                                    <div class="mt-4">
                                                        <label for="passport">Ссылка на статью про вас</label>
                                                        <input type="text" name="article" class="form-control">
                                                    </div>
                                                    <div class="mt-4">
                                                        <button type="submit" class="btn btn-primary">{{__('message.send')}}</button>
                                                    </div>
                                                </form>
                                            </div>

                                            <div class="col-sm-6">
                                                <h4 class="text-center">Купить подписку на месяц</h4>

                                                <form action="{{route('profile.buy', Auth::user()->id)}}" method="post" class="text-center">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="mt-4">
                                                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/e/e4/Twitter_Verified_Badge.svg/800px-Twitter_Verified_Badge.svg.png" width="150">
                                                    </div>
                                                    <div class="mt-4 text-center">
                                                        <h2><code>2 300 KZT/Month</code></h2>
                                                    </div>
                                                    <div class="mt-4">
                                                        <button type="submit" data-bs-target="#buycheck2" data-bs-toggle="modal" class="btn btn-primary">Подписаться</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <a href="components-breadcrumbs.html">
                            <i class="bi bi-person-x-fill" style="font-size: 18px"></i><span>Отключение аккаунта</span>
                        </a>
                    </li>
                    <li>
                        <a href="components-breadcrumbs.html">
                            <i class="bi bi-door-open" style="font-size: 18px"></i><span>Выйти</span>
                        </a>
                    </li>
                </ul>
            </li>
        @endauth

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#app-settings" data-bs-toggle="collapse" href="#">
                <i class="bi bi-menu-button-wide"></i><span>Приложение</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="app-settings" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="components-alerts.html">
                        <i class="bi bi-translate" style="font-size: 18px"></i><span>Выбрать язык</span>
                    </a>
                </li>
                <li>
                    <a href="components-accordion.html">
                        <i class="bi bi-patch-question" style="font-size: 18px"></i><span>Тех. поддержка</span>
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</div>


@endsection
