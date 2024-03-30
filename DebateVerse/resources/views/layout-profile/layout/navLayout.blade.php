<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
    <style>
        body {
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
            margin-top: 100px;
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
<main class="container">
    @yield('content')
</main>
</body>
</html>
