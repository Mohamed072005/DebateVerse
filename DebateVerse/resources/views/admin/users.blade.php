@extends('admin.admin-layout.layout')
@section('content')
    <div class="container mt-3">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title text-uppercase mb-0">Manage Users</h5>
                    </div>
                    <div class="table-responsive">
                        <table class="table no-wrap user-table mb-0">
                            <thead>
                            <tr>
                                <th scope="col" class="border-0 text-uppercase font-medium pl-4">#</th>
                                <th scope="col" class="border-0 text-uppercase font-medium">User Name</th>
                                <th scope="col" class="border-0 text-uppercase font-medium">Role</th>
                                <th scope="col" class="border-0 text-uppercase font-medium">Email</th>
                                <th scope="col" class="border-0 text-uppercase font-medium">Debate</th>
                                <th scope="col" class="border-0 text-uppercase font-medium">Manage</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td class="pl-4">{{ $user->id }}</td>
                                    <td>
                                        <h5 class="font-medium mb-0">{{ $user->user_name }}</h5>
                                    </td>
                                    <td>
                                        <span class="text-muted">{{ $user->role->role_name }}</span><br>
                                    </td>
                                    <td>
                                        <span class="text-muted">{{ $user->email }}</span><br>
                                    </td>
                                    <td>
                                        <span class="text-muted">{{ $user->debates->count() }}</span><br>
                                    </td>
                                    <td class="d-flex">
                                        <form action="{{ route('user.ban', $user->id) }}" method="post">
                                            @csrf
                                            @method('PUT')
                                            @if($user->status == 0)
                                                <button type="submit" class="btn btn-outline-info btn-circle btn-lg btn-circle ml-2"><i class="fa fa-unlock"></i> </button>
                                            @endif
                                            @if($user->status == 1)
                                                <button type="submit" class="btn btn-outline-info btn-circle btn-lg btn-circle"><i class="fa fa-ban"></i> </button>
                                            @endif
                                        </form>
                                        @if(Auth::user()->role_id == 1)
                                        <form action="{{ route('change.role', $user->id) }}" method="post">
                                            @csrf
                                            @method('PUT')
                                            @if($user->role_id == 3 && !$user->status == 0)

                                                    <button type="submit" class="btn btn-outline-info btn-circle btn-lg btn-circle ml-2"><i class="fa fa-user-secret"></i> </button>
                                            @endif
                                            @if($user->role_id == 2 && !$user->status == 0)
                                                    <button type="submit" class="btn btn-outline-info btn-circle btn-lg btn-circle ml-2"><i class="fa fa-user"></i> </button>
                                            @endif
                                        </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
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
