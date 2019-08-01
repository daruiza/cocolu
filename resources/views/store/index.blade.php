@extends('layouts.app')

@section('template')
    <link href="{{ asset('css/custom/welcome.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom/col_md_custom.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom/perfil.css') }}" rel="stylesheet">    
@endsection

@section('content')

@auth
@else
    <div class="video-container">
        <video loop="loop" id="video_background" autoplay preload muted>
          <source 
            src="{{ asset('media/EnteringTheStronghold.webm') }}"             
            type="video/webm">     
          
        </video>
    </div>
@endauth
<div class="flex-center position-ref full-height container">
    <div class="container">       
        @guest
            <div class="row">
                <div class="col-md-12">
                    <h3 class="title">{{ __('messages.Wellcome') }} {{ ucfirst($store->name) }}</h3>
                </div>
                <div class="product col-md-12">
                    products
                </div>    
            </div>
        @endguest                       
    </div>
</div>
@endsection

@section('style')
<style type="text/css">
    .py-4{
        padding-top: 1rem!important;
    }
    .navbar-laravel {
        background: #ffffff59;
        position: fixed;
        width: 100%;
        top: 0px;
        z-index: 1;
        display: none;
    }
    .title{
        color:#ffffff99;
    }
    .row{
        text-align: center;
    }
    .product{
        margin-top: 5rem;
    }
</style>
@endsection

@section('script')    
    <script type="application/javascript">
        /*
        if(window.innerWidth>980){
            $('#video_background').css('height',window.innerHeight);
            $('#video_background').css('width',window.innerWidth);
        }
        */
    </script>
    @yield('subscript')

    {{-- no es un buen punto, pero en template no funciono, es style css--}}
    @yield('subtemplate')
@endsection



