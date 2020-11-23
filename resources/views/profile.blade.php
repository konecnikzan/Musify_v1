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

    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>

    <script>
        var Laravel = {
            'csrfToken' : '{{csrf_token()}}'
        };
    </script>

</body>

</html>