<html lang="{{ app()->getLocale() }}">
	<head>
		<meta charset="utf-8">
    	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">

    	<!-- CSRF Token -->
    	<meta name="csrf-token" content="{{ csrf_token() }}">
		
		<title>{{ $store->name }}</title>
		<!--
		<link href="{{ asset('css/app.css') }}" rel="stylesheet">    
		-->
		
	</head>
  	<body style="background-color: transparent;">
  		<div id="app">
  			<div class="container">
			   <div class="flex-center position-ref full-height">
			        <div class="col-md-12">
			        	<div class="content">
			               <div class="row">
			               		
			               		<div class="col-md-12" style="text-align:center">
			               			<p>
			               				<h2> {{ __('messages.CodeQrTable') }}{{$table->name}} </h2>
			               			</p>
			               		</div>	
					        	<div class="col-md-6" style="text-align:center">
					        		<h4> {{ __('messages.CodeQrRequest') }} </h4>
				        			<img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(300)->generate(route('message.request',[$store->id,$table->id])))!!} ">
					        	</div>
					        	<div class="col-md-6" style="text-align:center">
					        		<h4> {{ __('messages.letter') }} </h4>				        		
				        			<img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(300)->generate(route('message.letter',[$store->id])))!!} ">
					        	</div>
				        	</div>
				    	</div>
			        </div>
			    </div>
			</div>
  		</div>
  	</body>
</html>
 
