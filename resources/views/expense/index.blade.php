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
                    <div class="container expenses-table">
                        <div class="row">								
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
        <div class="col-md-9">                  
            @include('layouts.alert')
            <div class="card">
                <div class="card-header">{{ __('messages.indexProduct') }}</div>
                <div class="card-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12 m-b-md table-container">
                                <div class="row">
                                    <div class="col-md-3">{{ __('messages.Name') }}</div>
                                    <div class="col-md-3">{{ __('messages.Description') }}</div>
                                    <div class="col-md-3">{{ __('messages.Value') }}</div>
                                    <div class="col-md-3">{{ __('messages.Clousure') }}</div>
                                </div>
                                @foreach($expenses as $key => $value)
                                <div class="row object-expense 
                                    @if($key%2) @else row-impar @endif">
                                    {{ Form::hidden('expense-id', $value->id) }}
                                    <div class="col-md-3">{{$value->name}}</div>
                                    <div class="col-md-3">{{$value->description}}</div>
                                    <div class="col-md-3">{{$value->value}}</div>
                                    <div class="col-md-3">
                                        <div>{{$value->clousure()->first()->name}}</div>
                                        <div>{{$value->clousure()->first()->date_open}}</div>
                                    </div>                                    
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
<script type="text/javascript" src="{{ asset('js/entity/expense.js') }}"></script>
<script type="text/javascript">
    expense.selectObject('object-expense','selected-object');
</script>
   
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
