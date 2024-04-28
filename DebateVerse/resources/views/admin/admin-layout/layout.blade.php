<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>
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

        main {
            margin-top: 40px;
        }

        .navbar-a-hover:hover {
            color: blue;
        }

        .navBottom {
            margin-top: 60px;
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
        <div class="position-relative d-flex align-items-center ms-auto">
            <button id="button" class="d-flex align-items-center focus:outline-none position-relative p-2" data-bs-toggle="modal" data-bs-target="#exampleModal" style="background: none; border: none">
                <i class="fa fa-bell fa-2x"></i>
                @if(Auth::user()->notificationReceiver->count() > 0)
                    <span class="position-absolute top-0 end-0 bg-danger text-white rounded-circle w-5 h-5 d-flex align-items-center justify-content-center text-xs" style="width: 23px">
                    {{ Auth::user()->notificationReceiver->count() }}
                </span>
                @endif
            </button>
        </div>
        <div class="offcanvas-content d-block d-md-none">
            <button class="btn btn-secondary d-flex justify-content-center" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling">
                <i class="fa fa-bars burger-menu" aria-hidden="true"></i>
            </button>
        </div>

        <div class="offcanvas offcanvas-start" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasScrollingLabel">Menu</h5>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <div class="">
                    <aside class="aside p-2">
                        <div class="">
                            <a class="navbar-brand" href="{{ route('profile') }}">
                                <h4 class="">Profile</h4>
                            </a>
                        </div>
                        @if(Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                            <div class="">
                                <a class="navbar-brand" href="{{ route('dashboard') }}">
                                    <h4 class="">Dashboard</h4>
                                </a>
                            </div>
                        @endif
                        @if(Auth::user()->role_id == 2)
                            <div class="mt-3 d-flex align-items-center">
                                <a data-bs-toggle="modal" href="#exampleModalToggle" class="navbar-brand">
                                    <h5 class="text-muted d-flex"><i class="fa fa-cogs mr-1"></i> suggestion
                                        @if(Auth::user()->receiverSuggestionsMessage->count() > 0)
                                            <span class="ml-3 top-0 end-0 bg-danger text-white rounded-circle w-5 h-5 d-flex align-items-center justify-content-center text-xs" style="width: 23px">{{ Auth::user()->receiverSuggestionsMessage->count() }}</span>
                                        @endif
                                    </h5>
                                </a>
                            </div>
                        @endif
                        <div class="">
                            <a class="navbar-brand" href="{{ route('friends') }}">
                                <h4 class="">Friends</h4>
                            </a>
                        </div>
                        <div class="">
                            <a class="navbar-brand" href="{{ route('contact') }}">
                                <h4 class="">Messenger</h4>
                            </a>
                        </div>
                        <div class="">
                            <a class="navbar-brand" href="{{ route('to.send.suggestions') }}">
                                <h4 class="">Suggestions</h4>
                            </a>
                        </div>
                        <div class="">
                            <a class="navbar-brand" href="{{ route('logout') }}">
                                <h4 class="">Logout</h4>
                            </a>
                        </div>
                    </aside>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                @foreach(Auth::user()->notificationReceiver as $notification)
                    <div class="rounded d-flex justify-content-evenly align-items-center mb-2" style="background-color: #c1c1c1">
                        <p class="mt-3"><strong>{{ $notification->notificationSender->user_name }}</strong> {{ $notification->message }}</p>
                        <form action="{{ route('destroy.notification', $notification->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button style="border: none; background: none">
                                <i class="fa fa-trash text-danger"></i>
                            </button>
                        </form>
                    </div>
                    <div>
                        <p class="tx-11 text-muted d-block">{{ $notification->created_at->diffForHumans() }}</p>
                    </div>
                @endforeach
                @if(Auth::user()->notificationReceiver->count() == 0)
                    <div class="d-flex justify-content-center">
                        <h4>There is no Notifications</h4>
                    </div>
                @else
                    <div class="d-flex justify-content-end">
                        <form action="{{ route('destroy.notifications') }}" method="post">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="deleteAll">
                            <button class="btn">Delete All <i class="fa fa-trash text-danger"></i></button>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
<!-- End Modal -->


<div class="container-fluid navBottom border border-bottom">
    <div class="container d-flex justify-content-evenly pt-2 pb-2">
        @if(Auth::user()->role_id == 1)
            <a href="{{ route('dashboard') }}" class="navbar-a-hover navbar-brand">Statistics</a>
        @endif
            <a href="{{ route('admin.suggestions') }}" class="navbar-a-hover navbar-brand">suggestion</a>
            <a href="{{ route('tags') }}" class="navbar-a-hover navbar-brand">Tags</a>
            <a href="{{ route('users') }}" class="navbar-a-hover navbar-brand">Users</a>
    </div>
</div>
<main>
    @yield('content')
</main>
</body>
</html>
