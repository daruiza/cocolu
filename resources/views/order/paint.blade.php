<div class="form-group">
    @php($sum_service=0)
    
    @foreach($orders as $key => $value)

        <div class="row order-obj status-{{$value->status()->first()->name}} menu-status-{{$value->status()->first()->name}}" id="order-{{$value->id}}">
        
        {!! Form::hidden('order_store_id-order-'.$value->id, $value->service()->first()->table()->first()->store_id) !!}

        {!! Form::hidden('order_table_id-order-'.$value->id, $value->service()->first()->table()->first()->id) !!}

        {!! Form::hidden('order_service_id-order-'.$value->id, $value->service()->first()->id) !!}

        {!! Form::hidden('order_id', $value->id) !!}

        {!! Form::hidden('order_description', $value->description) !!}

        {!! Form::hidden('order_product', $value->orderProducts()) !!}        

        {!! Form::hidden('order_waiter', $value->waiter()->first()->user()->first()->name) !!}

        {!! Form::hidden('order_status', $value->status_id) !!}        
            <!--
            <div class="col-sm-12" style="text-align: center;">
                <span>
                {{$value->service()->first()->table()->first()->name}}
                </span>                                           
            </div>
            -->
            <div class="col-sm-7 status" style="text-align: center;">
                <span>
                    {{__('messages.'.$value->status()->first()->name)}}
                </span>
            </div>

            <div class="col-sm-5 serial" style="text-align: center;">
            	<span>
                    Serial: {{$value->serial}}
                </span>
            </div>

            <div class="col-sm-12" style="text-align: center;">
            	<span>
            	   SubTotal: ${{number_format($value->orderPrice())}}
            	</span>
            </div>

            <div class="col-sm-12 date" style="text-align: center;">
            	<span>
            	   {{$value->date}}
            	</span>
            </div>

            @if($value->status_id == 1 || $value->status_id == 1)
            	@php(
            		$sum_service = $sum_service + intval($value->orderPrice())
            	)            	
            @endif
        </div>
    @endforeach
     <div class="col-sm-12 date" style="text-align: center;">
     	<span>
     		Total: ${{number_format(intval($sum_service))}}
 	  	</span>
    	
    </div>

</div>