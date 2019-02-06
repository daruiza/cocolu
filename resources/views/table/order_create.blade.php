<div id="modal_order_create" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title">          
            <i class="{{$table->icon}}"> </i> {{$table->name}} 
            {{ __('messages.NewOrder') }}        
          </h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body"> 
        
        <div class="container">          
          <div class="row">
            <div class="col-sm-3">
              <div class="card">

                <div class="card-header">{{ __('messages.OrderMenu') }}</div>
                  <div class="card-body">

                  </div>                

              </div>
            </div>
            <div class="col-sm-9">
              <div class="card">

                <div class="card-header">{{ __('messages.OrderProducts') }}</div>
                  <div class="card-body">
                    
                    <!--
                    <ul class="nav nav-pills justify-content-center">
                      <li class="nav-item">
                        <a class="nav-link active" href="#">Active</a>
                      </li>

                      <li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                      </li>

                      <li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                      </li>

                      <li class="nav-item">
                        <a class="nav-link disabled" href="#">Disabled</a>
                      </li>
                    </ul>
                    -->
                    <ul class="nav nav-pills justify-content-center">
                    @foreach($products as $product)


                      @php ($category = $product->category)
                    @endforeach
                    </ul>


                  </div>                

              </div>
            </div>

          </div>
        </div>

      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" form="form-table-service">{{ __('form.Send') }}</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('form.Cancel') }}</button>
      </div>
    </div>
  </div>
</div>