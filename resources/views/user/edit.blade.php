@extends('layouts.app')

@section('template')
  	<link href="{{ asset('css/custom/edit.css') }}" rel="stylesheet"> 
  	<link href="{{ asset('css/custom/perfil.css') }}" rel="stylesheet">       
@endsection

@section('content')
	<div class="flex-center position-ref full-height container">    
	    <div class="container">
	        <div class="row row-edit-perfil">

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
	                    <div class="card-header">{{ __('messages.editProfile') }}</div>
	                    <div class="card-body">
	                    	<div class="col-md-8">
		                    	<form id="edit-form-user" method="POST" action="{{ route('user.update', \Auth::user()->id ) }}" enctype="multipart/form-data" accept-charset="UTF-8" >
		                    	 	@csrf
		                    	 	{{ method_field('PATCH') }}
		                    	 	
		                    	 	<div class="form-group row">
			                            <label for="name" class="col-sm-4 col-form-label text-md-right">{{ __('messages.Name') }}</label>

			                            <div class="col-md-8">
			                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

			                                @if ($errors->has('name'))
			                                    <span class="invalid-feedback">
			                                        <strong>{{ $errors->first('name') }}</strong>
			                                    </span>
			                                @endif
			                            </div>
			                        </div>

			                        <div class="form-group row">
			                            <label for="surname" class="col-sm-4 col-form-label text-md-right">{{ __('messages.Surname') }}</label>

			                            <div class="col-md-8">
			                                <input id="surname" type="text" class="form-control{{ $errors->has('surname') ? ' is-invalid' : '' }}" name="surname" value="{{ old('surname') }}">

			                                @if ($errors->has('surname'))
			                                    <span class="invalid-feedback">
			                                        <strong>{{ $errors->first('surname') }}</strong>
			                                    </span>
			                                @endif
			                            </div>
			                        </div>

									<div class="form-group row">
			                            <label for="phone" class="col-sm-4 col-form-label text-md-right">{{ __('messages.Phone') }}</label>

			                            <div class="col-md-8">
			                                <input id="phone" type="text" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="{{ old('phone') }}" >

			                                @if ($errors->has('phone'))
			                                    <span class="invalid-feedback">
			                                        <strong>{{ $errors->first('phone') }}</strong>
			                                    </span>
			                                @endif
			                            </div>
			                        </div>

		                    	 	<div class="form-group row">
			                            <label for="email" class="col-sm-4 col-form-label text-md-right">{{ __('messages.E-Mail Address') }}</label>

			                            <div class="col-md-8">
			                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

			                                @if ($errors->has('email'))
			                                    <span class="invalid-feedback">
			                                        <strong>{{ $errors->first('email') }}</strong>
			                                    </span>
			                                @endif
			                            </div>
			                        </div>

			                        <input id="img_user"  style="display: none;" name="image" type="file">
			                        <!--
		                    	 	<div class="form-group row mb-0">
			                            <div class="col-md-8 offset-md-4">
			                                <button type="submit" class="btn btn-primary" form="edit-form-user">
			                                    {{ __('messages.Send') }}
			                                </button>	                                
			                            </div>
			                        </div>	                    	 
			                        -->
		                    	 </form>
		                    </div>
	                    	<div class="col-md-4">        			
			        			<div class="col-md-12 img-container">
									{{ Html::image('users/'.\Auth::user()->id.'/profile/'.\Auth::user()->avatar,'Imagen no disponible',array('id'=>'img_user_img','style'=>'width: 100%; border:2px solid #ddd;border-radius: 0%;','onclick'=>'$("#img_user").trigger("click")'))}}
									@if ($errors->has('image'))		                        	
			                            <span class="invalid-feedback" style="display: block;">
			                                <strong>{{ $errors->first('image') }}</strong>
			                            </span>
			                        @endif
								</div>
								<div class="col-md-12 button-submit">
				        			<button type="submit" class="btn btn-primary" form="edit-form-user">
				        				{{ __('messages.Send') }}
				                    </button>
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
	<script type="text/javascript"> 
		$('#img_user').change(function(e) {
	    	var file = e.target.files[0],
		    imageType = /image.*/;
		    
		    if (!file.type.match(imageType))
		    return;
		  
		    var reader = new FileReader();
		    reader.onload = function(e) {
		    	var result=e.target.result;
		    	$('#img_user_img').attr("src",result);
		    }
		    reader.readAsDataURL(file);
	    });
	</script>
@endsection

@section('style')
	<style type="text/css">		
		.row-edit-perfil div:nth-of-type(2) .card-body{
			display: flex;
		}

		.col-form-label{
			padding: 0px;
			padding-top: calc(.375rem + 1px);
		}

		.button-submit{
			text-align: right;
		    padding-right: 20px;
		    margin-bottom: 20px;
		}
		.button-submit button{
			width: 100%;
    		margin-top: 10%;
		}
	</style>
@endsection