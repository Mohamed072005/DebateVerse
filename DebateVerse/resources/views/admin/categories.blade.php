@extends('admin.admin-layout.layout')
@section('content')
    <style>

        .align-items-center {
            align-items: center!important;
        }

        .d-flex {
            display: flex!important;
        }

        .widget-meeting-action {
            display: flex;
            justify-content: end;
        }

        .widget-meeting-action form button {
            text-transform: uppercase;
        }

        .widget-meeting-action div button {
            text-transform: uppercase;
        }
    </style>
    <div class="container">
        <div class="container-fluid mb-3">
            <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Create Categorie
            </button>
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Categorie</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('add.categorie') }}" method="post" class="">
                                @csrf
                                @method('POST')
                                <div class="form-floating d-flex flex-column align-items-center mb-2">
                                    <input type="text" id="input1" placeholder="#" name="categorie_name" class="rounded w-100 form-control form-control-lg">
                                    <label for="input1">Categorie Name</label>
                                </div>
                                <div class="d-flex justify-content-center mt-4 mb-3">
                                    <button type="submit" class="btn btn-outline-primary text-uppercase">Create</button>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            {{--                                        <button class="btn btn-sm btn-flash-border-primary">Update</button>--}}
        </div>
        <div class="row">
            @foreach($categories as $categorie)
            <div class="col-lg-3 col-md-6  mb-4">
                <div class="card shadow border-0">
                    <!--card-body-->
                    <div class="card-body p-4">
                        <h5>{{ $categorie->categorie_name }}</h5>
                        <p class="mb-0 text-muted">124 Jobs opportunities</p>
                    </div>
                    <div class="widget-meeting-action p-2">
                        <div>
                            <form action="{{ route('destroy.categorie', $categorie->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-flash-border-primary">Delete</button>
                            </form>
                        </div>
                        <div>
                            <button type="button" class="btn btn-sm btn-flash-border-primary" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $categorie->id }}">
                                Update
                            </button>
                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal{{ $categorie->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Categorie</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('update.categorie', $categorie->id) }}" method="post" class="">
                                                @csrf
                                                @method('PUT')
                                                <div class="d-flex flex-column align-items-center mb-2">
                                                    <input type="text" name="categorie_name" class="rounded w-100 form-control form-control-lg" value="{{ $categorie->categorie_name }}">
                                                </div>
                                                <div class="d-flex justify-content-center mt-4 mb-3">
                                                    <button type="submit" class="btn btn-outline-primary">Update</button>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            @endforeach
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
    @endif
    @if(!session('addSuccess') == null)
        <script>
            Swal.fire({
                position: "top-end",
                icon: "success",
                title: "{{ session('addSuccess') }}",
                showConfirmButton: false,
                timer: 3000
            });
        </script>
    @endif
@endsection
