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
                    <div class="row">
                        <div class="col-md-6 col-md-offset-0">
                            <canvas id="pai-orders" width="400" height="400"></canvas>
                        </div>
                        <div class="col-md-6 col-md-offset-0">
                            <canvas id="pai-products" width="400" height="400"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> 
</div>

@section('subscript')
<script src="{{ asset('js/charts.min.js') }}"></script>
<script src="{{ asset('js/traits/helper_chart.js') }}"></script>
<script type="text/javascript">

    var labels = {!! json_encode($orders['labels']) !!};
    var data = {!! json_encode($orders['data']) !!};
    var backgroundColor = {!! json_encode($orders['backgroundColor']) !!};
    var borderColor = {!! json_encode($orders['backgroundColor']) !!};

    object_chart.paint_chart('pai-orders','doughnut','Title',labels,data,backgroundColor,borderColor);
    
</script>
@endsection