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
                    	@include('layouts.form_options_profile')                            
                    @endif	                    
            	</div>
        	</div>

    	 	<div class="col-md-8">
    	 		@include('layouts.alert')
    	 		<div class="card">
                    <div class="card-header">
                    	{{ __('messages.editClousure') }}
                    </div>
                    <div class="card-body">
                    	{!!Form::hidden('services', $user->store()->clousureOpen()->services()->count())!!}
                		<form id="form-work-clousure" action="{{ route('clousure.update', \Auth::user()->id ) }}" method="POST">
                    	 	@csrf
                    	 	{{ method_field('PATCH') }}
                    	 	<input type="hidden" name="id" value="{{ \Auth::user()->id }}">

                    	 	<div class="form-group last-clousure">
                    	 		<div class="row">
	                    	 		<label for="date" class="col-md-12 col-form-label text-md-center">
	                    	 			<h4>{{ __('messages.openClousureToClose') }}</h4>
	                    	 		</label>
                    	 		</div>
                    	 		<div class="row">
	                    	 		<label for="date" class="col-md-3 col-form-label text-md-center">
	                    	 			<div>{{ __('messages.openClousure') }}</div>	
	                    	 			<div>{{ $user->store()->clousureOpen()->name }}</div>	
	                    	 		</label>
	                    	 		<label for="date" class="col-md-3 col-form-label text-md-center">
	                    	 			<div> {{ __('messages.Date') }} </div>	
	                    	 			<div>{{ $user->store()->clousureOpen()->date_open }}</div>
	                    	 		</label>
	                    	 		<label for="date" class="col-md-6 col-form-label text-md-center">
	                    	 			<div> {{ __('messages.Description') }} </div>	
	                    	 			<div>
	                    	 				<input id="description" type="text" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" value="{{ $user->store()->clousureOpen()->description }}" required >
			                                @if ($errors->has('description'))
			                                    <span class="invalid-feedback">
			                                        <strong>{{ $errors->first('description') }}</strong>
			                                    </span>
			                                @endif

	                    	 			</div>	
	                    	 		</label>
                    	 		</div>
                    	 	</div>


                    	 	<div class="form-group new-clousure">

                    	 		<div class="row">
                    	 			<label for="name" class="col-md-4 col-form-label text-md-right">
                    	 			{{ __('messages.Name') }}
	                    	 		</label>
	                    	 		<div class="col-md-8">
		                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>
		                                @if ($errors->has('name'))
		                                    <span class="invalid-feedback">
		                                        <strong>{{ $errors->first('name') }}</strong>
		                                    </span>
		                                @endif
		                            </div>	

                    	 		</div>
                    	 		
                    	 		<div class="row">
		                            <label for="description" class="col-md-4 col-form-label text-md-right">
	                    	 			{{ __('messages.Description') }}
	                    	 		</label>
	                    	 		<div class="col-md-8">
		                                <input id="new_description" type="text" class="form-control{{ $errors->has('new_description') ? ' is-invalid' : '' }}" name="new_description" value="{{ old('new_description') }}">

		                                @if ($errors->has('new_description'))
		                                    <span class="invalid-feedback">
		                                        <strong>{{ $errors->first('new_description') }}</strong>
		                                    </span>
		                                @endif
		                            </div>
	                            </div>
                    	 	</div>

                    	 	<div class="form-group row mb-0">
                                <div class="col-md-2 offset-md-10">
                                    <button type="button" class="btn btn-primary btn-send">
                                        {{ __('messages.Send') }}
                                    </button>
                                </div>
                            </div>
                    	</form>
                    </div>
                </div>
    	 	</div>
    	</div>
    </div>
</div>

<div id="modal-confirm" class="modal" tabindex="-1" role="dialog" >
	<div class="modal-dialog modal-sm" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h6 class="modal-title" id="myModalLabel">{{ __('messages.Confirm') }}</h6>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				
      		</div>
      		<div class="modal-body"> 
        		<div class="container">        			
        			<div class="row">
        				<div class="col-md-12">
        					{{ __('messages.SafeClousure') }}
        				</div>
        				<div class="col-md-12">
        					{{ __('messages.Services') }}
        					<span class="servers"></span>
        				</div>
        			</div>
        		</div>
    		</div>	
      		<div class="modal-footer">
        		<button type="submit" class="btn btn-default" form="form-work-clousure" >{{ __('messages.Yes') }}</button>
        		<button type="button" class="btn btn-primary" data-dismiss="modal">{{ __('messages.Not') }}</button>
      		</div>
    	</div>
  	</div>
</div>  	

@endsection

@section('style')
	<style type="text/css">
		.last-clousure,
		.new-clousure{
			border: 1px solid rgba(0,0,0,.125);
    		border-radius: .25rem;
		}
		.new-clousure{
			padding-top: 10px;
    		padding-bottom: 10px;
		}
	</style>
@endsection

@section('script')
	<script type="text/javascript">
		$("#form-work-clousure .btn-send").on("click", function(){
			$('.servers').html($( "input[name='services']" ).val());
			$("#modal-confirm").modal('show');
	  	});		
	</script>
@endsection