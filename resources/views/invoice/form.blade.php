<div class="form-group row">
	<div class="col-md-12">
		<h5>{{__('messages.InformationInvoice')}}</h5>
	</div>
	<div class="col-md-3">
	{!! Form::label('number',__('form.Number'),['class'=>'col-sm-12 col-form-label text-md-center']) !!}
		<div class="col-md-12">
			@if($errors->has('number'))
				{!! Form::text('number',null, ['class'=>'form-control is-invalid']) !!}
				<span class="invalid-feedback">
	                <strong>{{ $errors->first('number') }}</strong>
	            </span>
			@else
				{!! Form::text('number',null, ['class'=>'form-control']) !!}
			@endif	
		</div>
	</div>
	<div class="col-md-3">
	{!! Form::label('tax',__('form.Tax'),['class'=>'col-sm-12 col-form-label text-md-center']) !!}
		<div class="col-md-12">
			@if($errors->has('tax'))
				{!! Form::text('tax',null, ['class'=>'form-control is-invalid']) !!}
				<span class="invalid-feedback">
	                <strong>{{ $errors->first('tax') }}</strong>
	            </span>
			@else
				{!! Form::text('tax',null, ['class'=>'form-control']) !!}
			@endif	
		</div>
	</div>

	<div class="col-md-6">
	{!! Form::label('description',__('messages.Description'),['class'=>'col-sm-12 col-form-label text-md-center']) !!}
		<div class="col-md-12">
			@if($errors->has('description'))
				{!! Form::text('description',null, ['class'=>'form-control is-invalid']) !!}
				<span class="invalid-feedback">
	                <strong>{{ $errors->first('description') }}</strong>
	            </span>
			@else
				{!! Form::text('description',null, ['class'=>'form-control']) !!}
			@endif	
		</div>
	</div>
</div>

<div class="form-group row">
	<div class="col-md-12">
		<h5>{{__('messages.InformationProvider')}}</h5>
	</div>
	<div class="col-md-8"></div>
	<div class="col-md-4">
		
		<div class="col-md-12 img-container">
			{{ Html::image('users/'.\Auth::user()->id.'/providers/default.png','Imagen no disponible',array('id'=>'img_provider_img','style'=>'width: 100%; border:2px solid #ddd;border-radius: 0%;','onclick'=>'$("#img_provider").trigger("click")'))}}
			@if ($errors->has('image_provider'))		                        	
				<span class="invalid-feedback" style="display: block;">
					<strong>{{ $errors->first('image_provider') }}</strong>
				</span>
			@endif
		</div>
	</div>
</div>



<input id="img_support"  style="display: none;" name="image_suport" type="file">
<input id="img_provider"  style="display: none;" name="image_provider" type="file">