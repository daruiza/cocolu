<div class="form-group row">
	{!! Form::label('name',__('messages.Name'),['class'=>'col-sm-4 col-form-label text-md-right']) !!}
	<div class="col-md-8">
		@if($errors->has('name'))
			{!! Form::text('name',null, ['class'=>'form-control is-invalid']) !!}
			<span class="invalid-feedback">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
		@else
			{!! Form::text('name',null, ['class'=>'form-control']) !!}
		@endif	
	</div>
</div>

<div class="form-group row">
	{!! Form::label('surname',__('messages.Surname'),['class'=>'col-sm-4 col-form-label text-md-right']) !!}
	<div class="col-md-8">
		@if($errors->has('surname'))
			{!! Form::text('surname',null, ['class'=>'form-control is-invalid']) !!}
			<span class="invalid-feedback">
                <strong>{{ $errors->first('surname') }}</strong>
            </span>
		@else
			{!! Form::text('surname',null, ['class'=>'form-control']) !!}
		@endif	
	</div>
</div>

<div class="form-group row">
	{!! Form::label('phone',__('messages.Phone'),['class'=>'col-sm-4 col-form-label text-md-right']) !!}
	<div class="col-md-8">
		@if($errors->has('phone'))
			{!! Form::text('phone',null, ['class'=>'form-control is-invalid']) !!}
			<span class="invalid-feedback">
                <strong>{{ $errors->first('phone') }}</strong>
            </span>
		@else
			{!! Form::text('phone',null, ['class'=>'form-control']) !!}
		@endif	
	</div>
</div>

<div class="form-group row">
	{!! Form::label('email',__('messages.E-Mail Address'),['class'=>'col-sm-4 col-form-label text-md-right']) !!}
	<div class="col-md-8">
		@if($errors->has('email'))
			{!! Form::text('email',null, ['class'=>'form-control is-invalid']) !!}
			<span class="invalid-feedback">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
		@else
			{!! Form::text('email',null, ['class'=>'form-control']) !!}
		@endif	
	</div>
</div>

<div class="form-group row">
	{!! Form::label('description',__('messages.Description'),['class'=>'col-sm-4 col-form-label text-md-right']) !!}
	<div class="col-md-8">
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

<div class="form-group row">
	{!! Form::label('password',__('messages.Password'),['class'=>'col-sm-4 col-form-label text-md-right']) !!}
	<div class="col-md-8">
		@if($errors->has('password'))
			{!! Form::password('password',['class'=>'form-control is-invalid']) !!}
			<span class="invalid-feedback">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
		@else
			{!! Form::password('password',['class'=>'form-control']) !!}
		@endif	
	</div>	                    			
</div>

<div class="form-group row">
	{!! Form::label('password-confirm',__('messages.Confirm Password'),['class'=>'col-sm-4 col-form-label text-md-right']) !!}
	<div class="col-md-8">
		@if($errors->has('password-confirm'))
			{!! Form::password('password-confirm',['class'=>'form-control is-invalid']) !!}
			<span class="invalid-feedback">
                <strong>{{ $errors->first('password-confirm') }}</strong>
            </span>
		@else
			{!! Form::password('password_confirmation', ['id'=>'password-confirm','class'=>'form-control']) !!}
		@endif	
	</div>	                    			
</div>

<!--
<div class="form-group row">
	{!! Form::label('label',__('messages.label'),['class'=>'col-sm-4 col-form-label text-md-right']) !!}
	<div class="col-md-8">
		@if($errors->has('label'))
			{!! Form::text('label',null, ['class'=>'form-control is-invalid']) !!}
			<span class="invalid-feedback">
                <strong>{{ $errors->first('label') }}</strong>
            </span>
		@else
			{!! Form::text('label',null, ['class'=>'form-control']) !!}
		@endif	
	</div>	                    			
</div>
-->

<div class="form-group row">
	{!! form::label('active',__('messages.state'),['class'=>'col-sm-4 col-form-label text-md-right']) !!}
	<div class="col-md-8">
		@if($errors->has('active'))
			{!! Form::select('active', [__('messages.inactive'),__('messages.active')],null,['class'=>'form-control']) !!}
			<span class="invalid-feedback">
                <strong>{{ $errors->first('active') }}</strong>
            </span>
		@else				                    					
			{!! Form::select('active', [__('messages.inactive'),__('messages.active')],null,['class'=>'form-control']) !!}
		@endif	
	</div>
</div>

<input id="img_user"  style="display: none;" name="image" type="file">