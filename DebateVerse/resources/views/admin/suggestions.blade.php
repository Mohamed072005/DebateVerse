@extends('admin.admin-layout.layout')
@section('content')
    <style>
        .img-xs {
            width: 55px;
        }
    </style>
        <div class="row d-flex justify-content-center">
            @foreach($suggestions as $suggestion)
                <div class="col-md-3 col-sm-8 card shadow rounded m-5 mb-2">
                    <div class="">
                        <div class="card-header d-flex justify-content-center">
                            @if($suggestion->sender->gender_id == 1)
                                <img class="img-xs rounded-circle" src="{{ asset('asset/male.png') }}" alt="">
                            @else
                                <img class="img-xs rounded-circle" src="{{ asset('asset/female.png') }}" alt="">
                            @endif
                        </div>
                        <div class="card-body d-flex justify-content-center">
                            <a href="" class="navbar-brand">
                                <h6>{{ $suggestion->sender->user_name }}</h6>
                            </a>
                        </div>
                        <div class="card-footer d-flex justify-content-center">

                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-sm btn-flash-border-primary mt-2" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $suggestion->sender->id }}">
                                view
                            </button>

                            {{--Message Modal--}}

                            <div class="modal fade" id="exampleModal{{ $suggestion->sender->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Suggestion <span class="text-secondary">{{ $suggestion->created_at->diffForHumans() }}</span></h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            {{ $suggestion->suggestion }}
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{--End Message Modal--}}


                            @if(Auth::user()->role_id == 1)
                                <form action="{{ route('delete.suggestion', $suggestion->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-flash-border-primary mt-2">Delete Suggestion</button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
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
