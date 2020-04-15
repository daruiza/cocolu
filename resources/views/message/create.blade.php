@extends('layouts.app')

@section('template')
    <link href="{{ asset('css/custom/welcome.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom/col_md_custom.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom/perfil.css') }}" rel="stylesheet">    
@endsection

@section('content')
<div class="flex-center position-ref full-height container">
    <div class="container">       
    	<div class="row">
		    <div class="col-md-3 col-lateral-table">
		        <div class="col-md-12">
		        <div class="card card-menu-table">
		            <div class="card-header">{{ __('messages.DashboardOptions') }}</div>
		            <div class="card-body">
		                <div class="container services-table">
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
		            <div class="card-header">{{ __('messages.CreateMessage') }}</div>
		            <div class="card-body">
		                
                    	<form method="POST" action="{{ route('message.store') }}">
                            @csrf                        
                            <input type="hidden" name="token" value="{{ $token }}">
                            <input type="hidden" name="id_user" value="{{ \Auth::user()->id }}">
                            <div class="form-group row">
                                <label for="issue" class="col-md-4 col-form-label text-md-right">
	                                {{ __('messages.issue') }}
	                            </label>
                                <div class="col-md-6">
                                    <input 	id="issue"
                                    		type="text" 
                                    		class="form-control{{ $errors->has('issue') ? ' is-invalid' : '' }}"
                                    		name="issue"
                                    		required >
                                    @if ($errors->has('issue'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('issue') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="body" class="col-md-4 col-form-label text-md-right">
                                	{{ __('messages.body') }}
                                </label>

                                <div class="col-md-6">
                                    <textarea id="body" type="textarea" class="form-control" name="body" required>
                                	</textarea>
                                </div>
                                @if ($errors->has('body'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('body') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
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
@endsection

@section('style')
	<style type="text/css">
		
	</style>
@endsection

@section('script')    
    <script type="application/javascript">
        
    </script>    
@endsection