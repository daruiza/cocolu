<div id="modal_order_view" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title">
          {{ __('form.TableOrderView') }} 
          <div>
            <i class=""> </i> <span class="modal-title"></span>
          </div>
      	</h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body"> 
        <div class="container">
          {!! Form::open(array('id'=>'form-order-edit','route'=>['order.update',0],'method'=>'POST')) !!}
          	@csrf
 			{{ method_field('PATCH') }}          	
            {{ Form::hidden('table_id', 0) }}         
            <div class="form-group row">
              <div class="col-md-12">
                
              </div>
            </div>            
          {!! Form::close() !!}
        </div>
      </div>

      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" form="form-order-edit">{{ __('form.Send') }}</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('form.Cancel') }}</button>
      </div>
      
    </div>
  </div>
</div>