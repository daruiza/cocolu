@extends('layouts.app_request')

@section('template')
    
@endsection

@section('content')
<div class="container">
   <div class="flex-center position-ref full-height">
        <div class="col-md-12">
            <div class="content">
            	<div class="row">
            		<div class="col-md-9">
            			<div class="card">
            				<div class="card-header">{{ __('messages.WriteMessage') }}</div>
            				<div class="card-body">
            					{!! Form::open(['enctype' => 'multipart/form-data','id'=>'form-message','route'=>['message.requeststore'],'method'=>'POST']) !!}

            						{!!Form::hidden('store_id', $store->id)!!}
            						{!!Form::hidden('table_id', $table->id)!!}

            						{!! Form::select('issue',$request,null,['id'=>'issue','class'=>'form-control form-group ']) !!}

            						<div class="form-group row">		                                

		                                <div class="col-md-6">
		                                    <textarea id="body" type="textarea" rows="5" class="form-control" name="body" required placeholder="{{ __('messages.WriteUsMessage') }}">
		                                	</textarea>
		                                </div>
		                                @if ($errors->has('body'))
		                                    <span class="invalid-feedback">
		                                        <strong>{{ $errors->first('body') }}</strong>
		                                    </span>
		                                @endif
		                            </div>  

            						<div class="button-submit">
										<button type="submit" class="btn btn-primary" form="form-message">
											{{ __('messages.Send') }}
										</button>
									</div>
            					{!! Form::close() !!}
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