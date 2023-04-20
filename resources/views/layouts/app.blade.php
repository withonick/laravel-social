<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>@yield('title')</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <link href="{{asset('https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css')}}" rel="stylesheet">


    <link
        class="jsbin"
        href="{{asset('http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/base/jquery-ui.css')}}"
        rel="stylesheet"
        type="text/css"
    />
    <script
        class="jsbin"
        src="{{asset('http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js')}}"
    ></script>
    <script
        class="jsbin"
        src="{{asset('http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.0/jquery-ui.min.js')}}"
    ></script>

    <!-- Favicons -->
    <link href="{{asset('navbar/assets/img/favicon.png')}}" rel="icon">
    <link href="{{asset('navbar/assets/img/apple-touch-icon.png')}}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="{{asset('https://fonts.gstatic.com')}}" rel="preconnect">
    <link href="{{asset('https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i')}}" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{asset('navbar/assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('navbar/assets/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
    <link href="{{asset('navbar/assets/vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet">
    <link href="{{asset('navbar/assets/vendor/quill/quill.snow.css')}}" rel="stylesheet">
    <link href="{{asset('navbar/assets/vendor/quill/quill.bubble.css')}}" rel="stylesheet">
    <link href="{{asset('navbar/assets/vendor/remixicon/remixicon.css')}}" rel="stylesheet">
    <link href="{{asset('navbar/assets/vendor/simple-datatables/style.css')}}" rel="stylesheet">
    <link href="{{asset('navbar/assets/css/style.css')}}" rel="stylesheet">

</head>

<body>

<header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
        <a href="{{route('index')}}" class="logo d-flex align-items-center">
            <img src="{{asset('navbar/assets/img/logo.png')}}" alt="">
            <span class="d-none d-lg-block">Post</span>
        </a>
        <i class="bi bi-list toggle-sidebar-btn"></i>
    </div>

    <div class="search-bar">
        <form class="search-form d-flex align-items-center" method="POST" action="#">
            <input type="text" name="query" placeholder="Search" title="Enter search keyword">
            <button type="submit" title="Search"><i class="bi bi-search"></i></button>
        </form>
    </div>

    <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center">

            <li class="nav-item d-block d-lg-none">
                <a class="nav-link nav-icon search-bar-toggle " href="#">
                    <i class="bi bi-search"></i>
                </a>
            </li>

            <li class="nav-item dropdown">

                <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
                    <i class="bi bi-bell"></i>
                    <span class="badge bg-primary badge-number">4</span>
                </a>

                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
                    <li class="dropdown-header">
                        You have 4 new notifications
                        <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li class="notification-item">
                        <i class="bi bi-exclamation-circle text-warning"></i>
                        <div>
                            <h4>Lorem Ipsum</h4>
                            <p>Quae dolorem earum veritatis oditseno</p>
                            <p>30 min. ago</p>
                        </div>
                    </li>

                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li class="notification-item">
                        <i class="bi bi-x-circle text-danger"></i>
                        <div>
                            <h4>Atque rerum nesciunt</h4>
                            <p>Quae dolorem earum veritatis oditseno</p>
                            <p>1 hr. ago</p>
                        </div>
                    </li>

                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li class="notification-item">
                        <i class="bi bi-check-circle text-success"></i>
                        <div>
                            <h4>Sit rerum fuga</h4>
                            <p>Quae dolorem earum veritatis oditseno</p>
                            <p>2 hrs. ago</p>
                        </div>
                    </li>

                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li class="notification-item">
                        <i class="bi bi-info-circle text-primary"></i>
                        <div>
                            <h4>Dicta reprehenderit</h4>
                            <p>Quae dolorem earum veritatis oditseno</p>
                            <p>4 hrs. ago</p>
                        </div>
                    </li>

                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li class="dropdown-footer">
                        <a href="#">Show all notifications</a>
                    </li>

                </ul>

            </li>

            <li class="nav-item dropdown">

                <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
                    <i class="bi bi-chat-left-text"></i>
                    <span class="badge bg-success badge-number">3</span>
                </a>

                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow messages">
                    <li class="dropdown-header">
                        You have 3 new messages
                        <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li class="message-item">
                        <a href="#">
                            <img src="{{asset('navbar/assets/img/messages-1.jpg')}}" alt="" class="rounded-circle">
                            <div>
                                <h4>Maria Hudson</h4>
                                <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                                <p>4 hrs. ago</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li class="message-item">
                        <a href="#">
                            <img src="{{asset('navbar/assets/img/messages-2.jpg')}}" alt="" class="rounded-circle">
                            <div>
                                <h4>Anna Nelson</h4>
                                <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                                <p>6 hrs. ago</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li class="message-item">
                        <a href="#">
                            <img src="{{asset('navbar/assets/img/messages-3.jpg')}}" alt="" class="rounded-circle">
                            <div>
                                <h4>David Muldon</h4>
                                <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                                <p>8 hrs. ago</p>
                            </div>
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li class="dropdown-footer">
                        <a href="#">Show all messages</a>
                    </li>
                </ul>
            </li>

            <li class="nav-item">
                <a class="nav-link nav-icon" href="{{route('messenger.index')}}">
                    <i class="bi bi-messenger"></i>
{{--                    <span class="badge bg-success badge-number">3</span>--}}
                </a>
            </li>
        </ul>
    </nav>
</header>

<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{route('index')}}">
                <i class="bi bi-app"></i>
                <span>{{__('message.home')}}</span>
            </a>
        </li><!-- End Profile Page Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed" href="pages-faq.html">
                <i class="ri-search-2-line"></i>
                <span>{{__('message.search')}}</span>
            </a>
        </li>

        @guest()
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{route('login.form')}}">
                    <i class="bi bi-door-closed"></i>
                    <span>{{__('message.login')}}</span>
                </a>
            </li>
        @endguest
        @auth()
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{route('profile.show', Auth::user())}}">
                    <i class="bi bi-file-person-fill"></i>
                    <span>{{__('message.profile')}}</span>
                </a>
            </li>
        @endauth
        <li class="nav-item">
            <a href="{{route('settings')}}" class="nav-link collapsed">
                <i class="bx bx-cog"></i>
                <span>{{__('message.settings')}}</span>
            </a>
        </li>

        @can('control', \App\Models\User::class)
            <li class="nav-item">
                <a href="{{route('control.index')}}" class="nav-link collapsed">
                    <i class="bx bx-cog"></i>
                    <span>Control</span>
                </a>
            </li>
        @endcan
    </ul>

</aside>


@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<main id="main" class="main">
    @if (session('message'))
        <div class="alert alert-success justify-content-center" role="alert" style="width: 90%; position: fixed; bottom: 0; z-index:1000">
            {{ session('message') }}
        </div>
    @endif
    @yield('content')
</main>

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- Vendor JS Files -->
<script src="{{asset('navbar/assets/vendor/apexcharts/apexcharts.min.js')}}"></script>
<script src="{{asset('navbar/assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('navbar/assets/vendor/chart.js/chart.min.js')}}"></script>
<script src="{{asset('navbar/assets/vendor/echarts/echarts.min.js')}}"></script>
<script src="{{asset('navbar/assets/vendor/quill/quill.min.js')}}"></script>
<script src="{{asset('navbar/assets/vendor/simple-datatables/simple-datatables.js')}}"></script>
<script src="{{asset('navbar/assets/vendor/tinymce/tinymce.min.js')}}"></script>
<script src="{{asset('navbar/assets/vendor/php-email-form/validate.js')}}"></script>

<!-- Template Main JS File -->
<script src="{{asset('navbar/assets/js/main.js')}}"></script>

</body>

</html>
