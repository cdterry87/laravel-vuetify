<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
        <link rel="manifest" href="/site.webmanifest">
        <title>{{ config('app.name', 'Laravel-Vuetify') }}</title>
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="{{ mix('css/app.css') }}" rel="stylesheet">
        <link href="css/home.css" rel="stylesheet">
    </head>
    <body>
        <div id="home">
            <div class="content">
                <div class="title m-b-md">
                    Title
                    <div class="subtitle m-t-sm">
                        Some sample subtitle text.
                    </div>
                </div>
                <div class="links">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/home') }}" class="button">Get Started!</a>
                        @else
                            <a href="{{ route('login') }}">Login</a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}">Register</a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>
        </div>
    </body>
</html>
