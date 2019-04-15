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
	{!! Form::label('description',__('messages.Description'),['class'=>'col-sm-4 col-form-label text-md-right']) !!}
	<div class="col-md-8">
		@if($errors->has('description'))
			{!! Form::textarea('description',null, ['class'=>'form-control is-invalid','rows'=>'4']) !!}
			<span class="invalid-feedback">
                <strong>{{ $errors->first('description') }}</strong>
            </span>
		@else
			{!! Form::textarea('description',null, ['class'=>'form-control','rows'=>'4']) !!}
		@endif	
	</div>	                    			
</div>

<div class="form-group row">
	{!! Form::label('value',__('messages.Value'),['class'=>'col-sm-4 col-form-label text-md-right']) !!}
	<div class="col-md-8">
		@if($errors->has('value'))
			{!! Form::number('value',null, ['class'=>'form-control is-invalid']) !!}
			<span class="invalid-feedback">
                <strong>{{ $errors->first('value') }}</strong>
            </span>
		@else
			{!! Form::number('value',null, ['class'=>'form-control']) !!}
		@endif	
	</div>
</div>


<div class="form-group row mb-0">
    <div class="col-md-8 offset-md-4">
        <button type="submit" class="btn btn-primary">
            {{ __('messages.Send') }}
        </button>	                                
    </div>
</div>

<input id="img_support"  style="display: none;" name="image" type="file">