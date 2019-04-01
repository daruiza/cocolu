<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Cocolú') }}</title>

    <!-- Scripts -->
    <!--<script src="{{ asset('js/app.js') }}" defer></script>-->

    <!-- Fonts -->

    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <!--
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous"> 
    -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">   
    <!--<link href="{{ asset('css/fontawesome.css') }}" rel="stylesheet">-->
    
    
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    
    <!--<link href="{{ asset('css/app.css') }}" rel="stylesheet">--> 

    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    @yield('template')
    @yield('style')
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Cocolú') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <div class="dropdown">
                                <button class="btn dropdown-toggle btn-sm" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-flag"></i>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="#" onclick="$('#form_locale_en').submit()" > {{ __('messages.English') }}</a>
                                    <a class="dropdown-item" href="#" onclick="$('#form_locale_es').submit()" >{{ __('messages.Spanish') }}</a>
                                </div>
                            </div>                                                                            
                            
                            <li><a class="nav-link" href="{{ route('login') }}">{{ __('messages.Login') }}</a></li>
                            <li><a class="nav-link" href="{{ route('register') }}">{{ __('messages.Register') }}</a></li>
                        @else
                            
                            @if(Session::has('permits'))
                                @foreach (Session::get('permits') as $key_permit => $permit)
                                    
                                    @if($permit['active'])
                                        <li class="nav-item dropdown">
                                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                                {{ __('options.'.$key_permit) }} <span class="caret"></span>
                                            </a>
                                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">                                       
                                            @foreach ($permit['options'] as $key_option => $option)
                                                
                                                @if($option['active'])
                                                    @if(json_decode($option['label'], true)['menu'] == 'top')
                                                        <a class="dropdown-item" href="{{ route(json_decode($permit['label'], true)['action'].'.'.$option['name']) }}"
                                                           onclick="event.preventDefault();
                                                                         document.getElementById('{{json_decode($permit['label'], true)['action'].'-'.$option['name'].'-form'}}').submit();">
                                                            <i class="{{ json_decode($option['label'], true)['icon'] }}"></i>
                                                            {{ __('options.'.$option['name']) }}
                                                        </a>

                                                        {!! Form::open(array('id'=>json_decode($permit['label'], true)['action'].'-'.$option['name'].'-form','route' => json_decode($permit['label'], true)['action'].'.'.$option['name'],'method' => json_decode($option['label'], true)['method'])) !!}
                                                        {!! Form::close() !!}
                                                    @endif                                            
                                                @endif

                                            @endforeach
                                            </div>
                                        </li>
                                    @endif
                                @endforeach
                            @endif

                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">

                                    <a class="dropdown-item" href="{{ route('user.index') }}" onclick="event.preventDefault();
                                                     document.getElementById('profile-form').submit();">
                                        {{ __('messages.Profile') }}
                                    </a>

                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('messages.Logout') }}
                                    </a>

                                    <form id="profile-form" action="{{ route('user.index') }}" method="GET" style="display: none;">                                        
                                    </form>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>


                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <!--Forms para cambio de idioma post-->
        {!! Form::open(array('url' => '/locale', 'id'=>'form_locale_en' )) !!}
            {!! Form::hidden('lang','en') !!}            
        {!! Form::close() !!}
        
        {!! Form::open(array('url' => '/locale', 'id'=>'form_locale_es' )) !!}
            {!! Form::hidden('lang','es') !!}            
        {!! Form::close() !!}

        <main class="py-4">
            @yield('content')
        </main>

        @yield('modal')
        <!--Bootatrap JS, Popper.js, and jQuery-->
        
        <script type="text/javascript" src="{{ url('js/jquery.min.js') }}"></script>        
        <script type="text/javascript" src="{{ url('js/jquery-ui.min.js') }}"></script>
        <!--
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
        -->
        <script src="{{ asset('js/popper.min.js') }}"></script> 
        <script src="{{ asset('js/bootstrap.min.js') }}"></script> 
        <script src="{{ asset('js/ajaxobject.js') }}"></script> 
        <script src="{{ asset('js/entity/store.js') }}"></script>    
        @yield('script')        
    </div>
</body>
</html>
