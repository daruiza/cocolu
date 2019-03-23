<div id="modal_order_view" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title">
          {{ __('messages.TableOrderView') }} 
          <div>
            <i class="fas fa-clipboard"></i> <span class="modal-title-subtext"></span>
          </div>
      	</h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body"> 
        
        {!! Form::open(array('id'=>'form-order-edit','route'=>['order.update',0],'method'=>'POST')) !!}            
          @csrf
		      {{ method_field('PATCH') }}          	            
          <div class="container">            
          </div>
        {!! Form::close() !!}

        {!! Form::open(array('id'=>'form-order-destroy','route'=>['order.destroy',0],'method'=>'POST')) !!}
          {{ method_field('DELETE') }}
          <div class="container-destroy">            
          </div>
        {!! Form::close() !!}
      
      </div>

      <div class="modal-footer">
        <button type="submit" class="btn btn-primary btn-send" form="form-order-edit">{{ __('form.Serve') }}</button>
        <button type="submit" class="btn btn-danger btn-cancel" form="form-order-destroy">{{ __('form.Cancel') }}</button>
        <button type="button" class="btn btn-secondary btn-close" data-dismiss="modal">{{ __('form.Close') }}</button>
      </div>
        
    </div>
  </div>
</div>