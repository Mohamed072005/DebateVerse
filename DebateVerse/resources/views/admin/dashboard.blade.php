@extends('admin.admin-layout.layout')
@section('content')
    <style>
        .order-card {
            color: #fff;
        }

        .bg-c-blue {
            background: linear-gradient(45deg, #4099ff, #73b4ff);
        }

        .bg-c-green {
            background: linear-gradient(45deg, #2ed8b6, #59e0c5);
        }

        .bg-c-yellow {
            background: linear-gradient(45deg, #FFB64D, #ffcb80);
        }

        .bg-c-red {
            background: linear-gradient(45deg, #FF5370, #ff869a);
        }

        .bg-c-secondary {
            background: linear-gradient(45deg, #838383, #ac9da0);
        }


        .card {
            border-radius: 5px;
            -webkit-box-shadow: 0 1px 2.94px 0.06px rgba(4, 26, 55, 0.16);
            box-shadow: 0 1px 2.94px 0.06px rgba(4, 26, 55, 0.16);
            border: none;
            margin-bottom: 30px;
            -webkit-transition: all 0.3s ease-in-out;
            transition: all 0.3s ease-in-out;
        }

        .card .card-block {
            padding: 25px;
        }

        .order-card i {
            font-size: 26px;
        }

        .f-left {
            float: left;
        }
    </style>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-4 col-xl-3">
                <div class="card bg-c-blue order-card">
                    <div class="card-block">
                        <h6 class="m-b-20">Messages</h6>
                        <h2 class="text-right d-flex justify-content-around align-items-center"><i class="fa fa-commenting" aria-hidden="true"></i><span>{{ $messages->count() }}</span></h2>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-xl-3">
                <div class="card bg-c-green order-card">
                    <div class="card-block">
                        <h6 class="m-b-20">Debates</h6>
                        <h2 class="text-right d-flex justify-content-around align-items-center"><i class="f-left"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 28 28" height="23" width="23" id="Event--Streamline-Ultimate"><desc>Event Streamline Icon: https://streamlinehq.com</desc><g id="Event--Streamline-Ultimate"><path d="M12.203333333333335 23.111666666666668a1.1666666666666667 1.1666666666666667 0 0 1 -0.8283333333333334 -0.3383333333333333L8.166666666666668 19.588333333333335a1.1666666666666667 1.1666666666666667 0 0 1 0 -1.645 1.1666666666666667 1.1666666666666667 0 0 1 1.6566666666666667 0l2.3333333333333335 2.3333333333333335 7.116666666666667 -7.128333333333334A1.1666666666666667 1.1666666666666667 0 0 1 21 14.828333333333335l-7.956666666666668 7.945a1.1666666666666667 1.1666666666666667 0 0 1 -0.84 0.3383333333333333Z" fill="#ffffff" stroke-width="1"></path><path d="M25.083333333333336 3.5h-3.2083333333333335a0.2916666666666667 0.2916666666666667 0 0 1 -0.2916666666666667 -0.2916666666666667V1.1666666666666667a1.1666666666666667 1.1666666666666667 0 0 0 -2.3333333333333335 0v5.541666666666667a0.8866666666666667 0.8866666666666667 0 0 1 -0.875 0.875 0.8866666666666667 0.8866666666666667 0 0 1 -0.875 -0.875V4.083333333333334a0.5833333333333334 0.5833333333333334 0 0 0 -0.5833333333333334 -0.5833333333333334H9.625A0.2916666666666667 0.2916666666666667 0 0 1 9.333333333333334 3.2083333333333335V1.1666666666666667a1.1666666666666667 1.1666666666666667 0 0 0 -2.3333333333333335 0v5.541666666666667a0.8866666666666667 0.8866666666666667 0 0 1 -0.875 0.875 0.8866666666666667 0.8866666666666667 0 0 1 -0.875 -0.875V4.083333333333334A0.5833333333333334 0.5833333333333334 0 0 0 4.666666666666667 3.5H2.916666666666667a2.3333333333333335 2.3333333333333335 0 0 0 -2.3333333333333335 2.3333333333333335v19.833333333333336a2.3333333333333335 2.3333333333333335 0 0 0 2.3333333333333335 2.3333333333333335h22.166666666666668a2.3333333333333335 2.3333333333333335 0 0 0 2.3333333333333335 -2.3333333333333335V5.833333333333334a2.3333333333333335 2.3333333333333335 0 0 0 -2.3333333333333335 -2.3333333333333335ZM24.5 25.666666666666668H3.5a0.5833333333333334 0.5833333333333334 0 0 1 -0.5833333333333334 -0.5833333333333334v-14A0.5833333333333334 0.5833333333333334 0 0 1 3.5 10.5h21a0.5833333333333334 0.5833333333333334 0 0 1 0.5833333333333334 0.5833333333333334v14a0.5833333333333334 0.5833333333333334 0 0 1 -0.5833333333333334 0.5833333333333334Z" fill="#ffffff" stroke-width="1"></path></g></svg></i><span>{{ $debates->count() }}</span></h2>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-xl-3">
                <div class="card bg-c-yellow order-card">
                    <div class="card-block">
                        <h6 class="m-b-20">Users</h6>
                        <h2 class="text-right d-flex justify-content-around align-items-center"><i class="fa fa-user f-left"></i><span>{{ $users }}</span></h2>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-xl-3">
                <div class="card bg-c-red order-card">
                    <div class="card-block">
                        <h6 class="m-b-20">Suggestions</h6>
                        <h2 class="text-right d-flex justify-content-around align-items-center"><i class="fa fa-question-circle"></i><span>{{ $suggestions->count() }}</span></h2>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-xl-3">
                <div class="card bg-c-red order-card">
                    <div class="card-block">
                        <h6 class="m-b-20">Tags</h6>
                        <h2 class="text-right d-flex justify-content-around align-items-center"><i class="fa fa-tag"></i><span>{{ $tags->count() }}</span></h2>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-xl-3">
                <div class="card bg-c-secondary order-card">
                    <div class="card-block">
                        <h6 class="m-b-20">Admins</h6>
                        <h2 class="text-right d-flex justify-content-around align-items-center"><i class="fa fa-user-secret"></i><span>{{ $admins }}</span></h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
