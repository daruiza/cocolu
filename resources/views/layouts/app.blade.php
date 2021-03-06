<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        @guest
            @isset($store)
                {{ $store->name }}
            @else
                {{ config('app.name', 'Cocolú') }}
            @endisset
            
        @else
            @if(Auth::user()->rol()->first()->id != 1)
                {{Auth::user()->store()->name}}
            @else
                {{ config('app.name', 'Cocolú') }}
            @endif
        @endguest       
    </title>
    
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">    
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    @auth    
    <style type="text/css">
        body{
            background-color: {{ json_decode(Auth::user()->store()->label,true)['table']['colorbody'] }};
        }
    </style>
    @endauth

    @yield('template')
    @yield('style')
</head>
<body>
    <div id="app">
        @include('layouts.events')            
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    @guest
                        @isset($store)
                            {{ $store->name }}
                        @else
                            {{ config('app.name', 'Cocolú') }}
                        @endisset
                    @else
                        @if(Auth::user()->rol()->first()->id != 1)
                            {{Auth::user()->store()->name}}
                        @else
                            {{ config('app.name', 'Cocolú') }}
                        @endif
                    @endguest
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
                            <div class="dropdown lang-flat">
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
                                            <a id="navbarDropdown{{$key_permit}}" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                                {{ __('options.'.$key_permit) }} <span class="caret"></span>
                                            </a>
                                            <div class="dropdown-menu" aria-labelledby="navbarDropdown{{$key_permit}}">                                       
                                            @foreach ($permit['options'] as $key_option => $option)
                                                
                                                @if($option['active'])
                                                    @if(json_decode($option['label'], true)['menu'] == 'top')
                                                        <a class="dropdown-item" href="{{ route(json_decode($permit['label'], true)['action'].'.'.$option['name']) }}"
                                                           onclick="event.preventDefault();
                                                                         document.getElementById('{{json_decode($permit['label'], true)['action'].'-'.$option['name'].'-form'}}').submit()">
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
                            <li class="nav-item dropdown alert-option">
                                <a id="navbarDropdownAlert" class="nav-link  dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <i class="fas fa-bell"></i>
                                    <span class="badge"></span>                                    
                                </a>
                                <div class="dropdown-menu dropdown-content" aria-labelledby="navbarDropdownAlert">
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdownUser" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <i class="fas fa-user"></i>
                                    {{ Auth::user()->name }} 
                                    <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu" aria-labelledby="navbarDropdownUser">

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
