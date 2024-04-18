@extends('layout-profile.layout.navLayout')
@section('content')
    <style>
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

        .tag-link {
            color: #4099ff;
        }

        .report-div {
            border-radius: 50px; /* Adjust as needed */
            border: 1px solid #ccc; /* Adjust border color */
            padding: 5px 15px; /* Adjust padding */
            cursor: pointer;
        }

        .visually-hidden {
            position: absolute;
            overflow: hidden;
            clip: rect(0 0 0 0);
            height: 1px;
            width: 1px;
            margin: -1px;
            padding: 0;
            border: 0;
        }
    </style>
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
                            @if($user->gender_id == 1)
                                <img class="user-profile-image rounded-circle" src="{{ asset('asset/male.png') }}" alt="">
                            @else
                                <img class="user-profile-image rounded-circle" src="{{ asset('asset/female.png') }}" alt="">
                            @endif
                            <h4 class="text-center h6 mt-2">{{ $user->first_name }} {{ $user->last_name }}</h4>
                            <p class="label label-success bg-danger mb-2 d-block">{{ $user->role->role_name }}</p>
                                @php
                                $sender = null;
                                $receiver = null;
                                foreach ($user->sendRequest as $sendExist){
                                    if ($sendExist->receiver_id == Auth::id() && $sendExist->status == 1){
                                        $receiver = true;
                                        break;
                                    }
                                }

                                foreach ($user->receiveRequest as $receiverExist){
                                    if ($receiverExist->sender_id == Auth::id() && $receiverExist->status == 1){
                                        $sender = true;
                                        break;
                                    }
                                }
                                @endphp
                                @if($sender || $receiver)
                                    <a href="" class="navbar-brand btn btn-sm btn-flash-border-primary mt-2">Message</a>
                                    <a href="{{ route('remove.friend', $user->id) }}" class="navbar-brand btn btn-sm btn-flash-border-primary mt-2">Remove Friend</a>
                                @else
                                    <form action="{{ route('send.friend.request', $user->id) }}" method="post">
                                        @csrf
                                        @method('POST')
                                        <input type="hidden" name="token" value="3d92ff394a72e41dd935d8099ad93fb3e81e32a0a0c4c2c4a76f0fbc46b62a3d">
                                        <button class=" btn btn-sm btn-flash-border-primary mt-2">add</button>
                                    </form>

                                @endif
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
                    @foreach($user->debates as $debate)
                        <div class="card rounded mb-3 mt-3">
                            <div class="card-header">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="d-flex align-items-center">
                                        @if($debate->user->gender_id == 1)
                                            <img class="img-xs rounded-circle" src="{{ asset('asset/male.png') }}" alt="">
                                        @else
                                            <img class="img-xs rounded-circle" src="{{ asset('asset/female.png') }}" alt="">
                                        @endif
                                        <div class="ml-2">
                                            <a href="" class="navbar-brand">
                                                <p>{{ $debate->user->user_name }}</p></a>
                                            <p class="tx-11 text-muted">1 min ago</p>
                                        </div>
                                    </div>
                                    <div class="dropdown">
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
                                            <!-- Button trigger modal -->
                                            <button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#reportModal{{ $debate->id }}">
                                                <i class="fa fa-flag" aria-hidden="true"></i>
                                                <span class=""> Report</span>
                                            </button>
                                        </div>

                                        <!-- Report Modal -->
                                        <div class="modal fade" id="reportModal{{ $debate->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Reports</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('report', $debate->id) }}" method="post">
                                                            @csrf
                                                            @method('POST')
                                                            <div>
                                                                <input type="hidden" name="token" value="3d92ff394a72e41dd935d8099ad93fb3e81e32a0a0c4c2c4a76f0fbc46b62a3d">
                                                                <div class="row">
                                                                    <input type="checkbox" name="report" class="col-lg-2 col-xl-2">
                                                                    <div class="rounded-pill report-div col-lg-8 col-md-8 col-xl-8">Violence</div>
                                                                </div>
                                                                <div class="row mt-2">
                                                                    <input type="checkbox" name="report" class="col-lg-2 col-xl-2">
                                                                    <div class="rounded-pill report-div col-lg-8 col-md-8 col-xl-8">Hate Speech</div>
                                                                </div>
                                                                <div class="row mt-2">
                                                                    <input type="checkbox" name="report" class="col-lg-2 col-xl-2">
                                                                    <div class="rounded-pill report-div col-lg-8 col-md-8 col-xl-8">Involve a Child</div>
                                                                </div>
                                                                <div class="row mt-2">
                                                                    <input type="checkbox" name="report" class="col-lg-2 col-xl-2">
                                                                    <div class="rounded-pill report-div col-lg-8 col-md-8 col-xl-8">Drugs</div>
                                                                </div>
                                                                <div class="row mt-2">
                                                                    <input type="checkbox" name="report" class="col-lg-2 col-xl-2">
                                                                    <div class="rounded-pill report-div col-lg-8 col-md-8 col-xl-8">Terrorism</div>
                                                                </div>
                                                                <div class="row mt-2">
                                                                    <input type="checkbox" name="report" class="col-lg-2 col-xl-2">
                                                                    <div class="rounded-pill report-div col-lg-8 col-md-8 col-xl-8">Suicide or Self-Injury</div>
                                                                </div>
                                                            </div>
                                                            <div class="mt-2 d-flex justify-content-center">
                                                                <button type="submit" class="btn btn-outline-primary">Send</button>
                                                            </div>

                                                        </form>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Modal -->

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
                                <div class="w-100 mb-4 d-flex">
                                    @if(!($debate->with + $debate->against) == 0)
                                        <div class="bg-success text-white text-center rounded-left-pill" style="width: {{ $debate->with / ($debate->with + $debate->against) * 100}}%">
                                            {{ $debate->with / ($debate->with + $debate->against) * 100 }} %
                                        </div>
                                        <div class="bg-danger text-white text-center rounded-right-pill" style="width: {{ $debate->against / ($debate->with + $debate->against) * 100 }}%">
                                            {{ $debate->against / ($debate->with + $debate->against) * 100 }} %
                                        </div>
                                    @else
                                        <div class="w-50 bg-success text-white text-center rounded-left-pill">
                                            0 %
                                        </div>
                                        <div class="w-50 bg-danger text-white text-center rounded-right-pill">
                                            0 %
                                        </div>
                                    @endif

                                </div>
                                <div class="d-flex justify-content-evenly post-actions">
                                    <div class="d-flex align-items-center justify-content-center rounded-pill w-25 text-muted">
                                        @php
                                            $vote = false;
                                                foreach($debate->voting as $voting){
                                                    if ($voting->user_id == Auth::id() && $voting->status == 1){
                                                        $vote = true;
                                                    }else{
                                                        $vote = false;
                                                    }
                                                }
                                        @endphp
                                        @if($vote == true)
                                            <a href="{{ route('with', $debate->id) }}" class="debate-vote-left-checked d-flex justify-content-center navbar-brand text-success  w-50">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="35" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <polyline points="20 6 9 17 4 12"></polyline>
                                                </svg>
                                            </a>
                                        @else
                                            <a href="{{ route('with', $debate->id) }}" class="debate-vote-left d-flex justify-content-center navbar-brand text-success  w-50">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="35" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <polyline points="20 6 9 17 4 12"></polyline>
                                                </svg>
                                            </a>
                                        @endif

                                        @php
                                            $vote = false;
                                                foreach($debate->voting as $voting){
                                                    if ($voting->user_id == Auth::id() && $voting->status == 0){
                                                        $vote = true;
                                                    }else{
                                                        $vote = false;
                                                    }
                                                }
                                        @endphp
                                        @if($vote == true)
                                            <a href="{{ route('against', $debate->id) }}" class="debate-vote-right-checked d-flex justify-content-center navbar-brand text-danger w-50">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="35" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <line x1="18" y1="6" x2="6" y2="18"></line>
                                                    <line x1="6" y1="6" x2="18" y2="18"></line>
                                                </svg>
                                            </a>
                                        @else
                                            <a href="{{ route('against', $debate->id) }}" class="debate-vote-right d-flex justify-content-center navbar-brand text-danger w-50">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="35" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <line x1="18" y1="6" x2="6" y2="18"></line>
                                                    <line x1="6" y1="6" x2="18" y2="18"></line>
                                                </svg>
                                            </a>
                                        @endif
                                    </div>


                                    <!-- Comments Button -->
                                    <button type="button" class="debate-actions d-flex align-items-center justify-content-center rounded-pill w-25 text-muted mr-4" data-bs-toggle="modal" data-bs-target="#commentModal{{ $debate->id }}" style="border: none;">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-message-square icon-md">
                                            <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                                        </svg>
                                        Comment: {{ $debate->comments->count() }}
                                    </button>
                                    <!-- Comments Modal -->

                                    <div class="modal fade" id="commentModal{{ $debate->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Comments</h1>
                                                    <button type="button" class="btn-close close-update-modal" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="d-flex justify-content-center">
                                                        <div class="rounded" style="width: 85%; height: 250px; background-color: #b4b3b3; overflow: auto">
                                                            @foreach($debate->comments as $comment)
                                                                <div class="bg-light w-75 rounded d-flex  p-1 m-2">
                                                                    <div class="d-flex justify-content-center align-items-start mr-2">
                                                                        @if($comment->user->gender_id == 1)
                                                                            <img class="img-xs rounded-circle" src="{{ asset('asset/male.png') }}" alt="">
                                                                        @else
                                                                            <img class="img-xs rounded-circle" src="{{ asset('asset/female.png') }}" alt="">
                                                                        @endif
                                                                    </div>
                                                                    <div class="w-75">
                                                                        <h5>{{ $comment->user->user_name }}</h5>
                                                                        <div class="w-100">
                                                                            <p class="text-dark comment-text" id="comment{{ $comment->id }}">{{ $comment->content }}</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="d-flex justify-content-between">
                                                                        @if($comment->user_id == Auth::id())
                                                                            <form action="{{ route('destroy.comment', $comment->id) }}" method="post">
                                                                                @csrf
                                                                                @method('DELETE')
                                                                                <button type="submit" style="background: none; border: none"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                                                                            </form>
                                                                            <div>
                                                                                <button type="submit" class="update-button" style="background: none; border: none"><i class="fa fa-pencil-square-o" data-comment-id="{{ $comment->id }}" data-debate-id="{{ $comment->debate_id }}" aria-hidden="true"></i></button>
                                                                            </div>

                                                                        @else
                                                                            <i class="fa fa-flag" aria-hidden="true"></i>
                                                                        @endif
                                                                    </div>

                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                    <form action="{{ route('comment', $debate->id) }}" id="insert{{ $debate->id }}" method="post" class="mt-2 myForm">
                                                        @csrf
                                                        @method('POST')
                                                        <div>
                                                            <div>
                                                                <div class="form-outline d-flex justify-content-center mb-4">
                                                                    <input type="hidden" name="requestFromFriends" value="3d92ff394a72e41dd935d8099ad93fb3e81e32a0a0c4c2c4a76f0fbc46b62a3d">
                                                                    <input type="text" class="w-75 form-control" name="comment" placeholder="Type comment..." />
                                                                    <button type="submit" class="btn btn-outline-primary rounded-circle ml-2"><span><i class="fa fa-send"></i></span></button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                    <form action="" id="update{{ $debate->id }}" method="post" class="mt-2 updateForm">
                                                        @csrf
                                                        @method('PUT')
                                                        <div>
                                                            <div>
                                                                <div class="form-outline d-flex justify-content-center mb-4">
                                                                    <input type="hidden" name="requestFromFriends" value="3d92ff394a72e41dd935d8099ad93fb3e81e32a0a0c4c2c4a76f0fbc46b62a3d">
                                                                    <input type="text" id="addANote{{ $debate->id }}" class="w-75 form-control" name="comment" placeholder="Update comment..." />
                                                                </div>
                                                                <div class="d-flex justify-content-center">
                                                                    <button type="submit" class="btn btn-outline-primary rounded-circle ml-2" style="height: 38px; margin-right: 10px"><span><i class="fa fa-send"></i></span></button>
                                                                    <button type="button" class="btn btn-outline-secondary rounded-circle ml-2 close-update-modal"><span><i class="fa fa-times"></i></span></button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary close-update-modal" data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- end Comments Modal -->
                                    <button class="debate-actions d-flex align-items-center justify-content-center rounded-pill w-25 text-muted" style="border: none">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-share icon-md">
                                            <path d="M4 12v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-8"></path>
                                            <polyline points="16 6 12 2 8 6"></polyline>
                                            <line x1="12" y1="2" x2="12" y2="15"></line>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="col-lg-5 col-xl-3 d-none d-md-block">
                    <div class="card card-white shadow grid-margin">
                        <div class="card-heading clearfix mt-3">
                            <h4 class="card-title">About</h4>
                        </div>
                        <div class="card-body mb-3">
                            <p class="mb-0">{{ session('errorProfile') }}</p>
                        </div>
                    </div>
                </div>
                <!-- Row -->
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if(session('errorProfile') !== null)
        <script>
            Swal.fire({
                position: "top-end",
                icon: "warning",
                title: "{{ session('errorProfile') }}",
                showConfirmButton: false,
                timer: 3000
            });
        </script>
    @endif
    <script>
        let buttonUpdate = document.querySelectorAll('.update-button');
        let closeUpdateModal = document.querySelectorAll('.close-update-modal');
        let updateForm = document.querySelectorAll('.updateForm');
        let commentForm = document.querySelectorAll('.myForm');


        updateForm.forEach(function (form){
            form.style.display = 'none'
        });    closeUpdateModal.forEach(function (closeButton){
            closeButton.addEventListener('click', function (){
                commentForm.forEach(function (form){
                    form.style.display = 'block'
                });
                updateForm.forEach(function (form){
                    form.style.display = 'none'
                });
            });
        });
        buttonUpdate.forEach(function (button){
            button.addEventListener('click', function (event){

                const clickedButton = event.target;
                const commentId = clickedButton.dataset.commentId;
                const debateId = clickedButton.dataset.debateId;

                let formComment = document.getElementById('insert' + debateId);
                let formUpdate = document.getElementById('update' + debateId);

                formComment.style.display = 'none';
                formUpdate.style.display = 'block';

                let comment = document.getElementById('comment' + commentId).innerText;
                let commentInput = document.getElementById('addANote' + debateId);
                let formAction = "http://127.0.0.1:8000/update/comment/" + commentId;
                formUpdate.action = "";
                formUpdate.action = formAction;
                commentInput.value = comment;
            });
        });
    </script>
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
@endsection


