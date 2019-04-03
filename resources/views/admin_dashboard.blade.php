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

    var labels = ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'];
    var data = [12, 19, 3, 5, 2, 3];
    var backgroundColor = ['rgba(255, 99, 132, 0.2)','rgba(54, 162, 235, 0.2)','rgba(255, 206, 86, 0.2)','rgba(75, 192, 192, 0.2)','rgba(153, 102, 255, 0.2)','rgba(255, 159, 64, 0.2)'];
    var borderColor = ['rgba(255, 99, 132, 1)','rgba(54, 162, 235, 1)','rgba(255, 206, 86, 1)','rgba(75, 192, 192, 1)','rgba(153, 102, 255, 1)','rgba(255, 159, 64, 1)'];

    object_chart.paint_chart('pai-orders','doughnut','Title',labels,data,backgroundColor,borderColor);
    
</script>
@endsection