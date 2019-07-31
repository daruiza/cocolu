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
            

               HELLO 
            
            </div>                  
        @endguest                       
    </div>
</div>
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



