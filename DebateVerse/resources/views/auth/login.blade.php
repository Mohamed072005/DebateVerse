@extends('auth.auth-layout.layout')
@section('content')
<section class="vh-100">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="card shadow-2-strong" style="border-radius: 1rem;background-color: #efefef;">
                    <form action="{{ route('login') }}" method="post" class="card-body p-5 text-center">
                        @csrf
                        @method('POST')
                        <h3 class="mb-5 text-uppercase">login</h3>

                        <div class="form-outline mb-4">
                            <label class="form-label" for="typeEmailX-2">Email</label>
                            <input type="email" name="email" class="form-control form-control-lg" />
                        </div>

                        <div class="form-outline mb-4">
                            <label class="form-label" for="typePasswordX-2">Password</label>
                            <input type="password" name="password" class="form-control form-control-lg" />
                        </div>

                        <button class="btn btn-primary btn-lg btn-block" type="submit">Login</button>

                        <hr class="my-4">

                        <p class="mb-0">Don't have an account?<a class="navbar-brand fw-bold" href="{{ route('to.register') }}">register</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@if(session('loginError'))
    <script>
        Swal.fire({
            position: "top-end",
            icon: "warning",
            title: "{{ session('loginError') }}",
            showConfirmButton: false,
            timer: 2000
        });
    </script>
@endif
@endsection
