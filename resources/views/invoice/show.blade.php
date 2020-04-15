@extends('layouts.app')

@section('template')		          	
@endsection

@section('content')
<div class="flex-center position-ref full-height container">    
    <div class="container">
        <div class="row">

        	<div class="col-md-3">
                <div class="card card-menu-table">
                	<div class="card-header">{{ __('messages.InvoiceShow') }}</div>
                    <div class="card-body">
                        <div class="container invoice-show">
                            <div class="row">                                
								<div class="col-md-12">
									{{ __('messages.Number') }} <b>{{$invoice->number}}</b>
								</div>
								<div class="col-md-12">
									{{ __('messages.Description') }} <b>{{$invoice->description}}</b>
								</div>
								<div class="col-md-12">
									{{ __('form.Tax') }} <b>{{$invoice->tax}}</b>
								</div>
								<div class="col-md-12">
									<a class="dropdown-item" href="javascript: invoice_edit_submit('invoice-edit-form')">
                        				<i class="fas fa-cogs"></i>
                        				{{ __('options.edit') }}
                    				</a>
                    				{!! Form::open(array('id'=>'invoice-edit-form','route' =>['invoice.edit',$invoice->id] ,'method' =>'GET', 'onsubmit' =>'return validateForm()')) !!}
                        				{{ Form::hidden('id',$invoice->id) }}                            
                    				{!! Form::close() !!}
								</div>								
							</div>
						</div>
					</div>
                </div>
            </div>

            <div class="col-md-6">	        		
                <div class="card card-menu-table">
                    <div class="card-header">{{ __('messages.InvoiceDescription') }}</div>
                    <div class="card-body">
                        <div class="container invoice-table">
                            <div class="row">                                
								<div class="col-md-4">
									{{ __('messages.Provider') }}<br>
									<b>{{$invoice->provider()->first()->name}}</b>
								</div>
								<div class="col-md-4">
									{{ __('messages.Number') }}<br>
									<b>{{$invoice->provider()->first()->number}}</b>
								</div>
								<div class="col-md-4">
									{{ __('messages.Provider') }}<br>
									<b>{{$invoice->provider()->first()->description}}</b>
								</div>

								<div class="col-md-4">
									{{ __('messages.Adress') }}<br>
									<b>{{$invoice->provider()->first()->address}}</b>
								</div>
								<div class="col-md-4">
									{{ __('messages.E-Mail Address') }}<br>
									<b>{{$invoice->provider()->first()->email}}</b>
								</div>
								<div class="col-md-4">
									{{ __('messages.Phone') }}<br>
									<b>{{$invoice->provider()->first()->phone}}</b>
								</div>
								
                            </div>                                                  
                        </div>                  
                    </div>                            
                </div>
                <div class="card card-menu-table">
                    <div class="card-header">{{ __('messages.InvoiceProducts') }}</div>
                    <div class="card-body">
                        <div class="container services-table">
                        	<div class="row">
                        		@php($sum = 0)
                        		@foreach( $invoice->products()->get() as $key => $value)
                        			<div class="
                        				col-md-12 
                        				sub-row
                        				 @if($key%2) @else row-impar @endif">
                        				<div class="col-md-4">{{$value->volume}}</div>
                        				<div class="col-md-4">
                        					{{number_format($value->price)}}
                        				</div>
                        				<div class="col-md-4">
                        					{{$value->product()->first()->name}}
                        				</div>
                        			</div>
                        			@php($sum=$sum+$value->price)
                        		@endforeach
                        		<div class="col-md-12 total-row">
									Total:
									<b>{{number_format($sum)}}</b>
								</div>
                        	</div>
                        </div>
                    </div>
                </div>
        	</div>

        	<div class="col-md-3">	        		
                <div class="card card-menu-table">
                    <div class="card-header">{{ __('messages.InvoiceImages') }}</div>
                    <div class="card-body">
                        <div class="container services-table">
                            <div class="row">                                
								<div class="col-md-12">
									{{ Html::image('users/'.\Auth::user()->id.'/supports/'.$invoice->support,'Imagen no disponible',array('id'=>'img_suport_img','style'=>'width: 100%; border:2px solid #ddd;border-radius: 0%;'))}}
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
	<script type="text/javascript">
		function invoice_edit_submit(id){
            if($("#"+id+" input[name=id]").val() !== ""){
                $('#'+id)[0].submit();
                return true;
            }
            alert("{{ __('messages.InvoiceSelectNone') }}");
            return false;           
        }
	</script>
@endsection

@section('style')	
	<link href="{{ asset('css/custom/col_md_custom.css') }}" rel="stylesheet"> 
	<style type="text/css">
		.row-impar{
		    background-color: {{ json_decode(Auth::user()->store()->label,true)['table']['colorRow'] }};
		}
		.invoice-show{
			text-align: center;
		}
		.invoice-show .row > div{
			border-top: 1px solid rgba(0,0,0,.125);
			border-left: 1px solid rgba(0,0,0,.125);
			border-right: 1px solid rgba(0,0,0,.125);
		}
		.invoice-table{
			text-align: center;
		}

		.invoice-table > .row > div{
			margin-bottom: 10px;
		}

		.sub-row{
			display: flex;
		}
		
		.total-row{
			text-align: right;
    		margin-top: 15px;
		}
	</style>	
@endsection
