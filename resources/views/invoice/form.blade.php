<div class="form-group row">
	<div class="col-md-12">
		<h5>{{__('messages.InformationInvoice')}}</h5>
	</div>
	<div class="col-md-9 row">
		<div class="col-md-6">
		{!! Form::label('number_invoice',__('form.Number'),['class'=>'col-sm-12 col-form-label text-md-center']) !!}
			<div class="col-md-12">
				@if($errors->has('number_invoice'))
					{!! Form::text('number_invoice',null, ['class'=>'form-control is-invalid']) !!}
					<span class="invalid-feedback">
		                <strong>{{ $errors->first('number_invoice') }}</strong>
		            </span>
				@else
					{!! Form::text('number_invoice',null, ['class'=>'form-control']) !!}
				@endif	
			</div>
		</div>
		<div class="col-md-6">
		{!! Form::label('tax_invoice',__('form.Tax'),['class'=>'col-sm-12 col-form-label text-md-center']) !!}
			<div class="col-md-12">
				@if($errors->has('tax_invoice'))
					{!! Form::text('tax_invoice',null, ['class'=>'form-control is-invalid']) !!}
					<span class="invalid-feedback">
		                <strong>{{ $errors->first('tax_invoice') }}</strong>
		            </span>
				@else
					{!! Form::text('tax_invoice',null, ['class'=>'form-control']) !!}
				@endif	
			</div>
		</div>
		<div class="col-md-12">
			{!! Form::label('description_invoice',__('messages.Description'),['class'=>'col-sm-12 col-form-label text-md-center']) !!}
			<div class="col-md-12">
				@if($errors->has('description_invoice'))
					{!! Form::textarea('description_invoice',null, ['class'=>'form-control is-invalid','rows'=>'4']) !!}
					<span class="invalid-feedback">
		                <strong>{{ $errors->first('description_invoice') }}</strong>
		            </span>
				@else
					{!! Form::textarea('description_invoice',null, ['class'=>'form-control','rows'=>'4']) !!}
				@endif	
			</div>
		</div>
	</div>

	<div class="col-md-3">
		<div class="col-md-12 img-container">
			{{ Html::image('users/'.\Auth::user()->id.'/supports/default.png','Imagen no disponible',array('id'=>'img_support_img','style'=>'width: 100%; border:2px solid #ddd;border-radius: 0%;','onclick'=>'$("#img_support").trigger("click")'))}}
			@if ($errors->has('image'))		                        	
				<span class="invalid-feedback" style="display: block;">
					<strong>{{ $errors->first('image') }}</strong>
				</span>
			@endif
		</div>
		{!! Form::label('support',__('messages.Support'),['class'=>'col-sm-12 col-form-label text-md-center']) !!}				
	</div>

</div>

