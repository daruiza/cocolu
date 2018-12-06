@extends('layouts.app')

@section('template')
    
@endsection

@section('content')

 <div class="container">
        <div class="row make-columns">
            <div class="col-xs-6 col-md-6 col-lg-6">
                <div class="card card-default">
                    <div class="card-body">1 - This is my card with some content!
                        <br><img src="//placehold.it/130x90"></div>
                </div>
            </div>
            <div class="col-xs-6 col-md-3 col-lg-3">
                <div class="card card-default">
                    <div class="card-body">2 - This is another card with even more text content!</div>
                </div>
            </div>
            <div class="col-xs-6 col-md-3 col-lg-3">
                <div class="card card-default">
                    <div class="card-body">3 - This is a card with just some text, stuff to say and some more blah filler fill content with even more text content...
                        <br> </div>
                </div>
            </div>
            <div class="col-xs-6 col-md-4 col-lg-4">
                <div class="card card-default">
                    <div class="card-body">4 - This is my card with some blah content aliquam in cursus ut, ullamcorper in tort..</div>
                </div>
            </div>
            <div class="col-xs-6 col-md-4 col-lg-4">
                <div class="card card-default">
                    <div class="card-body">5 - This is another card with even more content!</div>
                </div>
            </div>
            <div class="col-xs-6 col-md-6 col-lg-6">
                <div class="card card-default">
                    <div class="card-body">6 - This is a card with and image
                        <br><img src="//placehold.it/150x80"> </div>
                </div>
            </div>
            <div class="col-xs-6 col-md-3 col-lg-3">
                <div class="card card-default">
                    <div class="card-body">7 - Nullam sapien massa, aliquam in cursus ut, ullamcorper in tortor. Aliquam codeply mauris!</div>
                </div>
            </div>
            <div class="col-xs-6 col-md-3 col-lg-3">
                <div class="card card-default">
                    <div class="card-body">8 - This is a card with and image
                        <br><img src="//placehold.it/150x100"> </div>
                </div>
            </div>
            <div class="col-xs-6 col-md-4 col-lg-4">
                <div class="card card-default">
                    <div class="card-body">9 - This is another card with even more text content! Nullam sapien massa, aliquam in cursus ut, ullamcorper in tortor. Aliquam codeply mauris arcu, tristique a lobortis vitae, condimentum feugiat justo.</div>
                </div>
            </div>
            <div class="col-xs-6 col-md-4 col-lg-4">
                <div class="card card-default">
                    <div class="card-body">10 - Nullam sapien massa, aliquam in cursus ut, Yes. This is another card with even more text content!</div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content2')
<div class="container">
   <div class="flex-center position-ref full-height">
        <div class="col-md-12">
            <div class="content">
               <div class="row">

	        	<div class="col-md-4">
            		<div class="card">
	                    <div class="card-header">{{ __('messages.TableShow') }}</div>
	                    <div class="card-body">
	                    	<div class="container">
		                    	<div class="row">			                    	
			                    	<div class="col-md-12">
			                    		{{$table->name}}
			                    	</div>
			                    	<div class="col-md-12">
			                    		{{$table->description}}
			                    	</div>
			                    	<div class="col-md-12">
			                    		{{$table->icon}}
			                    	</div>
			                    	<div class="col-md-12">
			                    		{{$table->label}}
			                    	</div>
			                    </div>	                    			        		
	                    	</div>	        		
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