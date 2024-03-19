@extends('auth.auth-layout.layout')
@section('title', 'Register')
@section('content')
<section class="vh-100">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="card shadow-2-strong" style="border-radius: 1rem;background-color: #efefef;">
                    <form action="{{ route('register') }}" method="post" class="card-body p-5 text-center" name="myForm" onsubmit="return validation(event)">
                        @csrf
                        @method('POST')
                        <h3 class="mb-5 text-uppercase">register</h3>

                        <div class="form-outline mb-4">
                            <label class="form-label" for="">First Name</label>
                            <input type="text" name="first_name" class="form-control form-control-lg" />
                        </div>

                        <div class="form-outline mb-4">
                            <label class="form-label" for="">Last Name</label>
                            <input type="text" name="last_name" class="form-control form-control-lg" />
                        </div>

                        <div class="form-outline mb-4">
                            <label class="form-label" for="">Email</label>
                            <input type="email" name="email" class="form-control form-control-lg" />
                        </div>

                        <div class="form-outline mb-4">
                            <label class="form-label" for="">Phone Number</label>
                            <input type="text" name="phoneNumber" class="form-control form-control-lg" />
                        </div>

                        <div class="form-outline mb-4">
                            <label class="form-label" for="">Password</label>
                            <input type="password" name="password" class="form-control form-control-lg" />
                        </div>

                        <div class="form-outline mb-4">
                            <label class="form-label" for="">Confirmed Password</label>
                            <input type="password" name="password_confirmation" class="form-control form-control-lg" />
                        </div>

                        <button class="btn btn-primary btn-lg btn-block" type="submit">Register</button>

                        <hr class="my-4">

                        <p class="mb-0">You already have an account?  <a class="navbar-brand fw-bold" href="{{ route('to.login') }}">login</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
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
<script>
    function validation(event) {
        event.preventDefault();
        let first_name = document.forms['myForm']['first_name'].value;
        let last_name = document.forms['myForm']['last_name'].value;
        let email = document.forms['myForm']['email'].value;
        let password = document.forms['myForm']['password'].value;
        let confirmedPassword = document.forms['myForm']['password_confirmation'].value;
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

        if (password.length < 8) {
            return Swal.fire({
                position: "top-end",
                icon: "warning",
                title: "Your Password should be biger than 8 characters",
                showConfirmButton: false,
                timer: 2000
            });
        }

        if(confirmedPassword.length < 8){
            return Swal.fire({
                position: "top-end",
                icon: "warning",
                title: "Your Repeat Password should be biger than 8 characters",
                showConfirmButton: false,
                timer: 2000
            });
        }

        if (password !== confirmedPassword) {
            return Swal.fire({
                position: "top-end",
                icon: "warning",
                title: "Your Password do not match",
                showConfirmButton: false,
                timer: 2000
            });
        }

        document.forms['myForm'].submit();
    }
</script>
@endsection
