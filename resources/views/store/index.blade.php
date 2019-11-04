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
                <div class="products col-md-12">
                    <div class="row">
                    @foreach($products as $product)
                        <div class="col-md-5 product col-md-offset-1">                            
                            <div class="img-product">
                                {{ Html::image('users/'.$id_myadmin.'/products/'.$product->image1,'Imagen no disponible',array('id'=>'img_product_img'))}}    
                            </div>                            
                        </div>
                        <div class="col-md-5 product-description col-md-offset-1">
                            <div><h4>{{ ucfirst($product->name)}}</h4></div>
                            <div><h5>{{ ucfirst($product->description)}}</h5></div>
                            <div><h4>{{ __('messages.Price') }} ${{ number_format($product->price)}}</h4></div>
                        </div>                       
                    @endforeach
                    </div>
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
    .products{
        margin-top: 5rem;
    }
    .product{
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .product,.product-description{        
        color:#ffffff99;        
        padding: 10px;
    }
    .product-description{        
        color: #22212199;
        background: #ffffffbf;
        border-radius: 4%; 
        height: 300px;    
    }
    .img-product{
        opacity: 0.0;        
    }
    .img-product img{        
        max-width: 100%;
        max-height: 300px;
    }
</style>
@endsection

@section('script')    
    <script type="application/javascript">
        $(document).ready(function(){setTimeout(refrescar, 30000);});        
        function refrescar(){location.reload();}        
        $( ".img-product" ).animate({
            opacity: 0.95,            
        },4000, function() {
    
        });
        
       
    </script>
    @yield('subscript')

    {{-- no es un buen punto, pero en template no funciono, es style css--}}
    @yield('subtemplate')
@endsection



