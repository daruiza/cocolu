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
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">{{ __('messages.welcome') }}</div>
                    <div class="card-body">
                        {{ __('messages.welcomeContent') }}                        
                    </div>
                </div>
            </div>
                
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">{{ __('messages.welcomeTittleOffer') }}</div>
                    <div class="card-body" style="text-align: center;">
                        <div class="row">
                            <div class="col-md-12">                     
                                <div>{{ __('messages.Multilanguage') }}</div>
                                <div>{{ __('messages.RealTime') }}</div>
                                <div>{{ __('messages.Multiaccess') }}</div>
                                <div>{{ __('messages.NotificationsRealTime') }}</div>
                                <hr>
                            </div>
                            
                            <div class="col-md-6">                      
                                <div>{{ __('messages.categoryManagement') }}</div>                        
                                <div>{{ __('messages.inventoryManagement') }}</div>                        
                                <div>{{ __('messages.invoiceManager') }}</div>
                                <div>{{ __('messages.expenseManager') }}</div>
                                <div>{{ __('messages.costManager') }}</div>                                
                            </div>
                            <div class="col-md-6">
                                <div>{{ __('messages.profitMarginsManager') }}</div>
                                <div>{{ __('messages.ordersAndService') }}</div>                        
                                <div>{{ __('messages.waiterManagement') }}</div>                        
                                <div>{{ __('messages.LaborClosure') }}</div>
                                <div>{{ __('messages.reports') }}</div>
                            </div>
                           
                            <div class="col-md-12"> 
                                <hr>                                
                                <div><h5>{{ __('messages.configStoreManagement') }}</h5></div>
                                <div>{{ __('messages.nameDistribution') }}</div>
                                <div>{{ __('messages.colorsDistribution') }}</div>
                                <div>{{ __('messages.sizeTable') }}</div>
                                <div>{{ __('messages.sizeSalon') }}</div>
                               
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        @else
            @isset($page)                
                @include($page)                
            @endisset            
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



