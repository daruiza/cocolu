@extends('layouts.app')

@section('template')
	<link href="{{ asset('css/custom/perfil.css') }}" rel="stylesheet">    
@endsection

@section('content')
	<div class="flex-center position-ref full-height container">    
	    <div class="container">
	        <div class="row row-perfil">
            	
            	<div class="col-md-4 ">
            		<div class="card">
	                    <div class="card-header">{{ __('messages.Options') }}</div>
	                    @if (!empty($data['options']) )
	                    	<div class="card-body">
	                    		<ul class="list-group">	                    			
	                    			@foreach( $data['options'] as $option )
	                    				<li class="list-group-item li-option" onclick="event.preventDefault();
                                                     document.getElementById('{{ $option }}').submit()";>
	                    					{{ __('messages.'. $option) }} 	
	                    				</li>
	                    			@endforeach
	                    		</ul>	
	                    	</div>

	                    	<form id="editProfile" action="{{ route('user.edit', \Auth::user()->id ) }}" method="GET" style="display: none;">                                
                            </form>

                            <form id="editStore" action="{{ route('store.edit', \Auth::user()->id ) }}" method="GET" style="display: none;">                               
                            </form>

                            <form id="passwordChange" action="{{ route('user.changepassword') }}" method="POST" style="display: none;">
                            	@csrf                            	
                            	<input type="hidden" name="id" value="{{ \Auth::user()->id }}">
                            </form>
	                    @endif	                    
                	</div>
            	</div>

        	 	<div class="col-md-8">
        	 		@include('layouts.alert')
            	 	<div class="card">
	                    <div class="card-header">
	                    	{{ __('messages.Hello') }}
	                    </div>
	                    <div class="card-body">
	                        <div class = "row">
	                        	<div class="col-md-4 col-md-offset-0 data_cell_border">							
									<b>{{ __('messages.Name')}}</b>
									<br> {{ ucfirst(\Auth::user()->name).' '.ucfirst(\Auth::user()->surname) }}				
								</div>
	                        	<div class="col-md-4 col-md-offset-0 data_cell_border">							
									<b>{{ __('messages.E-Mail Address')}}</b>
									<br> {{\Auth::user()->email}}						
								</div>

								<div class="col-md-4 col-md-offset-0 data_cell_border">							
									<b>{{ __('messages.Phone')}}</b>
									<br> {{\Auth::user()->phone}}						
								</div>
	                        </div>

	                        <div class = "row">	                        	
								<div class="col-md-4 col-md-offset-0 data_cell_border">							
									<b>{{ __('messages.Rol')}}</b>
									<br> {{\Auth::user()->rol->name}}						
								</div>

								<div class="col-md-8 col-md-offset-0 data_cell_border">							
									<b>{{ __('messages.Description')}}</b>
									<br> {{ __('messages.'.\Auth::user()->rol->description)}} 						
								</div>

	                        </div>

	                        <div class = "row">
	                        	<div class="col-md-4 col-md-offset-0 data_cell">							
									<b>{{ __('messages.Acount')}}</b>
									<br> {{ ucfirst(\Auth::user()->acount->name) }}						
								</div>

	                        	<div class="col-md-4 col-md-offset-0 data_cell">							
									<b>{{ __('messages.Tables')}}</b>
									<br> {{ \Auth::user()->acount->tables }}						
								</div>

								<div class="col-md-4 col-md-offset-0 data_cell">							
									<b>{{ __('messages.Products')}}</b>
									<br> {{ \Auth::user()->acount->products }}												
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