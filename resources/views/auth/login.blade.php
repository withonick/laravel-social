@extends('layouts.app')

@section('title', 'Войти')

@section('content')
    <div class="container">
        <section class="section register min-vh-50 d-flex flex-column align-items-center justify-content-center py-2">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                        <div class="d-flex justify-content-center py-4">
                            <a href="index.html" class="logo d-flex align-items-center w-auto">
                                <img src="{{asset('navbar/assets/img/logo.png')}}" alt="">
                                <span class="d-none d-lg-block">Post</span>
                            </a>
                        </div><!-- End Logo -->

                        <div class="card mb-3">

                            <div class="card-body">

                                <div class="pt-4 pb-2">
                                    <h5 class="card-title text-center pb-0 fs-4">{{__('message.loginacc')}}</h5>
                                    <p class="text-center small">{{__('message.enteremailandpass')}}</p>
                                </div>

                                <form class="row g-3 needs-validation" novalidate action="{{route('login')}}" method="post">
                                    @csrf
                                    <div class="col-12">
                                        <label for="yourEmail" class="form-label">{{__('message.email')}}</label>
                                        <div class="input-group has-validation">
                                            <span class="input-group-text" id="inputGroupPrepend">@</span>
                                            <input type="email" name="email" class="form-control" id="yourEmail" required>
                                            <div class="invalid-feedback">{{__('message.enteremail')}}</div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <label for="yourPassword" class="form-label">{{__('message.password')}}</label>
                                        <input type="password" name="password" class="form-control" id="yourPassword" required>
                                        <div class="invalid-feedback">{{__('message.enterpassword')}}</div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="remember" value="true" id="rememberMe">
                                            <label class="form-check-label" for="rememberMe">{{__('message.rememberme')}}</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <button class="btn btn-primary w-100" type="submit">{{__('message.signin')}}</button>
                                    </div>
                                    <div class="col-12">
                                        <p class="small mb-0">{{__('message.notregisteryet')}} <a href="{{route('register.form')}}">{{__('message.signup')}}</a></p>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section>

    </div>
@endsection
