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

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/card.css') }}">

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
        </nav>

        <!-- Page Content  -->
        <div id="content" class="p-4 p-md-5 pt-5">  
            @php
                $i = 0;
            @endphp   
            @foreach ($data as $item)
                <div class="card">
                    <div class="ds-top"></div>
                    <div class="avatar-holder">
                        <img class="avatar{{ $i }}" src="{{ $item[2][0]->avatar }}" onmouseover="showChat(this, '{{ $i }}')">
                        <a href="{{ route('chat', ['id' => Auth::user()->id . '&' . $item[0]]) }}" class="chat{{ $i }}" style="display: none;" onmouseout="hideChat(this, '{{ $i }}')"><img src="{{ asset('images/chat.png') }}"></a>
                    </div>
                    <div class="name">
                        <a href="{{ route('profile', $item[0]) }}">{{ $item[1][0]->name }}</a>  
                    </div>
                    <div class="ds-info">
                        <div class="ds projects">
                            <h6 id="listened_genres">MOST LISTENED GENRES</h6>
                            <ul class="genre_list">
                                <li>{{ $item[3][0]->genre_name }}</li>
                                <li>{{ $item[3][1]->genre_name }}</li>
                                <li>{{ $item[3][2]->genre_name }}</li>
                                <li>{{ $item[3][3]->genre_name }}</li>
                                <li>{{ $item[3][4]->genre_name }}</li>
                            </ul>
                        </div>
                    </div>          
                    <div class="ds-skill spotify_player">
                        <iframe src="{{ 'https://open.spotify.com/embed/artist/' . $item[4]->artist_id }}" width="230" height="80" frameborder="0" allowtransparency="true" allow="encrypted-media"></iframe>
                    </div>
                </div>
                @php
                    $i++;
                @endphp
            @endforeach
            
        </div>
    </div>

    <script>
        function showChat(x, id) {
            x.style.display = "none";
            var y = document.getElementsByClassName("chat" + id)[0];
            y.style.display = "block";
        } 
        
        function hideChat(x, id) {
            x.style.display = "none";
            var y = document.getElementsByClassName("avatar" + id)[0];
            y.style.display = "block";
        }   
    </script>

</body>

</html>