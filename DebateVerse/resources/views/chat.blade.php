@extends('layout.layout')
@section('title', 'chat')
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



        .fa-2x {
  font-size: 1.5em;
}

.app-one {
  background-color: #f7f7f7;
  overflow: hidden;
  margin: 0;
  padding: 0;
  box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .06), 0 2px 5px 0 rgba(0, 0, 0, .2);
}

.side {
  padding: 0;
  margin: 0;
  height: 100%;
}
.side-one {
  padding: 0;
  margin: 0;
  height: 100%;
  width: 100%;
  z-index: 1;
  position: relative;
  display: block;
  top: 0;
}

.side-two {
  padding: 0;
  margin: 0;
  height: 100%;
  width: 100%;
  z-index: 2;
  position: relative;
  top: -100%;
  left: -100%;
  -webkit-transition: left 0.3s ease;
  transition: left 0.3s ease;

}


.heading {
  padding: 10px 16px 10px 15px;
  margin: 0;
  height: 60px;
  width: 100%;
  background-color: #eee;
  z-index: 1000;
}

.heading-avatar {
  padding: 0;
  cursor: pointer;

}

.heading-avatar-icon img {
  border-radius: 50%;
  height: 40px;
  width: 40px;
}

.heading-name {
  padding: 0 !important;
  cursor: pointer;
}

.heading-name-meta {
  font-weight: 700;
  font-size: 100%;
  text-align: left;
  text-overflow: ellipsis;
  white-space: nowrap;
  color: #000;
  display: block;
}
.heading-online {
  display: none;
  padding: 0 5px;
  font-size: 12px;
  color: #93918f;
}
.heading-compose {
  padding: 0;
}

.heading-compose i {
  text-align: center;
  padding: 5px;
  color: #93918f;
  cursor: pointer;
}

.heading-dot {
  padding: 0;
  margin-left: 10px;
}

.heading-dot i {
  text-align: right;
  padding: 5px;
  color: #93918f;
  cursor: pointer;
}

.searchBox {
  padding: 0 !important;
  margin: 0 !important;
  height: 60px;
  width: 100%;
}

.searchBox-inner {
  height: 100%;
  width: 100%;
  padding: 10px !important;
  background-color: #fbfbfb;
}


/*#searchBox-inner input {
  box-shadow: none;
}*/

.searchBox-inner input:focus {
  outline: none;
  border: none;
  box-shadow: none;
}

.sideBar {
  padding: 0 !important;
  margin: 0 !important;
  background-color: #fff;
  overflow-y: auto;
  border: 1px solid #f7f7f7;
  height: calc(100% - 120px);
}

.sideBar-body {
  position: relative;
  padding: 10px !important;
  border-bottom: 1px solid #f7f7f7;
  height: 72px;
  margin: 0 !important;
  cursor: pointer;
}

.sideBar-body:hover {
  background-color: #f2f2f2;
}

.sideBar-avatar {
  text-align: center;
  padding: 0 !important;
}

.avatar-icon img {
  border-radius: 50%;
  height: 49px;
  width: 49px;
}

.sideBar-main {
  padding: 0 !important;
}

.sideBar-main .row {
  padding: 0 !important;
  margin: 0 !important;
}

.sideBar-name {
  padding: 10px !important;
}

.name-meta {
  font-size: 100%;
  padding: 1% !important;
  text-align: left;
  text-overflow: ellipsis;
  white-space: nowrap;
  color: #000;
}

.sideBar-time {
  padding: 10px !important;
}

.time-meta {
  text-align: right;
  font-size: 12px;
  padding: 1% !important;
  color: rgba(0, 0, 0, .4);
  vertical-align: baseline;
}

/*New Message*/

.newMessage {
  padding: 0 !important;
  margin: 0 !important;
  height: 100%;
  position: relative;
  left: -100%;
}
.newMessage-heading {
  padding: 10px 16px 10px 15px !important;
  margin: 0 !important;
  height: 100px;
  width: 100%;
  background-color: #00bfa5;
  z-index: 1001;
}

