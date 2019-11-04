@extends('layouts.app')

@section('template')		          	
@endsection

@section('content')
<div class="flex-center position-ref full-height container">    
    <div class="container">
        <div class="row">

        	<div class="col-md-3">
                <div class="card card-menu-table">
                	<div class="card-header">{{ __('messages.CategoryShow') }}</div>
                    <div class="card-body">
                        <div class="container product-show">
                            <div class="row">                                
								<div class="col-md-12">
									{{ __('messages.Name') }} <b>{{$category->name}}</b>
								</div>
								<div class="col-md-12">
									<a class="dropdown-item" href="javascript: category_edit_submit('category-edit-form')">
                        				<i class="fas fa-cogs"></i>
                        				{{ __('options.edit') }}
                    				</a>
                    				{!! Form::open(array('id'=>'category-edit-form','route' =>['category.edit',$category->id] ,'method' =>'GET', 'onsubmit' =>'return validateForm()')) !!}
                        				{{ Form::hidden('id',$category->id) }}                            
                    				{!! Form::close() !!}
								</div>								
							</div>
						</div>
					</div>
                </div>
            </div>

            <div class="col-md-9">	        		
                <div class="card card-menu-table">
                    <div class="card-header">{{ __('messages.CategryDescription') }}</div>
                    <div class="card-body">
                        <div class="container services-table">
                            <div class="row">                                
								<div class="col-md-12">historial de category</div>
								<div class="col-md-12">veces vendido</div>
								<div class="col-md-12">margen de ganancia</div>
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
		function category_edit_submit(id){
            if($("#"+id+" input[name=id]").val() !== ""){
                $('#'+id)[0].submit();
                return true;
            }
            alert("{{ __('messages.ProductSelectNone') }}");
            return false;           
        }
	</script>
@endsection

@section('style')	
	<link href="{{ asset('css/custom/col_md_custom.css') }}" rel="stylesheet"> 
	<style type="text/css">
		
	</style>	
@endsection