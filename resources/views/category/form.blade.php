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
	{!! Form::label('category_id',__('form.LabelCategoryPhather'),['class'=>'col-sm-4 col-form-label text-md-right']) !!}
	<div class="col-md-8">
		@if($errors->has('category_id'))
			{!! Form::select('category_id', $category->categories(),null,['class'=>'form-control is-invalid']) !!}
			<span class="invalid-feedback">
                <strong>
                	{{ $errors->first('category_id') }}
                </strong>
            </span>
		@else
			{!! Form::select('category_id', $category->categories(),null,['class'=>'form-control']) !!}				                    					
		@endif	
	</div>	                    			
</div>

<div class="form-group row">
	{!! Form::label('order',__('messages.Order'),['class'=>'col-sm-4 col-form-label text-md-right']) !!}
	<div class="col-md-8">
		@if($errors->has('order'))
			{!! Form::number('order',null, ['class'=>'form-control is-invalid']) !!}
			<span class="invalid-feedback">
                <strong>{{ $errors->first('order') }}</strong>
            </span>
		@else
			{!! Form::number('order',$order_max, ['class'=>'form-control']) !!}
		@endif	
	</div>
</div>

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


<div class="form-group row mb-0">
    <div class="col-md-8 offset-md-4">
        <button type="submit" class="btn btn-primary">
            {{ __('messages.Send') }}
        </button>	                                
    </div>
</div>