<div class="form-group row">
	<div class="col-md-12">
		<h5>{{__('messages.InformationProvider')}}</h5>
	</div>
	<div class="col-md-9 row">
		<div class="col-md-6">
		{!! Form::label('number_provider',__('form.Number'),['class'=>'col-sm-12 col-form-label text-md-center']) !!}
			<div class="col-md-12">
				@if($errors->has('number_provider'))
					{!! Form::text('number_provider',null, ['class'=>'form-control is-invalid']) !!}
					<span class="invalid-feedback">
		                <strong>{{ $errors->first('number_provider') }}</strong>
		            </span>
				@else
					{!! Form::text('number_provider',null, ['class'=>'form-control']) !!}
				@endif	
			</div>
		</div>

		<div class="col-md-6">
		{!! Form::label('name_provider',__('messages.Name'),['class'=>'col-sm-12 col-form-label text-md-center']) !!}
			<div class="col-md-12">
				@if($errors->has('name_provider'))
					{!! Form::text('name_provider',null, ['class'=>'form-control is-invalid']) !!}
					<span class="invalid-feedback">
		                <strong>{{ $errors->first('name_provider') }}</strong>
		            </span>
				@else
					{!! Form::text('name_provider',null, ['class'=>'form-control']) !!}
				@endif	
			</div>
		</div>

		<div class="col-md-6">
		{!! Form::label('adress_provider',__('messages.Adress'),['class'=>'col-sm-12 col-form-label text-md-center']) !!}
			<div class="col-md-12">
				@if($errors->has('adress_provider'))
					{!! Form::text('adress_provider',null, ['class'=>'form-control is-invalid']) !!}
					<span class="invalid-feedback">
		                <strong>{{ $errors->first('adress_provider') }}</strong>
		            </span>
				@else
					{!! Form::text('adress_provider',null, ['class'=>'form-control']) !!}
				@endif	
			</div>
		</div>

		<div class="col-md-6">
		{!! Form::label('email_provider',__('messages.E-Mail Address'),['class'=>'col-sm-12 col-form-label text-md-center']) !!}
			<div class="col-md-12">
				@if($errors->has('email_provider'))
					{!! Form::email('email_provider',null, ['class'=>'form-control is-invalid']) !!}
					<span class="invalid-feedback">
		                <strong>{{ $errors->first('email_provider') }}</strong>
		            </span>
				@else
					{!! Form::email('email_provider',null, ['class'=>'form-control']) !!}
				@endif	
			</div>
		</div>

		<div class="col-md-6">
		{!! Form::label('phone_provider',__('messages.Phone'),['class'=>'col-sm-12 col-form-label text-md-center']) !!}
			<div class="col-md-12">
				@if($errors->has('phone_provider'))
					{!! Form::text('phone_provider',null, ['class'=>'form-control is-invalid']) !!}
					<span class="invalid-feedback">
		                <strong>{{ $errors->first('phone_provider') }}</strong>
		            </span>
				@else
					{!! Form::text('phone_provider',null, ['class'=>'form-control']) !!}
				@endif	
			</div>
		</div>

		<div class="col-md-6">
			{!! Form::label('description_provider',__('messages.Description'),['class'=>'col-sm-12 col-form-label text-md-center']) !!}
			<div class="col-md-12">
				@if($errors->has('description_provider'))
					{!! Form::textarea('description_provider',null, ['class'=>'form-control is-invalid','rows'=>'3']) !!}
					<span class="invalid-feedback">
		                <strong>{{ $errors->first('description_provider') }}</strong>
		            </span>
				@else
					{!! Form::textarea('description_provider',null, ['class'=>'form-control','rows'=>'3']) !!}
				@endif	
			</div>
	</div>

	</div>
	<div class="col-md-3">
		
		<div class="col-md-12 img-container">
			{{ Html::image('users/'.\Auth::user()->id.'/providers/default.png','Imagen no disponible',array('id'=>'img_provider_img','style'=>'width: 100%; border:2px solid #ddd;border-radius: 0%;','onclick'=>'$("#img_provider").trigger("click")'))}}
			@if ($errors->has('image_provider'))		                        	
				<span class="invalid-feedback" style="display: block;">
					<strong>{{ $errors->first('image_provider') }}</strong>
				</span>
			@endif
		</div>
		{!! Form::label('support',__('messages.ProviderLogo'),['class'=>'col-sm-12 col-form-label text-md-center']) !!}
	</div>
</div>

<div class="form-group row">
	<div class="col-md-12">
		<h5>{{__('messages.InformationProducts')}}</h5>
	</div>
	<div class="content-products" style="width: 100%;margin-bottom: 15px;">
	</div>
	<div class="col-md-6">
	</div>
	<div class="col-md-6 text-md-right">
		<a href="javascript:invoice.addProduct()" class="site_title" style="text-decoration: none">
			{{__('form.AddProducts')}} <i class="fas fa-plus"></i>
		</a>
	</div>
</div>


<input id="img_support"  style="display: none;" name="image_suport" type="file">
<input id="img_provider"  style="display: none;" name="image_provider" type="file">