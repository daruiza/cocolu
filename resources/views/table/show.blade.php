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
							<ul class="list-group">	                    	
								<li class="list-group-item ">
									<div><i class="{{$table->icon}}">  </i> {{$table->name}}</div>
									<div>{{$table->description}}</div>										
								</li>								
									@foreach(json_decode($table->label)->options as $option)
										@if($option == "orderCreate")
											@if($table->tableServiceOpen()->count())
												<li class="list-group-item li-option" onclick="event.preventDefault(); document.getElementById('{{ $option }}').submit()";>
													{{ __('messages.'. $option) }} 	
												</li>
											@endif
										@else
											<li class="list-group-item li-option" onclick="event.preventDefault(); document.getElementById('{{ $option }}').submit()";>
													{{ __('messages.'. $option) }} 	
											</li>
										@endif
									@endforeach
								
								
								<form id="serviceCreate" action="{{ route('service.create',$table->id) }}" method="GET" style="display: none;">
									<input type="hidden" name="id" value="{{ $table->id }}">									
								</form>

								<form id="orderCreate" method="GET" action="http://localhost/backend/cocolu/public/order/create" accept-charset="UTF-8" id="table1">
                                    <input name="store-id" type="hidden" value="{{$table->store_id}}">
                                    <input name="table-id" type="hidden" value="{{$table->id}}">                          
                                </form>
							</ul>      		
	                    </div>	                    
	                </div>

                    

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