<div id="modal_service_create" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title">
          {{ __('form.TableServiceCreate') }} 
          <div>
            <i class="{{$table->icon}}"> </i> {{$table->name}} 
          </div>
          </h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body"> 
        <div class="container">
           
          {!! Form::open(array('id'=>'form-table-service','route'=>['table.saveservice',$table->id],'method'=>'POST')) !!}
            {{ Form::hidden('table_id', $table->id) }}            
            <div class="form-group row">
              <div class="col-md-12">
                {!! Form::label('name',__('messages.Name'),['class'=>'col-form-label text-md-right']) !!}
                {!! Form::text('name',null, ['class'=>'form-control']) !!}
              </div>
            </div>
            <!--
            <div class="form-group row">
              <div class="col-md-12">
              {!! Form::label('description',__('messages.Description'),['class'=>'col-form-label text-md-right']) !!}
              {!! Form::text('description',null, ['class'=>'form-control']) !!}
              </div>
            </div>
            -->
          {!! Form::close() !!}
           

        </div>

      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" form="form-table-service">{{ __('form.Send') }}</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('form.Cancel') }}</button>
      </div>
    </div>
  </div>
</div>