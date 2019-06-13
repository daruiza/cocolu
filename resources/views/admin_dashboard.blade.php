<div class="row">
    <div class="col-md-3 col-lateral-table">
        <div class="col-md-12">
        <div class="card card-menu-table">
            <div class="card-header">{{ __('messages.DashboardOptions') }}</div>
            <div class="card-body">
                <div class="container">
                    <div class="row">                                
                        <div class="col-md-12 ">
                            @if (!empty($data['options']))
                                @include('layouts.options_dashboard')                            
                            @endif                      
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
            <div class="card-header">{{ __('messages.DashboardImform') }}</div>
            <div class="card-body">
                <div class="container">
                    <div class="row row-info">
                        <div class="col-md-3 col-md-offset-0">
                            <span>{{ __('messages.ordersPaid')}}:</span> 
                            ${{number_format($orderpaid)}}
                        </div>
                        <div class="col-md-3 col-md-offset-0">
                            <span>{{ __('messages.ordersToPay')}}:</span> ${{number_format($orderstopay)}}
                        </div>
                        <div class="col-md-3 col-md-offset-0">
                            <span>{{ __('messages.Services')}}:</span> 
                            {{number_format($services)}}
                        </div>
                        <div class="col-md-3 col-md-offset-0">
                            <span>{{ __('messages.Orders')}}:</span> 
                            {{number_format($ordercount)}} [{{number_format($orderclosecount)}}]
                        </div>
                        <div class="col-md-3 col-md-offset-0">
                            <span>{{ __('messages.TotalExpenses')}}:</span> 
                            ${{number_format($totalexpense)}}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-md-offset-0">
                            <canvas id="pai-orders" width="80%" height="80%"></canvas>
                        </div>
                        <div class="col-md-6 col-md-offset-0">
                            <canvas id="pai-products" width="80%" height="80%"></canvas>
                        </div>
                        <div class="col-md-12 col-md-offset-0">
                            <canvas id="pai-ingredients" width="80%" height="80%"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> 
</div>

@if(auth()->user()->rol_id == 2)                    
    <neworder-component 
        :user="{{ auth()->user() }}">        
    </neworder-component>
@endif

@if(Session::has('data.clousures'))
    @include('clousure.showModal')
@endif

@section('subscript')
<script type="application/javascript" src="{{ asset('js/charts.min.js') }}"></script>
<script type="application/javascript" src="{{ asset('js/traits/helper_chart.js') }}"></script>
<script type="application/javascript">   

    @if(!empty($orders['data']))
        var labels = {!! json_encode($orders['labels']) !!};
        var data = {!! json_encode($orders['data']) !!};
        var backgroundColor = {!! json_encode($orders['backgroundColor']) !!};
        var borderColor = {!! json_encode($orders['borderColor']) !!};
        object_chart.paint_chart('pai-orders','doughnut','Title',labels,data,backgroundColor,borderColor);
    @endif

    @if(!empty($products['data']))
        var labels = {!! json_encode($products['labels']) !!};
        var data = {!! json_encode($products['data']) !!};
        object_chart.paint_chart_bar('pai-products','bar','{{__("messages.Products")}}',labels,data,backgroundColor,borderColor);
    @endif

    @if(!empty($ingredients['data']))
        var labels = {!! json_encode($ingredients['labels']) !!};
        var data = {!! json_encode($ingredients['data']) !!};
        object_chart.paint_chart_bar('pai-ingredients','bar','{{__("messages.Ingredients")}}',labels,data,backgroundColor,borderColor);
    @endif

    //Solo para informe de cierres
    @if(Session::has('data.clousures'))
        $('#modal_clousure_create').modal('toggle');
        $('.object-clousure').on( "click", function() {          
          $($(this).children()[0]).submit();
        });
    @endif
    
</script>
@endsection

@section('subtemplate')
<style type="text/css">
    
    .navbar-laravel{           
        background: none;
        position: relative;
        width: auto;        
    }
    .pb-4, .py-4 {
        padding-bottom: 1.5rem!important;
        padding-top: 1.5rem!important;
    }

    /*Solo para informe de Cierres*/
    @if(Session::has('data.clousures'))

        .table-container{
            text-align: center;
            margin-bottom: 15px;
        }

        .table-container .row{
            border-bottom: 1px solid gray;    
            border-right: 1px solid gray;    
            border-left: 1px solid gray;    
        }

        .table-container .row:nth-of-type(1){
            background-color: gray;
            color: white;
        }

        .table-container .row > div:nth-of-type(1),
        .table-container .row > div:nth-of-type(2),
        .table-container .row > div:nth-of-type(3){
            border-right: 1px gray solid;
        }    

        .table-container .row:nth-of-type(1)  div:nth-of-type(1),
        .table-container .row:nth-of-type(1)  div:nth-of-type(2),
        .table-container .row:nth-of-type(1)  div:nth-of-type(3){
            /*border-right: 1px white solid;*/
        }    

        .row-impar{
            background-color: {{ json_decode(Auth::user()->store()->label,true)['table']['colorRow'] }};
        }

        #modal_clousure_create .pagination{
            align-items: center;
            justify-content: center;
        }

        #modal_clousure_create .pagination .page-item a{
            color : grey;
        }

        #modal_clousure_create .pagination .page-item.active span{
            background-color: gray;
            border-color: gray;
        }

        .object-clousure:hover{
            cursor: pointer;
            background-color: {{ json_decode(Auth::user()->store()->label,true)['table']['selectTable'] }} !important;
        }

        .body-header > form{
            align-items: center;
            justify-content: center;
            margin-bottom: 15px;
        }

        .form-search{
            margin: 4px;
        }

    @endif    

    @media (max-width: 768px) {
        .col-lateral-table div:nth-of-type(1){
            padding-right: 0px;
            padding-left: 0px;
        }
    }
    
</style>
@endsection