<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Blocked</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <style>
        .clearfix:before,
        .clearfix:after {
            display: table;

            content: ' ';
        }
        .clearfix:after {
            clear: both;
        }
        body {
            background: #f0f0f0 !important;
        }
        .page-403 .outer {
            position: absolute;
            top: 0;

            display: table;

            width: 100%;
            height: 100%;
        }
        .page-403 .outer .middle {
            display: table-cell;

            vertical-align: middle;
        }
        .page-403 .outer .middle .inner {
            width: 350px;
            margin-right: auto;
            margin-left: auto;
        }
        .page-403 .outer .middle .inner i {
            font-size: 5em;
            line-height: 1em;

            float: right;

            width: 1.6em;
            height: 1.6em;
            margin-top: -.7em;
            margin-right: -.5em;
            padding: 20px;

            -webkit-transition: all .4s;
            transition: all .4s;
            text-align: center;

            color: #f5f5f5!important;
            border-radius: 50%;
            background-color: #39bbdb;
            box-shadow: 0 0 0 15px #f0f0f0;
        }
        .page-403 .outer .middle .inner .inner-circle span {
            font-size: 11em;
            font-weight: 700;
            line-height: 1.2em;

            display: block;

            -webkit-transition: all .4s;
            transition: all .4s;
            text-align: center;

            color: #e0e0e0;
        }
        .page-403 .outer .middle .inner .inner-status {
            font-size: 20px;

            display: block;

            margin-top: 20px;
            margin-bottom: 5px;

            text-align: center;

            color: #39bbdb;
        }
        .page-403 .outer .middle .inner .inner-detail {
            line-height: 1.4em;

            display: block;

            margin-bottom: 10px;

            text-align: center;

            color: #999999;
        }
    </style>
</head>
<body>

</body>
</html>

<div class="page-403">
    <div class="outer">
        <div class="middle">
            <div class="inner">
                <!--BEGIN CONTENT-->
                <i class="fa fa-cogs"></i>
                <span class="inner-status">Send us your suggestions to enhance your experience.</span>
                <span class="inner-detail">Contact The Admin.</span>
                <!--END CONTENT-->
                <div>
                    <form action="{{ route('send.suggestion') }}" method="post">
                        @csrf
                        @method('POST')
                        <div class="form-group">
                            <textarea class="form-control" name="message" id="exampleFormControlTextarea1" rows="3" placeholder="send your suggestions..." style="resize: none"></textarea>
                        </div>
                        <div class="d-flex justify-content-center mt-3">
                            <button type="submit" class="btn btn-sm btn-flash-border-primary">send</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
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
