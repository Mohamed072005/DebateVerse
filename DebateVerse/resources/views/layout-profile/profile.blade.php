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

        .debate-actions:hover {
            background-color: #b1b2bf;
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

        .card.card-white {
            background-color: #fff;
            border: 1px solid transparent;
            border-radius: 4px;
            box-shadow: 0 0.05rem 0.01rem rgba(75, 75, 90, 0.075);
            padding: 25px;
        }

        .grid-margin {
            margin-bottom: 2rem;
        }

        .profile-timeline ul li .timeline-item-header img {
            width: 40px;
            height: 40px;
            float: left;
            margin-right: 10px;
            border-radius: 50%;
        }

        .profile-timeline ul li .timeline-item-header p {
            margin: 0;
            color: #000;
            font-weight: 500;
        }

        .profile-timeline ul li .timeline-item-header p span {
            margin: 0;
            color: #8e8e8e;
            font-weight: normal;
        }

        .profile-timeline ul li .timeline-item-header small {
            margin: 0;
            color: #8e8e8e;
        }

        .profile-timeline ul li .timeline-item-post>img {
            width: 100%;
        }

        .timeline-options a {
            display: block;
            margin-right: 20px;
            float: left;
            color: #2b2b2b;
            text-decoration: none;
        }

        .timeline-options a i {
            margin-right: 3px;
        }

        .timeline-options a:hover {
            color: #5369f8;
        }

        .timeline-comment .timeline-comment-header img {
            width: 30px;
            border-radius: 50%;
            float: left;
            margin-right: 10px;
        }

        .timeline-comment .timeline-comment-header p {
            color: #000;
            float: left;
            margin: 0;
            font-weight: 500;
        }

        .timeline-comment .timeline-comment-header small {
            font-weight: normal;
            color: #8e8e8e;
        }

        .post-options a {
            display: block;
            margin-top: 5px;
            margin-right: 20px;
            float: left;
            color: #2b2b2b;
            text-decoration: none;
            font-size: 16px !important;
        }

        .post-options a:hover {
            color: #5369f8;
        }

        .cd-timeline-content p,
        .cd-timeline-content .cd-read-more,
        .cd-timeline-content .cd-date {
            font-size: 14px;
        }

        .user-profile-card {
            text-align: center;
        }

        .user-profile-image {
            width: 100px;
            height: 100px;
            margin-bottom: 10px;
        }

        .team .team-member img {
            width: 40px;
            float: left;
            border-radius: 50%;
            margin: 0 5px 0 5px;
        }

        .label.label-success {
            background: #43d39e;
        }

        .label {
            font-weight: 400;
            padding: 4px 8px;
            font-size: 11px;
            display: inline-block;
            line-height: 1;
            color: #fff;
            text-align: center;
            white-space: nowrap;
            vertical-align: baseline;
            border-radius: 0.25em;
        }

        .img-xs {
            width: 37px;
            height: 37px;
        }
        .rounded-circle {
            border-radius: 50% !important;
        }
        img {
            vertical-align: middle;
            border-style: none;
        }

        .card-header:first-child {
            border-radius: 0 0 0 0;
        }
        .card-header {
            padding: 0.875rem 1.5rem;
            margin-bottom: 0;
            background-color: rgba(0, 0, 0, 0);
            border-bottom: 1px solid #f2f4f9;
        }

        .card-footer:last-child {
            border-radius: 0 0 0 0;
        }
        .card-footer {
            padding: 0.875rem 1.5rem;
            background-color: rgba(0, 0, 0, 0);
            border-top: 1px solid #f2f4f9;
        }

        .action-btn-1, .action-btn-2{
            border: none;
            background: none;
        }

        .button-container{
            background-color: #f18a34;
            opacity: 0.8;
            /*background-color:hsl(120,100%,75%);*/
            display: flex;
            align-items: center;
        }

        .custom-plus-icon{
            color: #ffffff;
            font-size: 1.5rem;
        }

        .tag-link {
            color: #4099ff;
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
        <div class=" no-page-title">
            <!-- start page main wrapper -->
            <div id="main-wrapper">
                <div class="row">
                    <div class="col-lg-5 col-xl-3">
                        <div class="card card-white shadow grid-margin">
                            <div class="card-heading clearfix">
                                <h4 class="card-title">User Profile</h4>
                            </div>
                            <div class="card-body user-profile-card mb-2">
                                @if(Auth::user()->gender_id == 1)
                                    <img class="user-profile-image rounded-circle" src="{{ asset('asset/male.png') }}" alt="">
                                @else
                                    <img class="user-profile-image rounded-circle" src="{{ asset('asset/female.png') }}" alt="">
                                @endif
                                <h4 class="text-center h6 mt-2">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</h4>
                                <p class="label label-success bg-danger mb-2 d-block">{{ Auth::user()->role->role_name }}</p>
                                <button class="btn btn-sm btn-flash-border-primary mt-1">Follow</button>
                                <button class="btn btn-sm btn-flash-border-primary mt-2">Message</button>
                                    <div class="mt-2">
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#updateModal">
                                            Profile Info
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Change User Info</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('update.user') }}" method="post" name="myForm" onsubmit="return validation(event)">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="form-outline mb-4">
                                                                <label class="form-label" for="">First Name</label>
                                                                <input type="text" name="first_name" class="form-control form-control-md" value="{{ Auth::user()->first_name }}" />
                                                            </div>
                                                            <div class="form-outline mb-4">
                                                                <label class="form-label" for="">Last Name</label>
                                                                <input type="text" name="last_name" class="form-control form-control-md" value="{{ Auth::user()->last_name }}" />
                                                            </div>
                                                            <div class="form-outline mb-4">
                                                                <label class="form-label" for="">User Name</label>
                                                                <input type="text" name="user_name" class="form-control form-control-md" value="{{ Auth::user()->user_name }}" />
                                                            </div>
                                                            <div class="form-outline mb-4">
                                                                <label class="form-label" for="">Email</label>
                                                                <input type="text" name="email" class="form-control form-control-md" value="{{ Auth::user()->email }}" />
                                                            </div>
                                                            <div class="form-outline mb-4">
                                                                <label class="form-label" for="">Phone Number</label>
                                                                <input type="text" name="phoneNumber" class="form-control form-control-md" value="{{ Auth::user()->phone_number }}" />
                                                            </div>
                                                            <div>
                                                                <button type="submit" class="btn btn-outline-primary" data-bs-dismiss="modal">Save changes</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </div>
                        <div class="card card-white shadow grid-margin">
                            <div class="card-heading clearfix mt-3">
                                <h4 class="card-title">Badges</h4>
                            </div>
                            <div class="card-body mb-3">

                                <i class="fed fa-crown"></i>
                                <a href="#" class="label label-success mb-2">CSS</a>
                                <a href="#" class="label label-success mb-2">Sass</a>
                                <a href="#" class="label label-success mb-2">Bootstrap</a>
                                <a href="#" class="label label-success mb-2">Javascript</a>
                                <a href="#" class="label label-success mb-2">Photoshop</a>
                                <a href="#" class="label label-success">UI</a>
                                <a href="#" class="label label-success">UX</a>
                            </div>

                        </div>
                    </div>
                    <div class="col-lg-7 col-xl-6">
                        <div class="mb-4 pt-3 pb-4 d-flex justify-content-around rounded bg-white shadow">
                            <div class="w-50 d-flex justify-content-center">
                                <div class="w-50 d-flex button-container justify-content-center pt-3 pb-3 rounded">
                                    <button class="action-btn-1" type="button" data-bs-toggle="modal" data-bs-target="#addModal"><i class="fa fa-plus custom-plus-icon"></i></button>
                                </div>
                                <!-- Modal -->
                                <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Create Debate</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('create.debate') }}" enctype="multipart/form-data" method="post">
                                                    @csrf
                                                    @method('POST')
                                                    <div class="form-floating mb-4">
                                                        <textarea name="content" id="input1" placeholder="#" class="form-control form-control-md"></textarea>
                                                        <label class="form-label" for="input1">Content</label>
                                                    </div>
                                                    <div class="mb-4">
                                                        <label for="formFile" class="form-label">Image</label>
                                                        <input class="form-control" name="img" type="file" id="formFile">
                                                    </div>
                                                    <div class="mb-3">
                                                        Categorie
                                                    </div>
                                                    <div class="form-outline mb-4 row d-flex justify-content-evenly">
                                                        @foreach($categories as $categorie)
                                                            <div class="col-4 form-check">
                                                                <input class="form-check-input" type="radio" name="categorie_name" value="{{ $categorie->id }}" id="{{ $categorie->id }}">
                                                                <label class="form-check-label" for="{{ $categorie->id }}">
                                                                    {{ $categorie->categorie_name }}
                                                                </label>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                    <div class="mb-3">
                                                        Tags
                                                    </div>
                                                    <div class="form-outline mb-4 row d-flex justify-content-evenly">
                                                        @foreach($tags as $tag)
                                                            <div class="col-4 form-check">
                                                                <input class="form-check-input" type="checkbox" name="tag_name[]" value="{{ $tag->id }}" id="{{ $tag->id }}">
                                                                <label class="form-check-label" for="{{ $tag->id }}">
                                                                    {{ $tag->tag_name }}
                                                                </label>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                    <div class="d-flex justify-content-center">
                                                        <button type="submit" class="btn btn-outline-primary" data-bs-dismiss="modal">Publish</button>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end modal -->
                            </div>
                            <div class="w-50 d-flex justify-content-center">
                                <div class="w-50 d-flex button-container justify-content-center pt-3 pb-3 rounded">
                                    <button class="action-btn-2 custom-plus-icon" type="button" data-bs-toggle="modal" data-bs-target="#updateModal">Debate</button>
                                </div>

                            </div>
                        </div>
                        @foreach($debates as $debate)
                        <div class="card rounded mb-3">
                            <div class="card-header">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="d-flex align-items-center">
                                        @if(Auth::user()->gender_id == 1)
                                        <img class="img-xs rounded-circle" src="{{ asset('asset/male.png') }}" alt="">
                                        @else
                                            <img class="img-xs rounded-circle" src="{{ asset('asset/female.png') }}" alt="">
                                        @endif
                                        <div class="ml-2">
                                            <a href="{{ route('profile') }}" class="navbar-brand">
                                                <p>{{ Auth::user()->user_name }}</p></a>
                                            <p class="tx-11 text-muted">1 min ago</p>
                                        </div>
                                    </div>
                                    <div class="dropdown d-none d-md-block">
                                        <button class="btn p-0" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                                 fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                 stroke-linejoin="round" class="feather feather-more-horizontal icon-lg pb-3px">
                                                <circle cx="12" cy="12" r="1"></circle>
                                                <circle cx="19" cy="12" r="1"></circle>
                                                <circle cx="5" cy="12" r="1"></circle>
                                            </svg>
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="userDropdown">
                                            <a class="dropdown-item d-flex align-items-center" href="#">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                     viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                     stroke-linecap="round" stroke-linejoin="round"
                                                     class="feather feather-meh icon-sm mr-2">
                                                    <circle cx="12" cy="12" r="10"></circle>
                                                    <line x1="8" y1="15" x2="16" y2="15"></line>
                                                    <line x1="9" y1="9" x2="9.01" y2="9"></line>
                                                    <line x1="15" y1="9" x2="15.01" y2="9"></line>
                                                </svg>
                                                <span class="">Unfollow</span></a>
                                            <a class="dropdown-item d-flex align-items-center" href="#">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                     viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                     stroke-linecap="round" stroke-linejoin="round"
                                                     class="feather feather-corner-right-up icon-sm mr-2">
                                                    <polyline points="10 9 15 4 20 9"></polyline>
                                                    <path d="M4 20h7a4 4 0 0 0 4-4V4"></path>
                                                </svg>
                                                <span class="">Go to post</span></a>
                                            <a class="dropdown-item d-flex align-items-center" href="#">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                     viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                     stroke-linecap="round" stroke-linejoin="round"
                                                     class="feather feather-share-2 icon-sm mr-2">
                                                    <circle cx="18" cy="5" r="3"></circle>
                                                    <circle cx="6" cy="12" r="3"></circle>
                                                    <circle cx="18" cy="19" r="3"></circle>
                                                    <line x1="8.59" y1="13.51" x2="15.42" y2="17.49"></line>
                                                    <line x1="15.41" y1="6.51" x2="8.59" y2="10.49"></line>
                                                </svg>
                                                <span class="">Share</span></a>
                                            <a class="dropdown-item d-flex align-items-center" href="#">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                     viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                     stroke-linecap="round" stroke-linejoin="round"
                                                     class="feather feather-copy icon-sm mr-2">
                                                    <rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect>
                                                    <path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path>
                                                </svg>
                                                <span class="">Copy link</span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <p class="mb-3 tx-14">{{ $debate->content }}</p>
                                <div>
                                    @foreach($debate->tags as $debateTag)
                                        <a href="" class="tag-link">{{ $debateTag->tag_name }}</a>
                                    @endforeach
                                </div>
                                <div class="d-flex justify-content-center">
                                    <img class="img-fluid" src="{{ asset('storage/'.$debate->img) }}" alt="">
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="d-flex justify-content-evenly post-actions">
                                    <a href="javascript:;"
                                       class="debate-actions d-flex align-items-center justify-content-center rounded-pill w-25 text-muted mr-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                             fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                             stroke-linejoin="round" class="feather feather-heart icon-md">
                                            <path
                                                d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                                        </svg>
                                        <p class="d-none d-md-block ml-2">Like</p>
                                    </a>
                                    <a href="javascript:;"
                                       class="debate-actions d-flex align-items-center justify-content-center rounded-pill w-25 text-muted mr-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                             fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                             stroke-linejoin="round" class="feather feather-message-square icon-md">
                                            <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                                        </svg>
                                        <p class="d-none d-md-block ml-2">Comment</p>
                                    </a>
                                    <a href="javascript:;"
                                       class="debate-actions d-flex align-items-center justify-content-center rounded-pill w-25 text-muted">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                             fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                             stroke-linejoin="round" class="feather feather-share icon-md">
                                            <path d="M4 12v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-8"></path>
                                            <polyline points="16 6 12 2 8 6"></polyline>
                                            <line x1="12" y1="2" x2="12" y2="15"></line>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="col-lg-5 col-xl-3">
                        <div class="card card-white shadow grid-margin">
                            <div class="card-heading clearfix mt-3">
                                <h4 class="card-title">About</h4>
                            </div>
                            <div class="card-body mb-3">
                                <p class="mb-0">Lorem ipsum dolor sitelt amet, consectetur adipis icing elit, sed do eiusmod tempor incididunt utitily labore et dolore magna aliqua metavta.</p>
                            </div>
                        </div>
                    </div>
                <!-- Row -->
            </div>
        </div>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if($errors->any() || session('successResponse') !== null)
        @if($errors->any())
            @foreach($errors->all() as $error)
            <script>
                Swal.fire({
                    position: "top-end",
                    icon: "warning",
                    title: "{{ $error }}",
                    showConfirmButton: false,
                    timer: 3000
                });
            </script>
            @endforeach
        @else
            <script>
                Swal.fire({
                    position: "top-end",
                    icon: "success",
                    title: "{{session('successResponse')}}",
                    showConfirmButton: false,
                    timer: 3000
                });
            </script>
        @endif
    @endif
    <script>
        function validation(event) {
            event.preventDefault();
            let first_name = document.forms['myForm']['first_name'].value;
            let last_name = document.forms['myForm']['last_name'].value;
            let user_name = document.forms['myForm']['user_name'].value;
            let email = document.forms['myForm']['email'].value;
            let phNumber = document.forms['myForm']['phoneNumber'].value;
            let emailRegex = /^[a-zA-Z0-9._%-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
            let phRegex = /^(?:(?:\(?(?:00|\+)([1-4]\d\d|[1-9]\d?)\)?)?[\-\.\ \\\/]?)?((?:\(?\d{1,}\)?[\-\.\ \\\/]?){0,})(?:[\-\.\ \\\/]?(?:#|ext\.?|extension|x)[\-\.\ \\\/]?(\d+))?$/;

            if (first_name === '' || last_name === '') {
                return Swal.fire({
                    position: "top-end",
                    icon: "warning",
                    title: "Your Name is empty",
                    showConfirmButton: false,
                    timer: 2000
                });
            }

            if (!emailRegex.test(email)) {
                return Swal.fire({
                    position: "top-end",
                    icon: "warning",
                    title: "Your Email is not valid",
                    showConfirmButton: false,
                    timer: 2000
                });
            }

            if (!phRegex.test(phNumber)){
                return Swal.fire({
                    position: "top-end",
                    icon: "warning",
                    title: "Your Phone Number is not valid",
                    showConfirmButton: false,
                    timer: 2000
                });
            }

            if (user_name === '') {
                return Swal.fire({
                    position: "top-end",
                    icon: "warning",
                    title: "Your User Name is empty",
                    showConfirmButton: false,
                    timer: 2000
                });
            }

            document.forms['myForm'].submit();
        }
    </script>
</body>

</html>
