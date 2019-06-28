<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $store->name }}</title>
    
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">    
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet"> 
    @yield('template')
    @yield('style')
</head>
<body>
    <div id="app">
        @include('layouts.events')            
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="#">
                    {{ $store->name }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">                        
                        <li><i class="fas fa-tags"></i>{{ __('options.letter') }}</li>
                        <li><i class="fas fa-home"></i>{{ __('options.moreStore') }} {{ $store->name }}</li>
                    </ul>
                </div>
            </div>
        </nav>
        

        <main class="py-4">            
            @yield('content')
            @auth               
                <footer>
                    <p>
                        @guest
                            Copyright © {{date("Y")}} TempoSolutions
                        @else
                            @if(Auth::user()->rol()->first()->id != 1)
                                {{ __('messages.SystemDate') }}                        
                                {{ Auth::user()->store()->clousureOpen()->date_open }}
                                Copyright © {{date("Y")}} TempoSolutions
                            @endif
                        @endguest
                    </p>                    
                </footer> 
            @endauth
        </main>

        @yield('modal')
        @include('layouts.modal_alert')        

    </div>
    
    <script src="{{ asset('js/app.js') }}"></script>
    <script type="application/javascript" src="{{ asset('js/ajaxobject.js') }}"></script> 
    <script type="application/javascript" src="{{ asset('js/entity/store.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/traits/alert_events.js') }}"></script>            

    @yield('script')
            
</body>
</html>
