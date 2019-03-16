<div class="flex-center position-ref full-height container">    
    <div class="container">
        <div class="row">
        	
        	<div class="col-md-3 col-lateral-table">
                <div class="col-md-12">
                <div class="card card-menu-table">
                    <div class="card-header">{{ __('messages.TableService') }}</div>
                    <div class="card-body">
                        <div class="container services-table">
                            <div class="row">                                
								<div class="col-md-12 table"></div>								
								<div class="col-md-12 orders_menu"></div>
								<div class="col-md-12 new-orders"></div>
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
		                    		
			                    	@foreach($tables as $key => $value)                                     
			                    		<div class="ui-widget-content draggable col-md-3 obstacle unselectable 
                                        @if($value->tableServiceOpen()->count()) service-open-table @endif 
                                        @if($value->tableOrderStatusOneOpen()->count()) status-OrderNew @endif" style="
                                            top: {{json_decode($value->label)->position[0]}};
                                            right: {{json_decode($value->label)->position[1]}} ;
                                            bottom: {{json_decode($value->label)->position[2]}};
                                            left: {{json_decode($value->label)->position[3]}}; ">

                                            
                                            <div class="object-table">
                                                
                                                {{ Form::hidden('table-id', $value->id) }}
    										  	<p>
                                                    <i class="{{$value->icon}}"> </i>
                                                    {{$value->name}}        
                                                </p>

                                                <!-- si la mesa tiene ordenes es etado one-->
                                                @if($value->tableOrderStatusOneOpen()->count())
                                                    <a class="a-brange" href="#">
                                                        <span class="badge">
                                                            {{$value->tableOrderStatusOneOpen()->count()}}
                                                        </span>
                                                    </a>
                                                @endif
                                                				
    											@if($value->tableServiceOpen()->count())														
    												{!!Form::hidden('service-id', $value->tableServiceOpen()->first()->id)!!}
    												<div><i class="fas fa-clipboard"></i> {{ __('messages.OpenService') }}</div>
    												<div>{{$value->tableServiceOpen()->first()->date}}</div>
    												<div>Total a Pagar</div>
    												<div>Último Mesero</div>                                                    
    											@endif
                                            </div>
                                            @if($value->tableServiceOpen()->count())
                                            <div class="order_select_conteiner">
                                                <a class="dropdown-item" href="javascript: order_create_submit('table{{$value->id}}')">
                                                    <i class="fas fa-clipboard"></i>
                                                    <span class="span-order">{{ __('messages.NewOrder') }}</span>
                                                </a>
                                                {!! Form::open(array('id'=>'table'.$value->id,'route'=>'order.create','method' =>'GET')) !!}
                                                    {{ Form::hidden('store-id',Auth::user()->store()->id) }}
                                                    {{ Form::hidden('table-id', $value->id) }}                          
                                                {!! Form::close() !!}
                                            </div>
                                            @endif
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

{!! Form::hidden('mesage_state', __('messages.state') ) !!}
{!! Form::hidden('mesage_OrderNew', __('messages.OrderNew') ) !!}
{!! Form::hidden('mesage_OrderOK', __('messages.OrderOK') ) !!}
{!! Form::hidden('mesage_producs', __('messages.Products') ) !!}
{!! Form::hidden('mesage_ingredients', __('messages.Ingredients') ) !!}
{!! Form::hidden('mesage_groups', __('messages.Groups') ) !!}