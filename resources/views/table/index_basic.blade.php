<div class="flex-center position-ref full-height container">    
    <div class="container">
        <div class="row">
        	
        	<div class="col-md-3 col-lateral-table">
                <div class="col-md-12">
                <div class="card card-menu-table">
                    <div class="card-header">{{ __('messages.TableService') }}</div>
                    <div class="card-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                   Servicios por mesa seleccionada
                                </div>
                            </div>                                                  
                        </div>                  
                    </div>                            
                </div>
                </div>
                <div class="col-md-12">
                <div class="card card-menu-table">
                    <div class="card-header">{{ __('messages.TableOptions') }}</div>
                    <div class="card-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    @include('layouts.options_page',['model'=>'Tables'])
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
                    <div class="card-header">{{ __('messages.indexTable') }}</div>
                    <div class="card-body">
                    	<div class="container">
	                    	<div class="row">
		                    	<div id="containment-wrapper" class="col-md-12">
		                    		
			                    	@foreach($data['tables'] as $key => $value)
                                        {{--dd(json_decode($value->label)->position[0])--}}
			                    		<div class="ui-widget-content draggable col-md-3 obstacle object-table" style="
                                            top: {{json_decode($value->label)->position[0]}};
                                            right: {{json_decode($value->label)->position[1]}} ;
                                            bottom: {{json_decode($value->label)->position[2]}};
                                            left: {{json_decode($value->label)->position[3]}}; ">

                                            {{ Form::hidden('table-id', $value->id) }}
										  	<p><i class="{{$value->icon}}"> </i>{{$value->name}}</p>
                                            
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