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
                <div class="card-header">{{ __('messages.InvoiceIndex') }}</div>
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
                <div class="card-header">{{ __('messages.InvoiceOptions') }}</div>
                <div class="card-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                @include('layouts.options_page',['model'=>'Invoices'])
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
                                    <div class="col-md-3">{{ __('messages.Number') }}</div>
                                    <div class="col-md-3">{{ __('messages.Value') }}</div>
                                    <div class="col-md-3">{{ __('messages.Provider') }}</div>
                                    <div class="col-md-3">{{ __('messages.Clousure') }}</div>
                                </div>
                                @foreach($invoices as $key => $value)                                
                                <div class="row object-invoice 
                                    @if($key%2) @else row-impar @endif">
                                    {{ Form::hidden('expense-id', $value->id) }}
                                    <div class="col-md-3">{{$value->number}}</div>
                                    <div class="col-md-3">$ {{number_format($value->invoicePrice())}}</div>
                                    <div class="col-md-3">{{$value->provider()->first()->name}}</div>
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
<script type="text/javascript" src="{{ asset('js/entity/invoice.js') }}"></script>
<script type="text/javascript">
	invoice.selectObject('object-invoice','selected-object');
	function invoice_show_submit(id){
        if($("#"+id+" input[name=id]").val() !== ""){
            $('#'+id)[0].submit();
            return true;
        }
        alert("{{ __('messages.CategorySelectNone') }}");
        return false;           
    }

    function invoice_edit_submit (id){
        if($("#"+id+" input[name=id]").val() !== ""){
            $('#'+id)[0].submit();
            return true;
        }
        alert("{{ __('messages.CategorySelectNone') }}");
        return false;           
    }

    function invoice_destroy_submit(id){          
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
	.table-container{
        text-align: center;
    }

	.row-impar{
	    background-color: {{ json_decode(Auth::user()->store()->label,true)['table']['colorRow'] }};
	}

    .object-invoice{
        border: 1px solid {{ json_decode(Auth::user()->store()->label,true)['table']['colorRow'] }};
        padding-top: 2px;
        padding-bottom: 2px;
        margin-top: 2px;
        margin-bottom: 2px;
    }

    .object-invoice:hover{
        cursor:pointer;
    }

    .selected-object{
        background-color: {{ json_decode(Auth::user()->store()->label,true)['table']['selectTable'] }} !important;
    }

</style>
@endsection