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
                    <div class="messages_bg">
                        <img class="match-profile-image" src="https://www.clarity-enhanced.net/wp-content/uploads/2020/06/optimus-prime.jpeg" alt="">
                        <div class="text">
                            <h6><b>Optimus</b></h6>
                            <p class="text-muted">Wanna grab a beer?</p>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Page Content  -->
        <div class="p-4 p-md-5 pt-5" style="width: 60vw;margin: 0 auto;height: 950px;">   
            <section class="msger">
                <main class="msger-chat">
                    <div class="msg left-msg">
                        <div
                        class="msg-img"
                        style="background-image: url(https://image.flaticon.com/icons/svg/327/327779.svg)"
                        ></div>

                        <div class="msg-bubble">
                        <div class="msg-info">
                            <div class="msg-info-name">BOT</div>
                            <div class="msg-info-time">12:45</div>
                        </div>

                        <div class="msg-text">
                            Hi, welcome to SimpleChat! Go ahead and send me a message.ffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffff fffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffff😄
                        </div>
                        </div>
                    </div>

                    <div class="msg right-msg">
                        <div
                        class="msg-img"
                        style="background-image: url(https://image.flaticon.com/icons/svg/145/145867.svg)"
                        ></div>

                        <div class="msg-bubble">
                        <div class="msg-info">
                            <div class="msg-info-name">Sajad</div>
                            <div class="msg-info-time">12:46</div>
                        </div>

                        <div class="msg-text">
                            You can change your name in JS section!
                        </div>
                        </div>
                    </div>
                    <div class="msg left-msg">
                    <div
                    class="msg-img"
                    style="background-image: url(https://image.flaticon.com/icons/svg/327/327779.svg)"
                    ></div>

                    <div class="msg-bubble">
                    <div class="msg-info">
                        <div class="msg-info-name">BOT</div>
                        <div class="msg-info-time">12:45</div>
                    </div>

                    <div class="msg-text">
                        Hi, welcome to SimpleChat! Go ahead and send me a message.ffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffff fffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffff😄
                    </div>
                    </div>
                </div>

                <div class="msg right-msg">
                    <div
                    class="msg-img"
                    style="background-image: url(https://image.flaticon.com/icons/svg/145/145867.svg)"
                    ></div>

                    <div class="msg-bubble">
                    <div class="msg-info">
                        <div class="msg-info-name">Sajad</div>
                        <div class="msg-info-time">12:46</div>
                    </div>

                    <div class="msg-text">
                        You can change your name in JS section!
                    </div>
                    </div>
                </div>
                <div class="msg left-msg">
                    <div
                    class="msg-img"
                    style="background-image: url(https://image.flaticon.com/icons/svg/327/327779.svg)"
                    ></div>

                    <div class="msg-bubble">
                    <div class="msg-info">
                        <div class="msg-info-name">BOT</div>
                        <div class="msg-info-time">12:45</div>
                    </div>

                    <div class="msg-text">
                        Hi, welcome to SimpleChat! Go ahead and send me a message.ffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffff fffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffff😄
                    </div>
                    </div>
                </div>

                <div class="msg right-msg">
                    <div
                    class="msg-img"
                    style="background-image: url(https://image.flaticon.com/icons/svg/145/145867.svg)"
                    ></div>

                    <div class="msg-bubble">
                    <div class="msg-info">
                        <div class="msg-info-name">Sajad</div>
                        <div class="msg-info-time">12:46</div>
                    </div>

                    <div class="msg-text">
                        You can change your name in JS section!
                    </div>
                    </div>
                </div>
                <div class="msg left-msg">
                    <div
                    class="msg-img"
                    style="background-image: url(https://image.flaticon.com/icons/svg/327/327779.svg)"
                    ></div>

                    <div class="msg-bubble">
                    <div class="msg-info">
                        <div class="msg-info-name">BOT</div>
                        <div class="msg-info-time">12:45</div>
                    </div>

                    <div class="msg-text">
                        Hi, welcome to SimpleChat! Go ahead and send me a message.ffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffff fffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffff😄
                    </div>
                    </div>
                </div>

                <div class="msg right-msg">
                    <div
                    class="msg-img"
                    style="background-image: url(https://image.flaticon.com/icons/svg/145/145867.svg)"
                    ></div>

                    <div class="msg-bubble">
                    <div class="msg-info">
                        <div class="msg-info-name">Sajad</div>
                        <div class="msg-info-time">12:46</div>
                    </div>

                    <div class="msg-text">
                        You can change your name in JS section!
                    </div>
                    </div>
                </div>
                <div class="msg left-msg">
                    <div
                    class="msg-img"
                    style="background-image: url(https://image.flaticon.com/icons/svg/327/327779.svg)"
                    ></div>

                    <div class="msg-bubble">
                    <div class="msg-info">
                        <div class="msg-info-name">BOT</div>
                        <div class="msg-info-time">12:45</div>
                    </div>

                    <div class="msg-text">
                        Hi, welcome to SimpleChat! Go ahead and send me a message.ffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffff fffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffff😄
                    </div>
                    </div>
                </div>

                <div class="msg right-msg">
                    <div
                    class="msg-img"
                    style="background-image: url(https://image.flaticon.com/icons/svg/145/145867.svg)"
                    ></div>

                    <div class="msg-bubble">
                    <div class="msg-info">
                        <div class="msg-info-name">Sajad</div>
                        <div class="msg-info-time">12:46</div>
                    </div>

                    <div class="msg-text">
                        You can change your name in JS section!
                    </div>
                    </div>
                </div>
                <div class="msg left-msg">
                    <div
                    class="msg-img"
                    style="background-image: url(https://image.flaticon.com/icons/svg/327/327779.svg)"
                    ></div>

                    <div class="msg-bubble">
                    <div class="msg-info">
                        <div class="msg-info-name">BOT</div>
                        <div class="msg-info-time">12:45</div>
                    </div>

                    <div class="msg-text">
                        Hi, welcome to SimpleChat! Go ahead and send me a message.ffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffff fffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffff😄
                    </div>
                    </div>
                </div>

                <div class="msg right-msg">
                    <div
                    class="msg-img"
                    style="background-image: url(https://image.flaticon.com/icons/svg/145/145867.svg)"
                    ></div>

                    <div class="msg-bubble">
                    <div class="msg-info">
                        <div class="msg-info-name">Sajad</div>
                        <div class="msg-info-time">12:46</div>
                    </div>

                    <div class="msg-text">
                        You can change your name in JS section!
                    </div>
                    </div>
                </div>
                </main>

                <form class="msger-inputarea">
                    <input type="text" class="msger-input" placeholder="Enter your message...">
                </form>
            </section>
        </div>   
    </div>

    <script src="https://js.pusher.com/4.1/pusher.min.js"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>

</body>

</html>