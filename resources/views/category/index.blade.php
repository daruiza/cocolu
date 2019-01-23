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
                    <div class="card-header">{{ __('messages.CategoryIndex') }}</div>
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
                    <div class="card-header">{{ __('messages.CategoryOptions') }}</div>
                    <div class="card-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    @include('layouts.options_page',['model'=>'Categories'])
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
                    <div class="card-header">{{ __('messages.indexCategories') }}</div>
                    <div class="card-body">
                    	<div class="container">
	                    	<div class="row">
		                    	<div class="col-md-12 m-b-md table-container">
		                    		
			                    	@foreach($categories as $key => $value)                                        
			                    		<div class="row object-category @if($key%2) @else row-impar @endif" >
                                            {{ Form::hidden('product-id', $value->id) }}
											<div class="col-md-3">{{$value->name}}</div>
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
    <script type="text/javascript" src="{{ asset('js/entity/category.js') }}"></script>
    <script type="text/javascript">
        category.selectObject('object-category','selected-object');

        function category_show_submit(id){
            if($("#"+id+" input[name=id]").val() !== ""){
                $('#'+id)[0].submit();
                return true;
            }
            alert("{{ __('messages.CategorySelectNone') }}");
            return false;           
        }

        function category_edit_submit(id){
            if($("#"+id+" input[name=id]").val() !== ""){
                $('#'+id)[0].submit();
                return true;
            }
            alert("{{ __('messages.CategorySelectNone') }}");
            return false;           
        }

        function category_destroy_submit(id){          
            if(confirm("{{ __('messages.CategoryConfirmDestroy') }}")){
                if($("#"+id+" input[name=id]").val() !== ""){
                $('#'+id)[0].submit();
                    return true;
                }
                alert("{{ __('messages.CategorySelectNone') }}");
                return false;
            }
            return false;
        }
        
    </script>   
@endsection

@section('style')	
	<link href="{{ asset('css/custom/col_md_custom.css') }}" rel="stylesheet"> 
	<style type="text/css">
		.row-impar{
		    background-color: {{ json_decode(Auth::user()->store()->label,true)['colorRow'] }};
		}
        .object-category{
            border: 1px solid {{ json_decode(Auth::user()->store()->label,true)['colorRow'] }};
            padding-top: 2px;
            padding-bottom: 2px;
            margin-top: 2px;
            margin-bottom: 2px;
        }
        .object-category:hover{
            cursor:pointer;
        }
        .selected-object{
            background-color: {{ json_decode(Auth::user()->store()->label,true)['selectTable'] }} !important;
        }
	</style>	
@endsection
