<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css" integrity="sha384-vp86vTRFVJgpjF9jiIGPEEqYqlDwgyBgEF109VFjmqGmIY/Y4HV4d3Gp2irVfcrp" crossorigin="anonymous">


        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
                display:flex;
                align-items:center;
                justify-content:space-evenly;                
            }

            .m-b-md {
                margin-bottom: 30px;
            }

            .go {
                margin:15px 0;
            }

            .go:first-of-type {
                border-bottom: 1px solid gray !important;
                padding-bottom:10px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">            
            <div class="content">
                <div class="title m-b-md">
                    Share It
                </div>
                <div class="links">
                @if (Route::has('login'))                   
                    @auth
                        <a href="{{ url('/upload-file') }}">Go to Upload File <i class="fas fa-arrow-circle-right fa-2x"></i> </a>
                    @else
                        <a class="go" href="{{ route('login') }}">Login <i class="fas fa-sign-in-alt fa-2x"></i></a>

                        @if (Route::has('register'))
                            <a class="go" href="{{ route('register') }}">Register <i class="fas fa-play-circle fa-2x"></i> </a>
                        @endif
                    @endauth                   
                @endif
                </div>
            </div>
        </div>
    </body>
</html>
