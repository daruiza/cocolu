@extends('layouts.app')

@section('template')		          	
@endsection

@section('content')	
	<div class="flex-center position-ref full-height container">    
	    <div class="container">
	        <div class="row">

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
	                    	<div class="container">
		                    	<div class="row">
			                    	<div id="containment-wrapper" class="col-md-12">
			                    		
				                    	@foreach($data['tables'] as $key => $value)
				                    		<div class="ui-widget-content draggable col-md-3 obstacle ">
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
        </div>
    </div>
    
@endsection


@section('script')
	

	<script type="text/javascript" src="{{ url('js/jquery.ui.core.js') }}"></script>
	<script type="text/javascript" src="{{ url('js/jquery.ui.widget.js')}}"></script>
    <script type="text/javascript" src="{{ url('js/jquery.ui.mouse.js')}}"></script>
    <script type="text/javascript" src="{{ url('js/jquery.ui.draggable.js')}}"></script>
	<script type="text/javascript" src="{{ url('js/jquery-collision.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('js/jquery-ui-draggable-collision.min.js') }}"></script>    

	<script type="text/javascript">
		
		if($( window ).width() > 768){		
			$( ".draggable" ).draggable({ 
				containment: "#containment-wrapper", 
				scroll: false ,
				obstacle: ".obstacle",
	    		preventCollision: true
	    	});

	    	$(".draggable").hover(function() {
			    $(this).removeClass("obstacle");
			}, function() {
			    $(this).addClass("obstacle");
			});

			$("#containment-wrapper").height($("#containment-wrapper").height()+35);
		} 
			
    	
	</script>
@endsection

@section('style')
	<style type="text/css">
		.card-body{
			/*padding: 0.50rem;*/
		}
		#containment-wrapper{
			/*padding: 0px;*/
			display: flex;
			flex-wrap: wrap;
		}
		.draggable { 
			/*width: 150px;*/
			height: 150px; 
			padding: 0.5em; 
			border: solid 1px gainsboro;			
		}

		@media (min-width: 768px) {
			.col-md-3{
				flex: 0 0 24%;
    			max-width: 24%; 
			}	
		}
		

	</style>
@endsection