@extends('layouts.app')

@section('content')
    <div class="container">

        <section class="section register min-vh-50 d-flex flex-column align-items-center justify-content-center">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
                        <div class="card mb-3">

                            <div class="card-body">

                                <div class="pt-4 pb-2">
                                    <h5 class="card-title text-center pb-0 fs-4">{{__('message.signup')}}</h5>
                                    <p class="text-center small">{{__('message.enterdetails')}}</p>
                                </div>

                                <form class="row g-3 needs-validation" novalidate action="{{route('register')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="col-12">
                                        <label for="yourFirstName" class="form-label">{{__('message.firstname')}}</label>
                                        <input type="text" name="firstname" class="form-control" id="yourFirstName" required>
                                        <div class="invalid-feedback">{{__('message.enterfirstname')}}</div>
                                    </div>

                                    <div class="col-12">
                                        <label for="yourSecondName" class="form-label">{{__('message.surname')}}</label>
                                        <input type="text" name="surname" class="form-control" id="yourSecondName" required>
                                        <div class="invalid-feedback">{{__('message.entersurname')}}</div>
                                    </div>

                                    <div class="col-12">
                                        <label for="yourEmail" class="form-label">{{__('message.email')}}</label>
                                        <input type="email" name="email" class="form-control" id="yourEmail" required>
                                        <div class="invalid-feedback">{{__('message.enteremail')}}</div>
                                    </div>

                                    <div class="col-12">
                                        <label for="yourUsername" class="form-label">{{__('message.username')}}</label>
                                        <div class="input-group has-validation">
                                            <span class="input-group-text" id="inputGroupPrepend">@</span>
                                            <input type="text" name="username" class="form-control" id="yourUsername" required>
                                            <div class="invalid-feedback">{{__('message.enterusername')}}</div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <label for="yourPassword" class="form-label">{{__('message.password')}}</label>
                                        <input type="password" name="password" class="form-control" id="yourPassword" required>
                                        <div class="invalid-feedback">{{__('message.enterpassword')}}</div>
                                    </div>
                                    <div class="col-12">
                                        <label for="yourConfirmPassword" class="form-label">{{__('message.confirmpassword')}}</label>
                                        <input type="password" name="password_confirmation" class="form-control" id="yourConfirmPassword" required>
                                        <div class="invalid-feedback">{{__('message.confirmpassword')}}!</div>
                                    </div>
                                    <div class="col-12">
                                        <label for="yourConfirmPassword" class="form-label">{{__('message.profileimg')}}:</label>
                                        <input type="file" name="profile_img" class="form-control">
                                        <div class="invalid-feedback">{{__('message.enterimage')}}</div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-check">
                                            <input class="form-check-input" name="terms" type="checkbox" value="" id="acceptTerms" required>
                                            <label class="form-check-label" for="acceptTerms">{{__('message.iagree')}} <a href="#">{{__('message.terms')}}</a></label>
                                            <div class="invalid-feedback">{{__('message.agreeterms')}}.</div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <button class="btn btn-primary w-100" type="submit">{{__('message.signup')}}</button>
                                    </div>
                                    <div class="col-12">
                                        <p class="small mb-0">{{__('message.alreadyhaveacc')}} <a href="{{route('login.form')}}">{{__('message.signin')}}</a></p>
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
