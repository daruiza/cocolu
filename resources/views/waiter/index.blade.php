@extends('layouts.app')

@section('template')		          	
@endsection

@section('content')
	<div class="flex-center position-ref full-height container">    
    <div class="container">
        <div class="row">
        	
        	<div class="col-md-3 col-lateral-table">
                <div class="col-md-12">
                <div class="card card-menu-table">
                    <div class="card-header">{{ __('messages.WaiterIndex') }}</div>
                    <div class="card-body">
                        <div class="container services-table">
                            <div class="row">                                
								<div class="col-md-12 table"></div>
								<div class="col-md-12 bartender"></div>
								<div class="col-md-12 orders"></div>
								<div class="col-md-12 new-orders"></div>
                            </div>                                                  
                        </div>                  
                    </div>                            
                </div>
                </div>
                <div class="col-md-12">
                <div class="card card-menu-table">
                    <div class="card-header">{{ __('messages.WaiterOptions') }}</div>
                    <div class="card-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    @include('layouts.options_page',['model'=>'Waiters'])									
                                </div>
                            </div>                                                  
                        </div>                  
                    </div>                            
                </div>
                </div>
            </div>   

        	<div class="col-md-9">            		
        		@include('layouts.alert')
        		<div class="card">
                    <div class="card-header">{{ __('messages.indexWaiter') }}</div>
                    <div class="card-body">
                    	<div class="container">
	                    	<div class="row">
		                    	<div class="col-md-12 m-b-md table-container">
		                    		
			                    	@foreach($waiters as $key => $value)                                        
			                    		<div class="row object-waiter @if($key%2) @else row-impar @endif" >
											<div class="col-md-3">{{$value->user()->get()->first()->name}}</div>
											<div class="col-md-3">{{$value->user()->get()->first()->surname}}</div>
											<div class="col-md-4">{{$value->user()->get()->first()->email}}</div>
											<div class="col-md-2">{{$value->user()->get()->first()->phone}}</div>											
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
    <script type="text/javascript" src="{{ asset('js/entity/table.js') }}"></script>
    <script type="text/javascript">
        waiter.selectObject('object-waiter','selected-object');
    </script>   
@endsection

@section('style')	
	<link href="{{ asset('css/custom/col_md_custom.css') }}" rel="stylesheet"> 
	<style type="text/css">
		.row-impar{
		    background-color: {{ json_decode(Auth::user()->store()->label,true)['colorRow'] }} !important;
		}
        .selected-object{
            background-color: {{ json_decode(Auth::user()->store()->label,true)['selectTable'] }} !important;
        }
	</style>	
@endsection
