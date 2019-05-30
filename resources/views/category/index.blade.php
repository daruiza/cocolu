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
                    <div class="card-header">{{ __('form.CategoryIndex') }}</div>
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
                    <div class="card-header">{{ __('form.CategoryOptions') }}</div>
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
                    <div class="card-header">{{ __('form.indexCategories') }}</div>
                    <div class="card-body">
                    	<div class="container">
	                    	<div class="row">

                                <div class="col-md-12">
                                <div class="page-header">

                                    {!! Form::model($category,['enctype' => 'multipart/form-data','id'=>'form-category','route'=>['category.index'],'method'=>'GET']) !!}
                                        <div class="form-group form-search">                              
                                            {{Form::text('name',null,['class'=>'form-control','placeholder'=>__('messages.Name')])}}
                                        </div>
                                        <div class="form-group form-search">                              
                                            {{Form::text('description',null,['class'=>'form-control','placeholder'=>__('messages.Description')])}}
                                        </div>                                        
                                        <div class="form-group form-search">                              
                                            {!! Form::select('active',[__('form.Inactive'),__('form.Active')],null,['class'=>'form-control','placeholder'=>__('form.Status')]) !!}
                                        </div>
                                        
                                        <div class="form-group form-search">
                                            <button type="submit" class="btn btn-default">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </div>
                                    {{Form::close()}}
                                    
                                </div>                                
                                </div>

		                    	<div class="col-md-12 m-b-md table-container">
		                    		<div class="row table-header">
                                        <div class="col-md-3">{{ __('messages.Name') }}</div>
                                        <div class="col-md-4">{{ __('messages.Description') }}</div>
                                        <div class="col-md-2">{{ __('messages.Order') }}</div>
                                        <div class="col-md-3">{{ __('messages.Father') }}</div>
                                    </div>   
			                    	@foreach($categories as $key => $value)                                        
			                    		<div class="row object-category
                                         @if($key%2) @else row-impar @endif
                                         @if($value->active)  @else row-no-active @endif" >
                                            {{ Form::hidden('product-id', $value->id) }}
											<div class="col-md-3">{{$value->name}}</div>
                                            <div class="col-md-4">{{$value->description}}</div>
                                            <div class="col-md-2">{{$value->order}}</div>
                                            <div class="col-md-3">{{$value->categoryFather()}}</div>
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
		    background-color: {{ json_decode(Auth::user()->store()->label,true)['table']['colorRow'] }};
		}
        .object-category{
            border: 1px solid {{ json_decode(Auth::user()->store()->label,true)['table']['colorRow'] }};
            padding-top: 2px;
            padding-bottom: 2px;
            margin-top: 2px;
            margin-bottom: 2px;
        }
        .object-category:hover{
            cursor:pointer;
        }
        .selected-object{
            background-color: {{ json_decode(Auth::user()->store()->label,true)['table']['selectTable'] }} !important;
        }

        .table-header{
            border: 1px solid gainsboro;
            padding-top: 2px;
            padding-bottom: 2px;
            margin-top: 2px;
            margin-bottom: 2px;
            align-items: center;
            justify-content: center;
            font-weight: 600;
        }

        .row-no-active{
            background: {{ json_decode(Auth::user()->store()->label,true)['table']['colorInactive'] }};
            color: {{ json_decode(Auth::user()->store()->label,true)['table']['colorRow'] }};
        }
        .selected-object{
            color: #212529
        }

        form#form-category{
            display: flex;            
            align-items: center;
            justify-content: center;
        }

        .form-search{
            margin: 4px;
        }
        
	</style>	
@endsection
