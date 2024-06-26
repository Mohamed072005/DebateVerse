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

    .action-btn-1 {
        border: none;
        background: none;
    }

    .comment-container{
        width: 150px; /* Adjust container width as needed */
        padding: 10px;
    }

    .tag-link-color {
        color: dodgerblue;
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
                                @if($debate->user_id == Auth::id())
                                <a href="{{ route('profile') }}" class="navbar-brand">
                                    <h6 class="d-inline">{{ Auth::user()->user_name }}</h6>
                                </a>
                                @else
                                <a href="{{ route('users.profile', $debate->user->id) }}" class="navbar-brand">
                                    <h6 class="d-inline">{{ $debate->user->user_name }}</h6>
                                </a>
                                @endif
                                <p class="tx-11 text-muted">{{ $debate->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                        <div class="dropdown ">
                            <button class="btn p-0" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal icon-lg pb-3px">
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
                                <button type="button" class="dropdown-item d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#debateUpdate{{ $debate->id }}">
                                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                    <span class=""> Update</span>
                                </button>
                                @else
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <i class="fa fa-flag" aria-hidden="true"></i>
                                    <span class="">Report</span></a>
                                @endif

                            </div>

                            <!-- Update Modal -->
                            <div class="modal fade" id="debateUpdate{{ $debate->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('update.debate', $debate->id) }}" enctype="multipart/form-data" method="post">
                                                @csrf
                                                @method('PUT')
                                                <div class="form-floating mb-4">
                                                    <textarea name="content" id="textarea" placeholder="#" class="form-control form-control-md">{{ $debate->content }}</textarea>
                                                    <label class="form-label" for="textarea">Content</label>
                                                </div>
                                                <div class="mb-4">
                                                    <label for="formFile" class="form-label">Image</label>
                                                    <input class="form-control" name="img" type="file" id="formFile">
                                                </div>
                                                <div class="mb-3">
                                                    Tags
                                                </div>
                                                <div class="form-outline mb-4 row d-flex justify-content-evenly">
                                                    @foreach($tags as $tag)
                                                    <div class="col-4 form-check">
                                                        @php
                                                        $isChecked = 0;
                                                        foreach($debate->tags as $debateTag) {

                                                        if($debateTag->tag_name == $tag->tag_name) {
                                                        $isChecked = 1;
                                                        // Once found, no need to continue checking
                                                        }
                                                        }
                                                        @endphp
                                                        <input class="form-check-input" type="checkbox" name="tag_name[]" value="{{ $tag->id }}" id="{{ $tag->id }}" @if($isChecked) checked @endif>
                                                        <label class="form-check-label" for="{{ $tag->id }}">
                                                            #{{ $tag->tag_name }}
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
                            <a href="{{ route('find.debate.by.tag', $debateTag->id) }}" class="tag-link">#{{ $debateTag->tag_name }}</a>
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
                                                        <input type="text" id="addANote{{ $debate->id }}" class="w-75 form-control" name="comment" placeholder="Update comment..." />
                                                    </div>
                                                    <div class="d-flex justify-content-center">
                                                        <button type="submit" class="btn btn-outline-primary rounded-circle ml-2"><span><i class="fa fa-send"></i></span></button>
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
                        <button class="debate-actions d-flex align-items-center justify-content-center rounded-pill w-25 text-muted">
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
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
            console.log(comment);
        });
    });
</script>
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
