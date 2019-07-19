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
                    {!! Form::open(array('id'=>'form-table-order','route'=>['table.saveorder',$table->id],'method'=>'POST')) !!}

                      {{ Form::hidden('table-id', $table->id) }}           
                      <div class="orders">
                        
                      </div>
                      <div class="waiters">
                        {{Form::select('waiter_id', $waiters,null,['class' => 'form-control'])}} 
                      </div>
                      
                    {!! Form::close() !!}
                  </div>

              </div>
            </div>
            <div class="col-sm-9">
              <div class="card">

                <div class="card-header">{{ __('messages.OrderProducts') }}</div>
                  <div class="card-body">                   
                    
                    <!--
                    <ul class="nav nav-pills justify-content-center">
                    -->
                    <ul class="nav nav-tabs justify-content-center">
                    @foreach($categories as $key => $category)
                      <li class="nav-item">
                        <a class="nav-link @if(!$key) active @endif" id="{{$category}}-tab" data-toggle="tab" role="tab" aria-controls="{{$category}}" aria-selected="false" href="#{{str_replace(' ','_',$category)}}_conteiner">{{$category}}</a>
                      </li>                      
                    @endforeach
                    </ul>
                    <div class="tab-content">
                      @foreach($categories as $key => $category)
                            <div class="tab-pane fade show @if(!$key) active @endif" id="{{str_replace(' ','_',$category)}}_conteiner" role="tabpanel" aria-labelledby="{{$category}}-tab">
                              <div class="col-md-12">
                                <div class="row">
                              @foreach($products as $key => $product)
                                @if($product->category == $category)
                                  
                                  <div class="col-md-3 ">
                                    <div class="product-conteiner option_add_product" id ="{{$product->id}}_{{$product->store_id}}_{{$product->name}}"  style = "background-image: url({{url('users/'.\Auth::user()->myAdmin().'/products/'.$product->image1)}});">
                                      <div class="product-name noselect">{{$product->name}}</div>
                                      <div class="noselect">{{\Auth::user()->store()->currency}} {{$product->price}}</div>
                                      <div class="product-volume noselect">{{ __('messages.Volume') }}:{{$product->volume}}</div>
                                    </div>                                        
                                  </div>
                                @endif
                              @endforeach
                              </div>
                              </div>
                            </div>                    
                      @endforeach
                    </div>

                  </div>                

              </div>
            </div>

          </div>
        </div>

      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" form="form-table-order">{{ __('form.Send') }}</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('form.Cancel') }}</button>
      </div>
    </div>
  </div>
</div>

<div 
  id="modal_order_conponents" class="modal" tabindex="-1" role="dialog" 
  onwheel="table.mouseWheel(event,'form_modal_order_conponents',1)">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      
      <div class="modal-header">
        <h6 class="modal-title">          
            
            <span><i class="fas fa-list-alt"></i> {{ __('messages.Components') }}</span>        
            <span class="product-name"></span>
          </h6>
        <button type="button" class="close btn-close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">

        <form id="form_modal_order_conponents">          
        <div class="container">          
          <div class="row">
            <div class="col-sm-12"> 
              <div class="card">                  
                    <div class="card-body">
                    </div>                  
              </div>
            </div>
          </div>
        </div>
        </form>

      </div>

      <div class="modal-footer">
        <button type="submit" class="btn btn-primary btn-send" form="form_modal_order_conponents" data-dismiss="modal" >{{ __('form.Send') }}</button>
        <button type="button" class="btn btn-secondary btn-close"  data-dismiss="modal">{{ __('form.Cancel') }}</button>
      </div>
    </div>

  </div>
</div>

<div 
  id="modal_detail" class="modal" tabindex="-1" role="dialog" 
  onwheel="table.mouseWheel(event,'form_modal_order_details',2)">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">

        <h6 class="modal-title">
          <span><i class="fas fa-list-alt"></i> {{ __('messages.EditDetail') }}</span>        
          <span class="detail-name"></span>
        </h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>

      </div>

      <div class="modal-body">

        <form id="form_modal_order_details">
        <div class="container">          
          <div class="row">
            <div class="col-sm-12"> 
              <div class="card">
                  <div class="card-body">
                    
                  </div>
              </div>
            </div>
          </div>
        </div>
        </form>

      </div>

      <div class="modal-footer">
        <button type="submit" class="btn btn-primary btn-edit" form="form_modal_order_details" data-dismiss="modal" >{{ __('form.Edit') }}</button>
        <button type="button" class="btn btn-secondary btn-delete" data-dismiss="modal">{{ __('form.Delete') }}</button>
      </div>

    </div>
  </div>
</div>


{!! Form::hidden('input_placeholder_suggestion', __('messages.Suggestion') ) !!}
{!! Form::hidden('input_volume', __('messages.Volume') ) !!}
{!! Form::hidden('input_price', __('messages.Price') ) !!}
{!! Form::hidden('input_total', __('messages.Total') ) !!}
{!! Form::hidden('error_ingredient_edit', __('messages.errorIngredientEdit') ) !!}