.newMessage-main {
  padding: 10px 16px 0 15px !important;
  margin: 0 !important;
  height: 60px;
  margin-top: 30px !important;
  width: 100%;
  z-index: 1001;
  color: #fff;
}

.newMessage-title {
  font-size: 18px;
  font-weight: 700;
  padding: 10px 5px !important;
}
.newMessage-back {
  text-align: center;
  vertical-align: baseline;
  padding: 12px 5px !important;
  display: block;
  cursor: pointer;
}
.newMessage-back i {
  margin: auto !important;
}

.composeBox {
  padding: 0 !important;
  margin: 0 !important;
  height: 60px;
  width: 100%;
}

.composeBox-inner {
  height: 100%;
  width: 100%;
  padding: 10px !important;
  background-color: #fbfbfb;
}

.composeBox-inner input:focus {
  outline: none;
  border: none;
  box-shadow: none;
}

.compose-sideBar {
  padding: 0 !important;
  margin: 0 !important;
  background-color: #fff;
  overflow-y: auto;
  border: 1px solid #f7f7f7;
  height: calc(100% - 160px);
}

/*Conversation*/

.conversation {
  border-left: 1px solid rgba(0, 0, 0, .08);
}

.message {
  background-size: cover;
  overflow: auto;
  border: 1px solid #f7f7f7;
    height: 500px;
}
.message-previous {
  margin : 0 !important;
  padding: 0 !important;
  height: auto;
  width: 100%;
}
.previous {
  font-size: 15px;
  text-align: center;
  padding: 10px !important;
  cursor: pointer;
}

.previous a {
  text-decoration: none;
  font-weight: 700;
}

.message-main-receiver {
  /*padding: 10px 20px;*/
  max-width: 60%;
}

.message-main-sender {
  padding: 3px 20px !important;
  margin-left: 40% !important;
  max-width: 60%;
}

.message-text {
  margin: 0 !important;
  padding: 5px !important;
  word-wrap:break-word;
  font-weight: 200;
  font-size: 14px;
  padding-bottom: 0 !important;
}

.message-time {
  margin: 0 !important;
  margin-left: 50px !important;
  font-size: 12px;
  text-align: right;
  color: #9a9a9a;

}

.receiver {
    margin-left: 25px;
  width: auto !important;
  padding: 4px 10px 7px !important;
  border-radius: 10px 10px 10px 0;
  background: #ffffff;
  font-size: 12px;
  text-shadow: 0 1px 1px rgba(0, 0, 0, .2);
  word-wrap: break-word;
  display: inline-block;
}

.sender {
  float: right;
  width: auto !important;
  background: #dcf8c6;
  border-radius: 10px 10px 0 10px;
  padding: 4px 10px 7px !important;
  font-size: 12px;
  text-shadow: 0 1px 1px rgba(0, 0, 0, .2);
  display: inline-block;
  word-wrap: break-word;
}


/*Reply*/

.reply {
  height: 60px;
  width: 100%;
  background-color: #f5f1ee;
  padding: 10px 5px 10px 5px !important;
  margin: 0 !important;
  z-index: 1000;
}

.reply-emojis {
  padding: 5px !important;
}

.reply-emojis i {
  text-align: center;
  padding: 5px 5px 5px 5px !important;
  color: #93918f;
  cursor: pointer;
}

.reply-recording {
  padding: 5px !important;
}

.reply-recording i {
  text-align: center;
  padding: 5px !important;
  color: #93918f;
  cursor: pointer;
}

.reply-send {
  padding: 5px !important;
}

.reply-send i {
  text-align: center;
  padding: 5px !important;
  color: #93918f;
  cursor: pointer;
}

.reply-main {
  padding: 2px 5px !important;
}

.reply-main textarea {
  width: 100%;
  resize: none;
  overflow: hidden;
  padding: 5px !important;
  outline: none;
  border: none;
  text-indent: 5px;
  box-shadow: none;
  height: 100%;
  font-size: 16px;
}

.reply-main textarea:focus {
  outline: none;
  border: none;
  text-indent: 5px;
  box-shadow: none;
}

