@foreach($users as $user)
    <div class="d-flex justify-content-between mb-2 pb-2">
        <div class="d-flex align-items-center hover-pointer">
            @if($user->gender_id == 1)
                <img class="img-xs rounded-circle" src="{{ asset('asset/male.png') }}" alt="">
            @else
                <img class="img-xs rounded-circle" src="{{ asset('asset/female.png') }}" alt="">
            @endif
            <div class="ml-2">
                <a href="{{ route('users.profile', $user->id) }}" class="navbar-brand">
                    <p>{{ $user->user_name }}</p>
                </a>
            </div>
        </div>
        @php
            $checkSend = null;
            $checkReceiver = null;
            foreach ($user->receiveRequest as $receiver){
                if ($receiver->sender_id == Auth::id() && $receiver->status == 1){
                    $checkSend = true;
                    break;
                }
            }

            foreach ($user->sendRequest as $sender){
                if ($sender->receiver_id == Auth::id() && $sender->status == 1){
                    $checkReceiver = true;
                    break;
                }
            }
        @endphp
        @if($checkSend || $checkReceiver)
            <div class="d-flex align-items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="text-success" width="30" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="20 6 9 17 4 12"></polyline>
                </svg>
            </div>
        @else
            <form action="{{ route('send.friend.request', $user->id) }}" class="d-flex align-items-center" method="post">
                @csrf
                @method('POST')
                <button type="submit" class="btn btn-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user-plus" data-toggle="tooltip" title="" data-original-title="Connect">
                        <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                        <circle cx="8.5" cy="7" r="4"></circle>
                        <line x1="20" y1="8" x2="20" y2="14"></line>
                        <line x1="23" y1="11" x2="17" y2="11"></line>
                    </svg>
                </button>
            </form>
        @endif
    </div>
@endforeach
