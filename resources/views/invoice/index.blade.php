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
                <div class="card-header">{{ __('form.InvoiceIndex') }}</div>
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
                <div class="card-header">{{ __('form.InvoiceOptions') }}</div>
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
                <div class="card-header">{{ __('form.indexInvoice') }}</div>
                <div class="card-body">
                    <div class="container">
                        <div class="row">

                            
                            <div class="col-md-12">
                                <div class="page-header">

                                    {!! Form::model($invoice,['enctype' => 'multipart/form-data','id'=>'form-invoice','route'=>['invoice.index'],'method'=>'GET']) !!}
                                        <div class="form-group form-search">                              
                                            {{Form::text('number',null,['class'=>'form-control','placeholder'=>__('messages.Number')])}}
                                        </div>

                                        <div class="form-group form-search">                              
                                            {{Form::text('date',null,['class'=>'form-control','placeholder'=>__('form.Date')])}}
                                        </div>

                                        <div class="form-group form-search">                              
                                            {{Form::text('provider',null,['class'=>'form-control','placeholder'=>__('messages.Provider')])}}
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

                                    {!! Form::select('providers',Auth::user()->store()->first()->allProvider(),null,['id'=>'providers','class'=>'form-control','style'=>'display:none']) !!}
                                    
                                </div>
                                
                            </div>
                            
                            <div class="col-md-12 m-b-md table-container">                                
                                <div class="row table-header">
                                    <div class="col-md-3">{{ __('messages.Number') }}</div>
                                    <div class="col-md-3">{{ __('messages.Value') }}</div>
                                    <div class="col-md-3">{{ __('messages.Provider') }}</div>
                                    <div class="col-md-3">{{ __('messages.Clousure') }}</div>
                                </div>
                                @foreach($invoices as $key => $value)
                                <div class="row object-invoice 
                                    @if($key%2) @else row-impar @endif">
                                    {{ Form::hidden('expense-id', $value->id) }}
                                    <div class="col-md-3">
                                        <div>{{$value->number}}</div>
                                        <div>{{$value->created_at}}</div>
                                    </div>
                                    <div class="col-md-3">$ {{number_format($value->invoicePrice())}}</div>
                                    <div class="col-md-3">{{$value->provider()->first()->name}}</div>
                                    <div class="col-md-3">
                                        <div>{{$value->clousure()->first()->name}}</div>
                                        <div>{{$value->clousure()->first()->date_open}}</div>
                                    </div>                                    
                                </div>      
                                @endforeach                                       
                            </div>
                            {{ $invoices->appends([
                                'number'=>$invoice->number,
                                'date'=>$invoice->date,
                                'provider'=>$invoice->provider,
                                'clousure'=>$invoice->clousure
                                ])
                                ->links() }}                           
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
<script type="text/javascript" src="{{ asset('js/jquery-ui.min.datepiker.js') }}"></script>
<script type="text/javascript">
	invoice.selectObject('object-invoice','selected-object');
	function invoice_show_submit(id){
        if($("#"+id+" input[name=id]").val() !== ""){
            $('#'+id)[0].submit();
            return true;
        }        
        $('#modal-alert .content-text').html("{{ __('messages.InvoiceSelectNone') }}");
        $("#modal-alert").modal('show');
        return false;           
    }

    function invoice_edit_submit (id){
        if($("#"+id+" input[name=id]").val() !== ""){
            $('#'+id)[0].submit();
            return true;
        }
        $('#modal-alert .content-text').html("{{ __('messages.InvoiceSelectNone') }}");
        $("#modal-alert").modal('show');
        return false;           
    }

    function invoice_destroy_submit(id){

        if($("#"+id+" input[name=id]").val() !== ""){
            $('#modal-confirm .submit').attr('form',id);
            $('#modal-confirm .content-text').html("{{ __('messages.ConfirmOption') }}");
            $('#modal-confirm').modal('show');              
            return false;               
        }
        $('#modal-alert .content-text').html("{{ __('messages.InvoiceSelectNone') }}");
        $("#modal-alert").modal('show');
        return false;        
    }

    var providers = document.getElementById("providers");
    for(var i=0;i<providers.childElementCount;i++){
        invoice.datos_providers.push(providers.options[i].innerHTML);
    }       
    $( "input[name='provider']" ).autocomplete({
          source: invoice.datos_providers
    });

    $( "input[name='date']" ).datepicker({ dateFormat: 'yy-mm-dd' } );
    $( "input[name='clousure']" ).datepicker({ dateFormat: 'yy-mm-dd' } );


</script>
@endsection

@section('style')
<link href="{{ asset('css/custom/col_md_custom.css') }}" rel="stylesheet">
<link href="{{ asset('css/jquery-ui.min.datepiker.css') }}" rel="stylesheet"> 
<link href="{{ asset('css/jquery-ui.min.autocomplete.css') }}" rel="stylesheet"> 
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

    .form-search{
        margin: 4px;
    }

    .page-header{
        margin: 10px;   
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

    @media (min-width: 768px) {
        form#form-invoice{
            display: flex;            
            align-items: center;
            justify-content: center;
        }
    }

</style>
@endsection