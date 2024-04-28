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
                        </div>

                        @if(Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                            <div class="mt-3 d-flex align-items-center">
                                <a href="{{ route('dashboard') }}" class="navbar-brand">
                                    <h5 class="text-muted"><i class="fa fa-dashboard" aria-hidden="true"></i> Dashboard</h5>
                                </a>
                            </div>
                        @endif
                        <div class="mt-3 d-flex align-items-center">
                            <a href="{{ route('friends') }}" class="navbar-brand">
                            <h5 class="text-muted"><i class="fa fa-group" aria-hidden="true"></i> Friends</h5>
                            </a>
                        </div>
                        <div class="mt-3 d-flex align-items-center">
                            <a href="{{ route('contact') }}" class="navbar-brand">
                                <h5 class="text-muted"><i class="fa fa-commenting" aria-hidden="true"></i> Messenger</h5>
                            </a>
                        </div>
                        @if(Auth::user()->role_id == 3)
                        <div class="mt-3 d-flex align-items-center">
                            <a href="{{ route('to.send.suggestions') }}" class="navbar-brand">
                                <h5 class="text-muted"><i class="fa fa-question-circle"></i> suggestion</h5>
                            </a>
                        </div>
                        @endif
                        @if(Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
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
                        <div class="mt-3 d-flex align-items-center">
                            <a href="{{ route('logout') }}" class="navbar-brand">
                                <h5 class="text-muted"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</h5>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- suggestions Modals -->

            <div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalToggleLabel">Suggestions</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            @foreach(Auth::user()->receiverSuggestionsMessage as $suggestions)
                                <div class="rounded d-flex justify-content-evenly align-items-center mb-2" style="background-color: #c1c1c1">
                                    <p class="mt-3"><strong>{{ $suggestions->sender->user_name }}</strong> has send a suggestion</p>
                                </div>
                                <div>
                                    <p class="tx-11 text-muted d-block">{{ $suggestions->created_at->diffForHumans() }}</p>
                                </div>
                            @endforeach
                            @if(Auth::user()->receiverSuggestionsMessage->count() == 0)
                                <div class="d-flex justify-content-center">
                                    <h4>There is no Notifications</h4>
                                </div>
                            @endif
                        </div>
                        <div class="modal-footer">
                        </div>
                    </div>
                </div>
            </div>

            @yield('content')

            <div class="d-none d-xl-block col-xl-3 right-wrapper">
                <div class="row">
                    <div class="col-md-12 grid-margin">
                        @if(!Auth::user()->receiveRequest == null)
                        <div class="card rounded mb-3">

                            <div class="card-body">
                                <h5>Request Friend</h5>
                                    @foreach(Auth::user()->receiveRequest as $request)
                                        @if($request->status == 0)
                                        <div class="d-flex justify-content-between mb-2 pb-2">
                                            <div class="d-flex align-items-center hover-pointer">
                                                @if($request->sender->gender_id == 1)
                                                    <img class="img-xs rounded-circle" src="{{ asset('asset/male.png') }}" alt="">
                                                @else
                                                    <img class="img-xs rounded-circle" src="{{ asset('asset/female.png') }}" alt="">
                                                @endif
                                                <div class="ml-2">
                                                    <p>{{ $request->sender->user_name }}</p>
                                                </div>
                                            </div>
                                            <div>
                                                <form action="{{ route('reject.request.friend', $request->sender_id) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="hidden" name="token" class="input-token" value="3d92ff394a72e41dd935d8099ad93fb3e81e32a0a0c4c2c4a76f0fbc46b62a3d">
                                                    <button class="btn btn-sm btn-flash-border-primary">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="text-danger" width="24" height="35" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                            <line x1="18" y1="6" x2="6" y2="18"></line>
                                                            <line x1="6" y1="6" x2="18" y2="18"></line>
                                                        </svg>
                                                    </button>
                                                </form>
                                                <form action="{{ route('accept.request.friend', $request->sender_id) }}" method="post">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="token" class="input-token" value="3d92ff394a72e41dd935d8099ad93fb3e81e32a0a0c4c2c4a76f0fbc46b62a3d">
                                                    <button class="btn btn-sm btn-flash-border-primary">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="text-success" width="24" height="35" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                            <polyline points="20 6 9 17 4 12"></polyline>
                                                        </svg>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                        @endif
                                    @endforeach
                            </div>

                        </div>
                        @endif
                        <div class="card rounded">
                            <div class="card-body" style="height: 75vh">
                                <h5 class="card-title">Friend Suggestions</h5>
                                <div class="form-floating m-2">
                                    <input type="text" name="" id="searchInput" class="form-control" placeholder="#">
                                    <label for="searchInput">tap user name...</label>
                                </div>
                                <div id="resultContainer" style="overflow: auto; height: 58vh; width: 250px">
                                    @foreach($users as $user)
                                        <div class="d-flex justify-content-between mb-2 pb-2">
                                            <div class="d-flex align-items-center hover-pointer">
                                                @if($user->gender_id == 1)
                                                    <img class="img-xs rounded-circle" src="{{ asset('asset/male.png') }}" alt="">
                                                @else
                                                    <img class="img-xs rounded-circle" src="{{ asset('asset/female.png') }}" alt="">
                                                @endif
                                                <div class="ml-2">
                                                    <a href="{{ route('users.profile', $user->id) }}" class="navbar-brand">
                                                        <p>{{ $user->user_name }}</p>
                                                    </a>
                                                </div>
                                            </div>
                                            @php
                                                $checkSend = null;
                                                $checkReceiver = null;
                                                foreach ($user->receiveRequest as $receiver){
                                                    if ($receiver->sender_id == Auth::id() && $receiver->status == 1){
                                                        $checkSend = true;
                                                        break;
                                                    }
                                                }

                                                foreach ($user->sendRequest as $sender){
                                                    if ($sender->receiver_id == Auth::id() && $sender->status == 1){
                                                        $checkReceiver = true;
                                                        break;
                                                    }
                                                }
                                            @endphp
                                            @if($checkSend || $checkReceiver)
                                                <div class="d-flex align-items-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="text-success" width="30" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                        <polyline points="20 6 9 17 4 12"></polyline>
                                                    </svg>
                                                </div>
                                            @else
                                                <form action="{{ route('send.friend.request', $user->id) }}" class="d-flex align-items-center" method="post">
                                                    @csrf
                                                    @method('POST')
                                                    <button type="submit" class="btn btn-icon">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user-plus" data-toggle="tooltip" title="" data-original-title="Connect">
                                                            <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                                            <circle cx="8.5" cy="7" r="4"></circle>
                                                            <line x1="20" y1="8" x2="20" y2="14"></line>
                                                            <line x1="23" y1="11" x2="17" y2="11"></line>
                                                        </svg>
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>

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
<script>
    let searchInput = document.getElementById('searchInput');
    let resultContainer = document.getElementById('resultContainer');
    searchInput.addEventListener('keyup', function (){
        let value = searchInput.value;

        let xhr = new XMLHttpRequest();
        xhr.open('GET', '/find/user/?user_name=' + value, true);
        xhr.onreadystatechange = function (){

            if (xhr.readyState === 4 && xhr.status === 200){
                resultContainer.innerHTML = '';
                resultContainer.innerHTML = xhr.response;
            }
        }
        xhr.send();
    })
</script>
</body>
</html>