@media screen and (max-width: 700px) {
  .app {
    top: 0;
    height: 100%;
  }
  .heading {
    height: 70px;
    background-color: #009688;
  }
  .fa-2x {
    font-size: 2.3em !important;
  }
  .heading-avatar {
    padding: 0 !important;
  }
  .heading-avatar-icon img {
    height: 50px;
    width: 50px;
  }
  .heading-compose {
    padding: 5px !important;
  }
  .heading-compose i {
    color: #fff;
    cursor: pointer;
  }
  .heading-dot {
    padding: 5px !important;
    margin-left: 10px !important;
  }
  .heading-dot i {
    color: #fff;
    cursor: pointer;
  }
  .sideBar {
    height: calc(100% - 130px);
  }
  .sideBar-body {
    height: 80px;
  }
  .sideBar-avatar {
    text-align: left;
    padding: 0 8px !important;
  }
  .avatar-icon img {
    height: 55px;
    width: 55px;
  }
  .sideBar-main {
    padding: 0 !important;
  }
  .sideBar-main .row {
    padding: 0 !important;
    margin: 0 !important;
  }
  .sideBar-name {
    padding: 10px 5px !important;
  }
  .name-meta {
    font-size: 16px;
    padding: 5% !important;
  }
  .sideBar-time {
    padding: 10px !important;
  }
  .time-meta {
    text-align: right;
    font-size: 14px;
    padding: 4% !important;
    color: rgba(0, 0, 0, .4);
    vertical-align: baseline;
  }
  /*Conversation*/
  .conversation {
    padding: 0 !important;
    margin: 0 !important;
    height: 100%;
    /*width: 100%;*/
    border-left: 1px solid rgba(0, 0, 0, .08);
    /*overflow-y: auto;*/
  }
  .message {
    height: calc(100% - 140px);
  }
  .reply {
    height: 70px;
  }
  .reply-main {
    padding: 2px 8px !important;
  }
  .reply-main textarea {
    padding: 8px !important;
    font-size: 18px;
  }
}
    </style>
    <div class="col-md-8 col-xl-6 middle-wrapper app">
        <div class="row app-one">
            <div class="conversation">
                <div class="row heading">
                    <div class="col-sm-2 col-md-1 col-xs-3 col-3 heading-avatar">
                        <div class="heading-avatar-icon">
                            @if($user->gender_id == 1)
                                <img src="{{ asset('asset/male.png') }}" alt="#">
                            @else
                                <img src="{{ asset('asset/female.png') }}" alt="#">
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-1 col-xs-1 col-8 heading-name">
                        <a href="{{ route('users.profile', $user->id) }}" class="navbar-brand heading-name-meta w-25">{{ $user->user_name }}</a>
                        <span class="heading-online">Online</span>
                    </div>
                </div>

                <div class="row message" id="conversation">
                    @foreach($messages as $message)
                            @if($message->receiver_id == Auth::id())
                                <div class="col-md-12 row p-2">
                                    <div class=" message-main-receiver">
                                        <div class="receiver">
                                            <div class="message-text">
                                                {{ $message->message }}
                                            </div>
                                            <span class="message-time pull-right">
                                    {{ $message->created_at->diffForHumans() }}
                                </span>
                                        </div>
                                    </div>
                                </div>
                        @else
                            <div class="col-md-12 row p-2">
                                <div class=" message-main-sender">
                                    <div class="sender">
                                        <div class="message-text">
                                            {{ $message->message }}
                                        </div>
                                        <span class="message-time pull-right">
                                    {{ $message->created_at->diffForHumans() }}
                                </span>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>

                <div class="reply d-flex justify-content-center">
                    <form action="{{ route('send.message', $user->id) }}" method="post" class="row d-flex w-100">
                        @csrf
                        @method('POST')
                        <div class="col-sm-9 col-xs-9 col-10 reply-main">
                            <textarea class="form-control" name="message" rows="1" id="comment"></textarea>
                        </div>
                        <div class="col-sm-1 col-xs-1 col-1 reply-send">
                            <button type="submit" style="border: none; background: none">
                                <i class="fa fa-send fa-2x" aria-hidden="true"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
