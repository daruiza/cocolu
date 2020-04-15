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
			{!! Form::textarea('description',null, ['class'=>'form-control is-invalid']) !!}
			<span class="invalid-feedback">
                <strong>{{ $errors->first('description') }}</strong>
            </span>
		@else
			{!! Form::textarea('description',null, ['class'=>'form-control','rows'=>'3']) !!}
		@endif	
	</div>	                    			
</div>

<div class="form-group row">
	{!! Form::label('price',__('messages.Price'),['class'=>'col-sm-4 col-form-label text-md-right']) !!}
	<div class="col-md-8">
		@if($errors->has('price'))
			{!! Form::number('price',null, ['class'=>'form-control is-invalid','min'=>'0']) !!}
			<span class="invalid-feedback">
                <strong>{{ $errors->first('price') }}</strong>
            </span>
		@else
			{!! Form::number('price',null, ['class'=>'form-control','min'=>'0']) !!}
		@endif	
	</div>
</div>

<div class="form-group row">
	{!! Form::label('buy_price',__('messages.Buy_Price'),['class'=>'col-sm-4 col-form-label text-md-right']) !!}
	<div class="col-md-8">
		@if($errors->has('buy_price'))
			{!! Form::number('buy_price',null, ['class'=>'form-control is-invalid','min'=>'0']) !!}
			<span class="invalid-feedback">
                <strong>{{ $errors->first('buy_price') }}</strong>
            </span>
		@else
			{!! Form::number('buy_price',null, ['class'=>'form-control','min'=>'0']) !!}
		@endif	
	</div>
</div>

<div class="form-group row">
	{!! Form::label('volume',__('messages.Volume'),['class'=>'col-sm-4 col-form-label text-md-right']) !!}
	<div class="col-md-8">
		@if($errors->has('volume'))
			{!! Form::number('volume',null, ['class'=>'form-control is-invalid','min'=>'0','step'=>'0.5']) !!}
			<span class="invalid-feedback">
                <strong>{{ $errors->first('volume') }}</strong>
            </span>
		@else
			{!! Form::number('volume',null, ['class'=>'form-control','min'=>'0','step'=>'0.5']) !!}
		@endif	
	</div>
</div>

<div class="form-group row">
	{!! Form::label('critical_volume',__('messages.CriticalVolume'),['class'=>'col-sm-4 col-form-label text-md-right']) !!}
	<div class="col-md-8">
		@if($errors->has('critical_volume'))
			{!! Form::number('critical_volume',null, ['class'=>'form-control is-invalid','min'=>'0','step'=>'0.5']) !!}
			<span class="invalid-feedback">
                <strong>{{ $errors->first('critical_volume') }}</strong>
            </span>
		@else
			{!! Form::number('critical_volume',null, ['class'=>'form-control','min'=>'0','step'=>'0.5']) !!}
		@endif	
	</div>
</div>

<div class="form-group row">
	{!! Form::label('order',__('messages.Order'),['class'=>'col-sm-4 col-form-label text-md-right']) !!}
	<div class="col-md-8">
		@if($errors->has('order'))
			{!! Form::number('order',null, ['class'=>'form-control is-invalid','min'=>'0']) !!}
			<span class="invalid-feedback">
                <strong>{{ $errors->first('order') }}</strong>
            </span>
		@else
			{!! Form::number('order',$order_max, ['class'=>'form-control','min'=>'0']) !!}
		@endif	
	</div>
</div>

<div class="form-group row">
	{!! Form::label('category_id',__('form.Category'),['class'=>'col-sm-4 col-form-label text-md-right']) !!}
	<div class="col-md-8">
		@if($errors->has('category_id'))
			{!! Form::select('category_id', $category->categories(),$product->categoryArray(),['class'=>'form-control is-invalid chosen-select chosen-select-multiple','multiple'=>'multiple','id'=>'category_id']) !!}
			<span class="invalid-feedback">
                <strong>
                	{{ $errors->first('category_id') }}
                </strong>
            </span>
		@else
			{!! Form::select('category_id', $category->categories(),$product->categoryArray(),['class'=>'form-control chosen-select','multiple'=>'multiple','id'=>'category_id','data-placeholder'=>__('form.SelectOption')]) !!}			
		@endif	
		{!! Form::hidden('category_ids',implode(',',$product->categoryArray()),array('id'=>'category_ids')) !!}	
	</div>	                    			
</div>

<div class="form-group row">
	{!! form::label('unity_id',__('messages.unity'),['class'=>'col-sm-4 col-form-label text-md-right']) !!}
	<div class="col-md-8">
		@if($errors->has('unity_id'))
			{!! Form::select('unity_id',$unity->unities(),null,['class'=>'form-control']) !!}
			<span class="invalid-feedback">
                <strong>{{ $errors->first('unity_id') }}</strong>
            </span>
		@else				                    					
			{!! Form::select('unity_id',$unity->unities(),null,['class'=>'form-control']) !!}
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


<input id="img_product1"  style="display: none;" name="image1" type="file">

<!--
<input id="img_user"  style="display: none;" name="image" type="file">
<input id="img_product1"  style="display: none;" name="image" type="file">
<input id="img_product2"  style="display: none;" name="image" type="file">
<input id="img_product3"  style="display: none;" name="image" type="file">
-->