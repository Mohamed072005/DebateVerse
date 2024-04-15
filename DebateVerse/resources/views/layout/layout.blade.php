<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'home')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
    <style>
        body{
            background-color: #f9fafb;
        }

        .navBar {
            background-color: #efefef;
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
        }

        .debate-vote-left {
            background: none;
            border: none;
            border-right: 0.3px solid #b1b2bf;
            border-bottom-left-radius: 50px;
            border-top-left-radius: 50px;
        }

        .debate-vote-right {
            background: none;
            border: none;
            border-left: 0.3px solid #b1b2bf;
            border-bottom-right-radius: 50px;
            border-top-right-radius: 50px;
        }

        .debate-vote-right-checked{
            background-color: #f43757;
            color: white;
            border-bottom-right-radius: 50px;
            border-top-right-radius: 50px;
        }

        .debate-vote-left-checked{
            background-color: #58f84e;
            color: white;
            border-bottom-left-radius: 50px;
            border-top-left-radius: 50px;
        }

        .debate-actions:hover {
            background-color: #b1b2bf;
        }

        .debate-actions {
            border: none;
        }

        .debate-vote-left:hover {
            background-color: #b1b2bf;
        }

        .debate-vote-right:hover {
            background-color: #b1b2bf;
        }

        main {
            margin-top: 100px;
        }

        .profile-page .profile-body .left-wrapper .social-links a {
            width: 30px;
            height: 30px;
        }

        .profile-page .profile-body .right-wrapper .latest-photos > .row {
            margin-right: 0;
            margin-left: 0;
        }

        .profile-page .profile-body .right-wrapper .latest-photos > .row > div {
            padding-left: 3px;
            padding-right: 3px;
        }

        .profile-page .profile-body .right-wrapper .latest-photos > .row > div figure {
            transition: all .3s ease-in-out;
            margin-bottom: 6px;
        }

        .profile-page .profile-body .right-wrapper .latest-photos > .row > div figure:hover {

            transform: scale(1.06);
        }

        .profile-page .profile-body .right-wrapper .latest-photos > .row > div figure img {
            border-radius: .25rem;
        }

        .rtl .profile-page .profile-header .cover .cover-body .profile-name {
            margin-left: 0;
            margin-right: 17px;
        }

        .grid-margin {
            margin-bottom: 1rem;
        }

        .card {
            box-shadow: 0 0 10px 0 rgba(183, 192, 206, 0.2);
        }
        .rounded {
            border-radius: 0.25rem !important;
        }
        .card {
            position: relative;
            display: flex;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            border: 1px solid #f2f4f9;
            border-radius: 0.25rem;
        }

        .aside div {
            height: 50px;
            width: 100%;
            margin-bottom: 10px;
            border-radius: 25px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .aside div:hover {
            background-color: #e2e8f0;
            color: #1a202c;
        }

        .button-to-profile {
            background: none;
            border: none;
        }

        .rounded-right-pill{
            border-bottom-right-radius: 50px;
            border-top-right-radius: 50px;
        }

        .rounded-left-pill {
            border-top-left-radius: 50px;
            border-bottom-left-radius: 50px;
        }

    </style>
</head>
<body>
<header class="p-2 navBar mb-3">
    <div class="container d-flex justify-content-between align-items-center">
        <div class="w-25">
            <a href="{{ route('home') }}" class="navbar-brand">
                <h2 class="text-primary">Debate<span class="text-dark">Verse</span></h2>
            </a>
        </div>
        <div class="dropdown d-none d-md-block">
            <button class="btn btn-dark dropdown-toggle" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                @if(!Auth::user()->first_name == null)
                    {{ Auth::user()->first_name }}
                @else
                    actions
                @endif
            </button>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                @if(!Auth::id() == null)
                <li><a class="dropdown-item" href="#">Profile</a></li>
                <li><a class="dropdown-item" href="#">Settings</a></li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="{{ route('logout') }}">Logout</a></li>
                @else
                    <li><a class="dropdown-item" href="{{ route('to.login') }}">Login</a></li>
                @endif
                <li>
                    <div class="offcanvas-content">
                            <button class="dropdown-item" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling">
                            Aside
                        </button>
                    </div>
                </li>
            </ul>
        </div>
        <div class="offcanvas-content d-block d-md-none">
            <button class="btn btn-secondary d-flex justify-content-center" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling">
                <i class="fa fa-bars burger-menu" aria-hidden="true"></i>
                </button>
        </div>

        <div class="offcanvas offcanvas-start" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasScrollingLabel">DebateVerse</h5>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <div class="">
                    <aside class="aside p-2">
                        <div class="">
                            <a class="navbar-brand" href="{{ route('dashboard') }}">
                                <h4 class="">Dashboard</h4>
                            </a>
                        </div>
                        <div class="">
                            <a class="navbar-brand" href="">
                                <h4 class="">Your Tickets</h4>
                            </a>
                        </div>
                    </aside>
                </div>
            </div>
        </div>
    </div>
</header>
<main class="container ">

    <div class="profile-page ">
        <div class="row profile-body">
            <!-- left wrapper start -->
            <div class="d-none d-md-block col-md-4 col-xl-3 left-wrapper">
                <div class="card rounded">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <div class="">
                                <a href="{{ route('profile') }}" class="navbar-brand">
                                    @if(Auth::user()->gender_id == 1)
                                        <img class="img-xs rounded-circle" src="{{ asset('asset/male.png') }}" alt="">
                                    @else
                                        <img class="img-xs rounded-circle" src="{{ asset('asset/female.png') }}" alt="">
                                    @endif
                                <h6 class="d-inline">{{ Auth::user()->user_name }}</h6>
                                </a>
                            </div>

                            <div class="dropdown">
                                <button class="btn p-0" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal icon-lg text-muted pb-3px">
                                        <circle cx="12" cy="12" r="1"></circle>
                                        <circle cx="19" cy="12" r="1"></circle>
                                        <circle cx="5" cy="12" r="1"></circle>
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <div class="mt-3 d-flex align-items-center">
                            <a href="" class="navbar-brand">
                            <h5 class="text-muted"><i class="fa fa-group" aria-hidden="true"></i> Friends</h5>
                            </a>
                        </div>
                        <div class="mt-3 d-flex align-items-center">
                            <a href="{{ route('logout') }}" class="navbar-brand">
                                <h5 class="text-muted"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</h5>
                            </a>
                        </div>

                    </div>
                </div>
            </div>

            @yield('content')

            <div class="d-none d-xl-block col-xl-3 right-wrapper">
                <div class="row">
                    <div class="col-md-12 grid-margin">
                        <div class="card rounded">
                            <div class="card-body">
                                <h5 class="card-title">Friend Suggestions</h5>
                                @foreach($users as $user)
                                <div class="d-flex justify-content-between mb-2 pb-2">
                                    <div class="d-flex align-items-center hover-pointer">
                                        @if($user->gender_id == 1)
                                            <img class="img-xs rounded-circle" src="{{ asset('asset/male.png') }}" alt="">
                                        @else
                                            <img class="img-xs rounded-circle" src="{{ asset('asset/female.png') }}" alt="">
                                        @endif
                                        <div class="ml-2">
                                            <p>{{ $user->user_name }}</p>
                                            <p class="tx-11 text-muted">12 Mutual Friends</p>
                                        </div>
                                    </div>
                                    <button class="btn btn-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user-plus" data-toggle="tooltip" title="" data-original-title="Connect">
                                            <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                            <circle cx="8.5" cy="7" r="4"></circle>
                                            <line x1="20" y1="8" x2="20" y2="14"></line>
                                            <line x1="23" y1="11" x2="17" y2="11"></line>
                                        </svg>
                                    </button>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- right wrapper end -->
        </div>
    </div>
</main>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
</body>
</html>
