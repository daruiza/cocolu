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
                <div class="card-header">{{ __('form.ProductEditStock') }}</div>
                <div class="card-body">
                    <div class="container products-table">
                        <div class="row">								
                        </div>                                                  
                    </div>                  
                </div>                            
            </div>
            </div>
            
        </div>

        <div class="col-md-9">            		
    		@include('layouts.alert')
    		<div class="card">
                <div class="card-header">{{ __('form.EditStockProduct') }}</div>
                <div class="card-body">
                	<div class="container">
                    	<div class="row">
                    		<div class="col-md-12">
                                <div class="page-header">
                                	{!! Form::model($product,['enctype' => 'multipart/form-data','id'=>'form-product','route'=>['product.savestock',$product->id],'method'=>'POST']) !!}
                                		{!!Form::hidden('product_id', $product->id)!!}
										{!!Form::hidden('store_id', Auth::user()->store()->id)!!}

										<div class="form-group row">
											{!! Form::label('name',__('messages.Name'),['class'=>'col-sm-4 col-form-label text-md-right', 'readonly' => 'true']) !!}
											<div class="col-md-8">
												@if($errors->has('name'))
													{!! Form::text('name',null, ['class'=>'form-control is-invalid']) !!}
													<span class="invalid-feedback">
										                <strong>{{ $errors->first('name') }}</strong>
										            </span>
												@else
													{!! Form::text('name',null, ['class'=>'form-control', 'readonly' => 'true']) !!}
												@endif	
											</div>
										</div>

										<div class="form-group row">
											{!! Form::label('volume',__('messages.Volume'),['class'=>'col-sm-4 col-form-label text-md-right']) !!}
											<div class="col-md-8">
												@if($errors->has('volume'))
													{!! Form::number('volume',null, ['class'=>'form-control is-invalid','readonly' => 'true']) !!}
													<span class="invalid-feedback">
										                <strong>{{ $errors->first('volume') }}</strong>
										            </span>
												@else
													{!! Form::number('volume',null, ['class'=>'form-control','readonly' => 'true']) !!}
												@endif	
											</div>
										</div>

										<div class="form-group row">
											{!! Form::label('description_change',__('messages.Description'),['class'=>'col-sm-4 col-form-label text-md-right']) !!}
											<div class="col-md-8">
												@if($errors->has('description_change'))
													{!! Form::textarea('description_change',null, ['class'=>'form-control is-invalid']) !!}
													<span class="invalid-feedback">
										                <strong>{{ $errors->first('description_change') }}</strong>
										            </span>
												@else
													{!! Form::textarea('description_change',null, ['class'=>'form-control','rows'=>'3']) !!}
												@endif	
											</div>	                    			
										</div>

										<div class="form-group row">
											{!! Form::label('volume_change',__('messages.Volume'),['class'=>'col-sm-4 col-form-label text-md-right']) !!}
											<div class="col-md-8">
												@if($errors->has('volume_change'))
													{!! Form::number('volume_change',null, ['class'=>'form-control is-invalid']) !!}
													<span class="invalid-feedback">
										                <strong>{{ $errors->first('volume_change') }}</strong>
										            </span>
												@else
													{!! Form::number('volume_change',null, ['class'=>'form-control','step'=>'0.5']) !!}
												@endif	
											</div>
										</div>

										

										<div class="form-group row mb-0">
										    <div class="col-md-8 offset-md-4">
										        <button type="submit" class="btn btn-primary">
										            {{ __('messages.Send') }}
										        </button>	                                
										    </div>
										</div>
                                	{{Form::close()}}
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

@section('script')
    <script type="text/javascript" src="{{ asset('js/entity/product.js') }}"></script>
    <script type="text/javascript">
    </script>
@endsection

@section('style')	
	<link href="{{ asset('css/custom/col_md_custom.css') }}" rel="stylesheet">     
	<style type="text/css">
	</style>
@endsection
