@extends('layout.layout')
@section('title', 'friends')
@section('content')
<style>
    .img-xs {
        width: 50px;
        height: 50px;
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
</style>
    <div class="col-md-8 col-xl-6 middle-wrapper">
        <div class="row d-flex justify-content-center">
            @foreach($userAsSender as $receivers)
            <div class="col-md-3 col-sm-8 card shadow rounded mr-2 mb-2">
                <div class="">
                    <div class="card-header d-flex justify-content-center">
                        @if($receivers->receiver->gender_id == 1)
                            <img class="img-xs rounded-circle" src="{{ asset('asset/male.png') }}" alt="">
                        @else
                            <img class="img-xs rounded-circle" src="{{ asset('asset/female.png') }}" alt="">
                        @endif
                    </div>
                    <div class="card-body d-flex justify-content-center">
                        <a href="{{ route('users.profile', $receivers->receiver->id) }}" class="navbar-brand">
                            <h6>{{ $receivers->receiver->user_name }}</h6>
                        </a>
                    </div>
                    <div class="card-footer d-flex justify-content-center">
                        <button class=" btn btn-sm btn-flash-border-primary mt-2">Message</button>
                        <form action="{{ route('remove.friend', $receivers->receiver->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="receiver" value="3d92ff394a72e41dd935d8099ad93fb3e81e32a0a0c4c2c4a76f0fbc46b62a3d">
                            <button class="btn btn-sm btn-flash-border-primary mt-2">Remove Friend</button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
            @foreach($userAsReceiver as $senders)
                    <div class="col-md-3 col-sm-8 card shadow rounded mr-2 mb-2">
                        <div class="w-100">
                            <div class="card-header d-flex justify-content-center">
                                @if(@$senders->sender->gender_id == 1)
                                    <img class="img-xs rounded-circle" src="{{ asset('asset/male.png') }}" alt="">
                                @else
                                    <img class="img-xs rounded-circle" src="{{ asset('asset/female.png') }}" alt="">
                                @endif
                            </div>
                            <div class="card-body d-flex justify-content-center">
                                <a href="{{ route('users.profile', $senders->sender->id) }}" class="navbar-brand">
                                    <h6 class="">{{ $senders->sender->user_name }}</h6>
                                </a>
                            </div>
                            <div class="card-footer d-flex justify-content-center">
                                <button class=" btn btn-sm btn-flash-border-primary mt-2">Message</button>
                                <form action="{{ route('remove.friend', $senders->sender->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="sender" value="3d92ff394a72e41dd935d8099ad93fb3e81e32a0a0c4c2c4a76f0fbc46b62a3d">
                                    <button class="btn btn-sm btn-flash-border-primary mt-2">Remove Friend</button>
                                </form>
                            </div>
                        </div>
                    </div>
            @endforeach
        </div>
    </div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    let hideToken = document.querySelectorAll('.input-token');
    hideToken.forEach(function (input){
        console.log(input);
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
