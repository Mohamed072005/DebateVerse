@extends('layout.layout')
@section('title', 'contact')
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
                <div class="col-md-8 col-sm-8 col-xs-8 card shadow rounded mr-2 mb-2">
                    <div class=" d-flex">
                        <div class="card-header d-flex justify-content-center">
                            @if($receivers->receiver->gender_id == 1)
                                <img class="img-xs rounded-circle" src="{{ asset('asset/male.png') }}" alt="">
                            @else
                                <img class="img-xs rounded-circle" src="{{ asset('asset/female.png') }}" alt="">
                            @endif
                        </div>
                        <div class="d-flex justify-content-center align-items-center">
                                <h6>{{ $receivers->receiver->user_name }}</h6>
                        </div>
                        <a href="{{ route('chat', $receivers->receiver->id) }}" class="stretched-link"></a>
                    </div>
                </div>
            @endforeach
            @foreach($userAsReceiver as $senders)
                <div class="col-md-8 col-sm-8 col-xs-8 card shadow rounded mr-2 mb-2">
                    <div class="w-100 d-flex">
                        <div class="card-header d-flex justify-content-center">
                            @if($senders->sender->gender_id == 1)
                                <img class="img-xs rounded-circle" src="{{ asset('asset/male.png') }}" alt="">
                            @else
                                <img class="img-xs rounded-circle" src="{{ asset('asset/female.png') }}" alt="">
                            @endif
                        </div>
                        <div class="d-flex justify-content-center align-items-center">
                            <h6>{{ $senders->sender->user_name }}</h6>
                        </div>
                        <a href="{{ route('chat', $senders->sender->id) }}" class="stretched-link"></a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
