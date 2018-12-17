@extends('layouts.app')

@section('template')
    <link href="{{ asset('css/custom/options.css') }}" rel="stylesheet">    
@endsection

@section('content')
<div class="container">
   <div class="flex-center position-ref full-height">
        <div class="col-md-12">
            <div class="content">
               <div class="row">

	        	<div class="col-md-4">
            		<div class="card">
	                    <div class="card-header">{{ __('messages.TableShow') }}</div>
	                    <div class="card-body">
	                    			                    	
			                    	<li class="list-group-item ">
			                    		{{$table->name}}
			                    	</li>
			                    	<li class="list-group-item ">
			                    		{{$table->description}}
			                    	</li>
			                    	<li class="list-group-item ">
			                    		{{$table->icon}}
			                    	</li>		                    	

									@foreach(json_decode($table->label)->options as $option)
										<li class="list-group-item li-option" onclick="event.preventDefault(); document.getElementById('{{ $option }}').submit()";>
	                    					{{ __('messages.'. $option) }} 	
	                    				</li>
									@endforeach
									
									<form id="serviceCreate" action="{{ route('service.create', $table->id ) }}" method="GET" style="display: none;">                                
									</form>
			                           		
	                    </div>	                    
	                </div>

                    <form id="createService" action="{{ route('service.create') }}" method="GET" style="display: none;">                                
                    </form>

            	</div>           
            	<div class="col-md-8">
            		<div class="card">
	                    <div class="card-header">{{ __('messages.TableService') }}</div>
	                    <div class="card-body">
	                    	<div class="container">
		                    	<div class="row">			                    	
			                    	se muestran los servicios de hoy
			                    </div>	                    			        		
	                    	</div>	        		
	                    </div>	                    
	                </div>
            	</div>
            	<div class="col-md-4">
            		<div class="card">
	                    <div class="card-header">{{ __('messages.TableGraphic') }}</div>
	                    <div class="card-body">
	                    	<div class="container">
		                    	<div class="row">			                    	
			                    	grafico de crecimiento
			                    </div>	                    			        		
	                    	</div>	        		
	                    </div>	                    
	                </div>
            	</div>           	
            	<div class="col-md-4">
            		<div class="card">
	                    <div class="card-header">{{ __('messages.TableGraphic') }}</div>
	                    <div class="card-body">
	                    	<div class="container">
		                    	<div class="row">			                    	
			                    	grafico de crecimiento
			                    </div>	                    			        		
	                    	</div>	        		
	                    </div>	                    
	                </div>
            	</div>           	
            	<div class="col-md-4">
            		<div class="card">
	                    <div class="card-header">{{ __('messages.TableGraphic') }}</div>
	                    <div class="card-body">
	                    	<div class="container">
		                    	<div class="row">			                    	
			                    	grafico de crecimiento
			                    </div>	                    			        		
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
<style>

.row.make-columns {
        
        -moz-column-width: 19em;
        -webkit-column-width: 19em;
        -moz-column-gap: 1em;
        -webkit-column-gap:1em; 

    }

    .row.make-columns > div {
        display: inline-block;
        padding:  .5rem;
        width:  100%; 
    }

    
    .card {
        display: inline-block;
        height: 100%;
        width:  100%;
    }

	
</style>
@endsection