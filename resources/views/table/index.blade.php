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
	                    	<div class="col-md-8">
		                    	
		                    </div>
	                    	<div class="col-md-4">        			
			        			
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
		
	</script>
@endsection

@section('style')
	<style type="text/css">		
		
	</style>
@endsection