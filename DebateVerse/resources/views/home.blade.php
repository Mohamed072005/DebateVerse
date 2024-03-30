@extends('layout.layout')
@section('content')
    <style>
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

        .action-btn-1{
            border: none;
            background: none;
        }
    </style>
    <div class="col-md-8 col-xl-6 middle-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                @foreach($debates as $debate)
                    <div class="card rounded mb-3">
                        <div class="card-header">
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center">
                                    @if($debate->user->gender_id == 1)
                                        <img class="img-xs rounded-circle" src="{{ asset('asset/male.png') }}" alt="">
                                    @else
                                        <img class="img-xs rounded-circle" src="{{ asset('asset/female.png') }}" alt="">
                                    @endif
                                    <div class="ml-2">
                                        <form action="{{ route('users.profile', $debate->user->user_name) }}" method="post">
                                            @csrf
                                            @method('POST')
                                            <input type="hidden" name="friend" value="{{ $debate->user->id }}">
                                            <button type="submit" class="button-to-profile">{{ $debate->user->user_name }}</button>
                                        </form>
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
                                        @if($debate->user_id == Auth::id())
                                        <form action="{{ route('delete.debate', $debate->id) }}" method="post" class="dropdown-item d-flex align-items-center">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="token" value="3d92ff394a72e41dd935d8099ad93fb3e81e32a0a0c4c2c4a76f0fbc46b62a3d">
                                            <button class="action-btn-1">
                                                <i class="fa fa-trash-o" aria-hidden="true"> Delete</i>
                                            </button>
                                        </form>
                                        <a class="dropdown-item d-flex align-items-center" href="#">
                                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                            <span class="">Update</span></a>
                                        @else
                                            <a class="dropdown-item d-flex align-items-center" href="#">
                                                <i class="fa fa-flag" aria-hidden="true"></i>
                                                <span class="">Report</span></a>
                                        @endif

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
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if(!session('errorProfile') == null)
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
    @if(!session('successResponse') == null)
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
@endsection
