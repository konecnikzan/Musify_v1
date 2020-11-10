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
                    <div class="messages_bg">
                        <img class="match-profile-image" src="https://www.clarity-enhanced.net/wp-content/uploads/2020/06/optimus-prime.jpeg" alt="">
                        <div class="text">
                            <h6><b>Optimus</b></h6>
                            <p class="text-muted">Wanna grab a beer?</p>
                        </div>
                    </div>
                    <div class="messages_bg">
                        <img class="match-profile-image" src="https://www.clarity-enhanced.net/wp-content/uploads/2020/06/optimus-prime.jpeg" alt="">
                        <div class="text">
                            <h6><b>Optimus</b></h6>
                            <p class="text-muted">Wanna grab a beer?</p>
                        </div>
                    </div>
                    <div class="messages_bg">
                        <img class="match-profile-image" src="https://www.clarity-enhanced.net/wp-content/uploads/2020/06/optimus-prime.jpeg" alt="">
                        <div class="text">
                            <h6><b>Optimus</b></h6>
                            <p class="text-muted">Wanna grab a beer?</p>
                        </div>
                    </div>
                    <div class="messages_bg">
                        <img class="match-profile-image" src="https://www.clarity-enhanced.net/wp-content/uploads/2020/06/optimus-prime.jpeg" alt="">
                        <div class="text">
                            <h6><b>Optimus</b></h6>
                            <p class="text-muted">Wanna grab a beer?</p>
                        </div>
                    </div>
                    <div class="messages_bg">
                        <img class="match-profile-image" src="https://www.clarity-enhanced.net/wp-content/uploads/2020/06/optimus-prime.jpeg" alt="">
                        <div class="text">
                            <h6><b>Optimus</b></h6>
                            <p class="text-muted">Wanna grab a beer?</p>
                        </div>
                    </div>
                    <div class="messages_bg">
                        <img class="match-profile-image" src="https://www.clarity-enhanced.net/wp-content/uploads/2020/06/optimus-prime.jpeg" alt="">
                        <div class="text">
                            <h6><b>Optimus</b></h6>
                            <p class="text-muted">Wanna grab a beer?</p>
                        </div>
                    </div>
                    <div class="messages_bg">
                        <img class="match-profile-image" src="https://www.clarity-enhanced.net/wp-content/uploads/2020/06/optimus-prime.jpeg" alt="">
                        <div class="text">
                            <h6><b>Optimus</b></h6>
                            <p class="text-muted">Wanna grab a beer?</p>
                        </div>
                    </div>
                    <div class="messages_bg">
                        <img class="match-profile-image" src="https://www.clarity-enhanced.net/wp-content/uploads/2020/06/optimus-prime.jpeg" alt="">
                        <div class="text">
                            <h6><b>Optimus</b></h6>
                            <p class="text-muted">Wanna grab a beer?</p>
                        </div>
                    </div>
                    <div class="messages_bg">
                        <img class="match-profile-image" src="https://www.clarity-enhanced.net/wp-content/uploads/2020/06/optimus-prime.jpeg" alt="">
                        <div class="text">
                            <h6><b>Optimus</b></h6>
                            <p class="text-muted">Wanna grab a beer?</p>
                        </div>
                    </div>
                    <div class="messages_bg">
                        <img class="match-profile-image" src="https://www.clarity-enhanced.net/wp-content/uploads/2020/06/optimus-prime.jpeg" alt="">
                        <div class="text">
                            <h6><b>Optimus</b></h6>
                            <p class="text-muted">Wanna grab a beer?</p>
                        </div>
                    </div>
                    <div class="messages_bg">
                        <img class="match-profile-image" src="https://www.clarity-enhanced.net/wp-content/uploads/2020/06/optimus-prime.jpeg" alt="">
                        <div class="text">
                            <h6><b>Optimus</b></h6>
                            <p class="text-muted">Wanna grab a beer?</p>
                        </div>
                    </div>
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
        <div class="p-4 p-md-5 pt-5 profile_content">  

            <div></div>

            <div>
                <img src="{{ $data[0][0]->avatar }}">
                <p>{{ $data[1][0]->name }}</p>
            </div>  
            
            <div></div>
            <div></div>

            <div class="profile_fav_tab">
                <p>FAVORITE GENRES</p>
                @foreach ($data[2] as $item)
                    <p class="profile_all">{{ $item->genre_name }}</p>
                @endforeach
            </div>

            <div class="profile_fav_tab">
                <p>FAVORITE ARTISTS</p>
                <div class="fav_artist_grid">
                    @foreach ($data[3] as $item)
                        <div class="fav_artists_card">
                            <img src="{{ $item->image }}">
                            <p class="profile_all">{{ $item->artist_name }}</p>                           
                        </div>    
                    @endforeach  
                </div>       
            </div>

            <div class="profile_fav_tab profile_fav_tab_music">
                <p>FAVORITE SONGS</p>
                @foreach ($data[4] as $item)
                    <div class="fav_music_card">
                        <iframe src="{{ 'https://open.spotify.com/embed/track/' . $item->id }}" width="330" height="80" frameborder="0" allowtransparency="true" allow="encrypted-media"></iframe>
                    </div>
                @endforeach 
            </div>

        </div>
  
    </div>

</body>

</html>