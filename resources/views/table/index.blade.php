@extends('layouts.app')

@section('template')
  	
@endsection

@section('content')	
	<div class="flex-center position-ref full-height container">    
	    <div class="container">
	        <div class="row row-edit-perfil">

	        	<div class="col-md-4 ">
            		<div class="card">
	                    <div class="card-header">{{ __('messages.TableService') }}</div>
	                    <div class="card-body">
	                    	<div class="col-md-8">
		                    	
		                    </div>
	                    	<div class="col-md-4">        			
			        			
			        		</div>			        		
	                    </div>
	                    
	                </div>
            	</div>

            	<div class="col-md-8">            		
            		@include('layouts.alert')
            		<div class="card">
	                    <div class="card-header">{{ __('messages.indexTable') }}</div>
	                    <div class="card-body">
	                    	<div id="containment-wrapper" class="col-md-12">		
		                    	@foreach($data['tables'] as $key => $value)
		                    		<div class="ui-widget-content draggable butNotHere">
									  	<p>{{$value->name}}</p>
									</div>
		                    	@endforeach
		                    </div>	                    			        		
	                    </div>
	                    
	                </div>
        		</div>
        	</div>
        </div>
    </div>
    
@endsection


@section('script')
	<script type="text/javascript"> 		
		$( ".draggable" ).draggable({ 
			containment: "#containment-wrapper", 
			scroll: false ,
			obstacle: ".butNotHere",
    		preventCollision: true
    	});		
	</script>
@endsection

@section('style')
	<style type="text/css">		
		.draggable { width: 150px; height: 150px; padding: 0.5em; border: solid 1px gainsboro;};
	</style>
@endsection