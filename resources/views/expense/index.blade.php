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
                    <div class="card-header">{{ __('messages.ExpenseIndex') }}</div>
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
                    <div class="card-header">{{ __('messages.ExpenseOptions') }}</div>
                    <div class="card-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    @include('layouts.options_page',['model'=>'Expenses'])
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
   
@endsection

@section('style')
<link href="{{ asset('css/custom/col_md_custom.css') }}" rel="stylesheet"> 
<style type="text/css">
	.table-container{
        text-align: center;
    }

	.row-impar{
	    background-color: {{ json_decode(Auth::user()->store()->label,true)['table']['colorRow'] }};
	}

    .object-product{
        border: 1px solid {{ json_decode(Auth::user()->store()->label,true)['table']['colorRow'] }};
        padding-top: 2px;
        padding-bottom: 2px;
        margin-top: 2px;
        margin-bottom: 2px;
    }

    .object-product:hover{
        cursor:pointer;
    }

    .selected-object{
        background-color: {{ json_decode(Auth::user()->store()->label,true)['table']['selectTable'] }} !important;
    }

    .critical_volume{
        border: 2px solid red;
        background-color: #e47b7b;
    }

</style>
	
@endsection
