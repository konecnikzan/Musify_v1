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

    <div class="wrapper d-flex align-items-stretch" id="app">
        <sidebar :user="{{ auth()->user() }}"></sidebar>  

        <!-- Page Content  -->
        <div id="content" class="p-4 p-md-5 pt-5">  
            @php
                $i = 0;
            @endphp   
            @foreach ($data as $item)
                <div class="card">
                    <div class="ds-top"></div>
                    <div class="avatar-holder">
                        <img class="avatar{{ $i }}" src="{{ $item[2][0]->avatar }}" onmouseenter="showChat(this, '{{ $i }}')">
                        <a href="{{ route('chat', ['id' => Auth::user()->id . '&' . $item[0]]) }}" class="chat{{ $i }}" style="display: none; width: 100%; padding-bottom: 20px; padding-top: 20px;" onmouseleave="hideChat(this, '{{ $i }}')"><img src="{{ asset('images/chat.png') }}"></a>
                    </div>
                    <div class="name">
                        <a href="{{ route('profile', $item[0]) }}">{{ $item[1][0]->name }}</a>  
                    </div>
                    <div class="ds-info">
                        <div class="ds projects">
                            <h6 id="listened_genres">MOST LISTENED GENRES</h6>
                            <ul class="genre_list">
                                @if(!empty($item[3][0]))
                                    <li>{{ $item[3][0]->genre_name }}</li>
                                @endif    
                                @if(!empty($item[3][1]))    
                                    <li>{{ $item[3][1]->genre_name }}</li>
                                @endif    
                                @if(!empty($item[3][2]))  
                                    <li>{{ $item[3][2]->genre_name }}</li>
                                @endif
                                @if(!empty($item[3][3]))  
                                    <li>{{ $item[3][3]->genre_name }}</li>
                                @endif
                                @if(!empty($item[3][4]))  
                                    <li>{{ $item[3][4]->genre_name }}</li>
                                @endif
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

    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>

    <script>
        function showChat(x, id) {
            x.animate({opacity: 0}, 400);
            x.style.display = "none";
            var y = document.getElementsByClassName("chat" + id)[0];
            y.animate({opacity: 1}, 400);
            y.style.display = "block";
        } 
        
        function hideChat(x, id) {
            x.animate({opacity: 0}, 400);
            x.style.display = "none";
            var y = document.getElementsByClassName("avatar" + id)[0];
            y.animate({opacity: 1}, 400);
            y.style.display = "block";
        }
        
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
            'baseUrl' => url('/'),
            'routes' => collect(\Route::getRoutes())->mapWithKeys(function ($route) { return [$route->getName() => $route->uri()]; })
        ]) !!};
    </script>

</body>

</html>