<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="{{ asset('images/icons/logo_new.ico') }}" />

    <title>Musify</title>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>

    <script>
        var base_url = '{{ url("/") }}';
    </script>

</head>

<body>

    <div class="wrapper d-flex align-items-stretch">
        <nav id="sidebar">
            <div class="custom-menu">
                <!--<button type="button" id="sidebarCollapse" class="btn btn-primary">
                    <i class="fa fa-bars"></i>
                    <span class="sr-only">Toggle Menu</span>
                    </button>-->
            </div>
            <div class="p-4">
                <div class="avatar_profile">
                    <a href="{{ route('home') }}"><img class="user_avatar" src="{{ Auth::user()->avatar }}" width="50" height="50"></a>    
                    <h4><a href="{{ route('profile', Auth::user()->id) }}" class="avatar_text">My Profile</a></h4>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST">
                        <input type="image" src="{{ asset('images/logout.png') }}" alt="" width="25" height="25">
                        @csrf
                    </form>
                </div>
                <div class="messages_text_div">
                    <h6 id="messages_text"><b>Messages</b></h6>
                </div>
                <div class="main_messages">
                    @foreach ($latestMessages as $message)
                        @if($message->sender_id != Auth::user()->id)
                            <div class="messages_bg" id="{{ $message->sender_id }}">
                                <img class="match-profile-image" src="{{ $message->sender_avatar }}" alt="">
                                @if(!$message->is_read)
                                    <span class="pending dot"></span>
                                @endif   
                                <div class="text">
                                    <h6><b>{{ $message->sender_name }}</b></h6>                             
                                    <p class="text-muted">{{ $message->message }}</p>
                                </div>
                            </div>
                        @elseif($message->recipient_id != Auth::user()->id)  
                            <div class="messages_bg" id="{{ $message->recipient_id }}">
                                <img class="match-profile-image" src="{{ $message->recipient_avatar }}" alt="">
                                <span class="pending dot"></span>
                                <div class="text">
                                    <h6><b>{{ $message->recipient_name }}</b></h6>                             
                                    <p class="text-muted">{{ $message->message }}</p>
                                </div>
                            </div>
                        @endif
                    @endforeach    
                </div>
            </div>
        </nav>

        <!-- Page Content  -->
        <div class="p-4 p-md-5 pt-5" style="width: 60vw;margin: 0 auto;height: 1000px;" id="messages_view">   
            <section class="msger">
                <main class="msger-chat">
                    @foreach($allMessages as $message)
                        <div class="msg {{ ($message->from == Auth::id()) ? 'right-msg' : 'left-msg' }}">
                            @foreach($allUsers as $user)
                                @if($user->id == $message->from)
                                    <div class="msg-img" style="background-image: url({{ $user->avatar }})"
                                    ></div>

                                    <div class="msg-bubble">
                                        <div class="msg-info">
                                            <div class="msg-info-name">{{ $user->name }}</div>
                                            <div class="msg-info-time">{{ date('d.m.Y, h:i ', strtotime($message->created_at)) }}</div>
                                        </div>

                                        <div class="msg-text">
                                            {{ $message->message }}
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    @endforeach    
                </main>

                <div class="msger-inputarea">
                    <input id="send-message" type="text" class="msger-input" placeholder="Enter your message...">
                </div>
            </section>
        </div>   
    </div>

    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!--<script src="{{ asset('js/app.js') }}" defer></script>-->

    <script>
        var receiver_id = '';
        var my_id = "{{ Auth::id() }}";

        $(document).ready(function () {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Enable pusher logging - don't include this in production
            Pusher.logToConsole = true;
            var pusher = new Pusher('e1ee26220f469456e168', {
                cluster: 'eu',
                forceTLS: true
            });

            var channel = pusher.subscribe('my-channel');
            channel.bind('my-event', function (data) {
                //alert(JSON.stringify(data));
                if (my_id == data.from) {
                    $('#' + data.to).click();           
                } else if (my_id == data.to) {
                    if (receiver_id == data.from) {
                        // if receiver is selected, reload the selected user ...
                        $('#' + data.from).click();
                    } else {
                        // if receiver is not seleted, add notification for that user
                        var pending = parseInt($('#' + data.from).find('.pending').html());
                        if (pending) {
                            $('#' + data.from).find('.pending').html(pending + 1);
                        } else {
                            $('#' + data.from).append('<span class="pending">1</span>');
                        }
                    }
                }
            });

            $('.messages_bg').click(function () {
                $('.messages_bg').removeClass('active');
                $(this).addClass('active');

                receiver_id = $(this).attr('id');
                string = "{{ Auth::id() }}" + "&" + String(receiver_id);

                var url = "{{route('chat', '')}}" + "/" + string;
                window.location = url;
            });
        });

        $("#send-message").on("keydown",function search(e) {
            var message = $(this).val();

            receiver_id = (window.location.href.split('/')[4]).split('&')[1];

            if(e.keyCode == 13) {
                $(this).val(''); // while pressed enter text box will be empty
                var datastr = "receiver_id=" + receiver_id + "&message=" + message;
                
                $.ajax({
                    type: "post",
                    url: "http://musify.com/message", // need to create this post route
                    data: datastr,
                    cache: false,
                    success: function (data) {
                    },
                    error: function (jqXHR, status, err) {
                    },
                    complete: function () {
                        scrollToBottomFunc();
                    }
                });
            }
        });

        function scrollToBottomFunc() {
            $('.msger-chat').animate({
                scrollTop: $('.msger-chat').get(0).scrollHeight
            }, 50);
        }
    </script>    

</body>

</html>