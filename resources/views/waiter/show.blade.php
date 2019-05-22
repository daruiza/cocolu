@extends('layouts.app')

@section('template')
    <link href="{{ asset('css/custom/options.css') }}" rel="stylesheet">    
@endsection

@section('content')
<div class="flex-center position-ref full-height container">    
    <div class="container">
        <div class="row">
        	<div class="col-md-3">
                <div class="card card-menu-table">
                    <div class="card-header">{{ __('messages.ProductShow') }}</div>
                    <div class="card-body">
                        <div class="container waiter-show">
                            <div class="row">
                            	<div class="col-md-12">
									{{ __('messages.Name') }}: <b>{{$waiter->name}}</b>
								</div>
								<div class="col-md-12">
									{{ __('messages.Surname') }}: <b>{{$waiter->surname}}</b>
								</div>
								<div class="col-md-12">
									{{ __('messages.E-Mail Address') }}: <b>{{$waiter->email}}</b>
								</div>
								<div class="col-md-12">
									{{ __('messages.Phone') }}: <b>{{$waiter->phone}}</b>
								</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">	        		
                <div class="card card-menu-table">
                    <div class="card-header">{{ __('messages.WaiterDescription') }}</div>
                    <div class="card-body">
                        <div class="container services-table">
                            <div class="row">                                
								<div class="col-md-12">historial de mesero</div>
								<div class="col-md-12">Ordenes atendidas</div>
								<div class="col-md-12">Dinero generado</div>
                            </div>                                                  
                        </div>                  
                    </div>                            
                </div>
        	</div>

        	<div class="col-md-3">	        		
	                <div class="card card-menu-table">
	                    <div class="card-header">{{ __('messages.WaiterImages') }}</div>
	                    <div class="card-body">
	                        <div class="container services-table">
	                            <div class="row">                                
									<div class="col-md-12">
										{{ Html::image('users/'.$waiter->id.'/profile/'.$waiter->avatar,'Imagen no disponible',array('id'=>'img_user_img','style'=>'width: 100%; border:2px solid #ddd;border-radius: 0%;'))}}
									</div>									
	                            </div>                                                  
	                        </div>                  
	                    </div>                            
	                </div>	                
	        	</div>	
        </div>
    </div>
</div>
@endsection

@section('style')
<link href="{{ asset('css/custom/col_md_custom.css') }}" rel="stylesheet"> 
<style type="text/css">
	.waiter-show{
		text-align: center;
	}
	.waiter-show .row > div{
		border-top: 1px solid rgba(0,0,0,.125);
		border-left: 1px solid rgba(0,0,0,.125);
		border-right: 1px solid rgba(0,0,0,.125);
	}
</style>	
@endsection