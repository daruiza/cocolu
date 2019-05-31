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
                <div class="card-header">{{ __('form.ExpenseIndex') }}</div>
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
                <div class="card-header">{{ __('form.ExpenseOptions') }}</div>
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
                <div class="card-header">{{ __('form.indexExpense') }}</div>
                <div class="card-body">
                    <div class="container">
                        <div class="row">

                            <div class="col-md-12">
                                <div class="page-header">

                                    {!! Form::model($expense,['enctype' => 'multipart/form-data','id'=>'form-expense','route'=>['expense.index'],'method'=>'GET']) !!}
                                        <div class="form-group form-search">                              
                                            {{Form::text('name',null,['class'=>'form-control','placeholder'=>__('messages.Name')])}}
                                        </div>
                                        <div class="form-group form-search">                              
                                            {{Form::text('description',null,['class'=>'form-control','placeholder'=>__('messages.Description')])}}
                                        </div>                                        
                                        <div class="form-group form-search">
                                            {{Form::text('clousure',null,['class'=>'form-control','placeholder'=>__('messages.Clousure')])}}
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
    function expense_show_submit(id){
        if($("#"+id+" input[name=id]").val() !== ""){
            $('#'+id)[0].submit();
            return true;
        }        
        $('#modal-alert .content-text').html("{{ __('messages.ExpenseSelectNone') }}");
        $("#modal-alert").modal('show');
        return false;           
    }

    function expense_edit_submit (id){
        if($("#"+id+" input[name=id]").val() !== ""){
            $('#'+id)[0].submit();
            return true;
        }
        $('#modal-alert .content-text').html("{{ __('messages.ExpenseSelectNone') }}");
        $("#modal-alert").modal('show');
        return false;           
    }

    function expense_destroy_submit(id){          
        if($("#"+id+" input[name=id]").val() !== ""){
            $('#modal-confirm .submit').attr('form',id);
            $('#modal-confirm .content-text').html("{{ __('messages.ConfirmOption') }}");
            $('#modal-confirm').modal('show');              
            return false;               
        }
        $('#modal-alert .content-text').html("{{ __('messages.ExpenseSelectNone') }}");
        $("#modal-alert").modal('show');
        return false;

    }
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

    .object-expense{
        border: 1px solid {{ json_decode(Auth::user()->store()->label,true)['table']['colorRow'] }};
        padding-top: 2px;
        padding-bottom: 2px;
        margin-top: 2px;
        margin-bottom: 2px;
    }

    .object-expense:hover{
        cursor:pointer;
    }

    .selected-object{
        background-color: {{ json_decode(Auth::user()->store()->label,true)['table']['selectTable'] }} !important;
    }

    .critical_volume{
        border: 2px solid red;
        background-color: #e47b7b;
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

    form#form-expense{
        display: flex;            
        align-items: center;
        justify-content: center;
    }

    .form-search{
        margin: 4px;
    }

</style>
	
@endsection
