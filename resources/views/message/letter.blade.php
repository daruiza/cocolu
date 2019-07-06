@extends('layouts.app_request')
@section('template')
    <link href="{{ asset('css/custom/welcome.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom/col_md_custom.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom/perfil.css') }}" rel="stylesheet">    
@endsection
@section('content')
<div class="container">
   <div class="flex-center position-ref full-height">
        <div class="col-md-12">
            <div class="content">
            	<div class="row">
            		<div class="col-md-9">
            			@include('layouts.alert')
            			<div class="card">
            				<div class="card-header">{{ __('options.letter') }}</div>
            				<div class="card-body">
            				</div>
            			</div>
            			
            		</div>
            	</div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('style')
	<style type="text/css">
		body{
	        background-color: {{ json_decode($store->label,true)['table']['colorbody'] }};
	    }

	    @media (max-width: 768px) {

	    	#navbarSupportedContent .navbar-nav.ml-auto li i{
	    		margin-right: 10px;
	    	}
	    	#navbarSupportedContent ul{
	    		padding-top: 9px;
	    	}
	    	#navbarSupportedContent .navbar-nav.ml-auto li{
	    		padding: 8px;
	    		margin: 2px;
	    		background-color: rgba(0,0,0,.03);			
				border-color: black;
				border: 1px solid rgba(0,0,0,.125);
				box-shadow: 3px 4px 4px rgba(0,0,0,.125);
				border-radius: calc(.25rem - 1px) calc(.25rem - 1px) 0 0;
	    	}

	    	.card-body {		    
			    /*
			    padding-left: 0.25rem;
			    padding-right:  0.25rem;
			    */
			}

	    	.btn-primary{
	    		width: 100%;
			    color: #212529;
			    background-color: rgba(0,0,0,.03);
			    border-color: rgba(0,0,0,.125);
			}
	    }
	</style>
@endsection

@section('script')    
    <script type="application/javascript">
        
    </script>    
@endsection