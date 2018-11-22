@extends('layouts.app')

@section('template')
    <link href="{{ asset('css/custom/welcome.css') }}" rel="stylesheet">    
@endsection

@section('content')

@auth<!-- no fondo -->
@else
    <div class="video-container">
        <video loop="loop" id="video_background" autoplay preload muted>
          <source 
            src="{{ asset('media/EnteringTheStronghold.webm') }}" 
            src="{{ asset('media/EnteringTheStronghold.mp4') }}"
            type="video/webm">           
          </source>
        </video>
    </div>
@endauth

<div class="flex-center position-ref full-height container">
    
    <div class="container">
        <div class="row">
       
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('messages.welcome') }}</div>
                    <div class="card-body">
                        {{ __('messages.welcomeContent') }}
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                
                @include('layouts.alert')
                
                <div class="card">
                    <div class="card-header">{{ __('messages.welcome') }}</div>
                    <div class="card-body">
                        {{ __('messages.welcomeContent') }}
                    </div>
                </div>
                
            </div>

            <div class="col-md-6 align-self-center">
                @guest
                @else
                    <!--Usuarios Logueados-->
                    
                @endguest
                
            </div>            
        </div>        
    </div>

</div>
@endsection

@section('script')

<script type="text/javascript">
    /*
    if(window.innerWidth>980){
        $('#video_background').css('height',window.innerHeight);
        $('#video_background').css('width',window.innerWidth);
    }
    */

</script> 
@endsection


