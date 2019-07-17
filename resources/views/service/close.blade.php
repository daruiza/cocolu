<div id="modal_service_close" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title">
          {{ __('form.TableServiceClose') }} 
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
           
          {!! Form::open(array('id'=>'form-table-closeservice','route'=>['table.closeservice',$table->id],'method'=>'POST')) !!}
            {{ Form::hidden('table_id', $table->id) }}            
            
            <div class="form-group row">
              <div class="col-md-12">
                {!! Form::label('message',__('messages.Safe'),['class'=>'col-form-label text-md-center']) !!}
              </div>
            </div>
            <div class="form-group row">
              <div class="col-md-12 text-md-center">
              {!! Form::label('description',__('messages.Description'),['class'=>'col-form-label text-md-center','autofocus','autofocus']) !!}
              {!! Form::text('description',null, ['class'=>'form-control']) !!}
              </div>
            </div>
           
          {!! Form::close() !!}
           

        </div>

      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" form="form-table-closeservice">{{ __('form.Send') }}</button>
        <button type="button" class="btn btn-secondary modal-btn-cancel" data-dismiss="modal">{{ __('form.Cancel') }}</button>
      </div>
    </div>
  </div>
</div>