<div id="modal_clousure_create" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title">          
         <i class="fas fa-list-alt"></i> {{$store->name}} 
            {{ __('form.ClousureConsult') }} 
          </h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body"> 
        <div class="body-header">          

          {{Form::open(array('route'=>['clousure.showclousures',0],'method'=>'GET','class'=> 'form-inline pull-right form-center'))}}          
            
            <div class="form-group form-search">                              
                {{Form::text('name',Session::get('data.inputs')['name'],['class'=>'form-control','placeholder'=>__('messages.Name')])}}
            </div>

            <div class="form-group form-search">                              
                {{Form::text('description',Session::get('data.inputs')['description'],['class'=>'form-control','placeholder'=>__('messages.Description')])}}
            </div>

            <div class="form-group form-search">                              
                {{Form::text('date_open',Session::get('data.inputs')['date_open'],['class'=>'form-control','placeholder'=>__('messages.DateOpen')])}}
            </div>

            <div class="form-group form-search">
                <button type="submit" class="btn btn-default">
                    <i class="fas fa-search"></i>
                </button>
            </div>
          {{Form::close()}}
          
        </div>
        <div class="container table-container">
            <div class="row">
              <div class="col-md-3">{{ __('messages.Name') }}</div>
              <div class="col-md-3">{{ __('messages.Description') }}</div>
              <div class="col-md-3">{{ __('messages.DateOpen') }}</div>
              <div class="col-md-3">{{ __('messages.ordersPaid') }}</div>              
            </div>   
           
          @foreach( Session::get('data.clousures') as $key => $clousure)            
            <div class="row object-clousure @if($key%2) @else row-impar @endif">              
              {!! Form::open(array('id'=>'form-closure-consult'.$clousure->id,'route'=>['clousure.consultclousure',$clousure->id],'method'=>'POST')) !!}
                {!!Form::hidden('store-id', Auth::user()->store()->id)!!}
                {{ Form::hidden('clousure-id', $clousure->id) }} 
              {!! Form::close() !!}
              <div class="col-md-3">{{$clousure->name}}</div>
              <div class="col-md-3">{{$clousure->description}}</div>
              <div class="col-md-3">{{$clousure->date_open}}</div>
              <div class="col-md-3">${{number_format($clousure->total)}}</div>
            </div>
          @endforeach
           

        </div>
        {{ Session::get('data.clousures')
        ->appends([
          'name'=>Session::get('data.inputs')['name'],
          'description'=>Session::get('data.inputs')['description'],
          'date_open'=>Session::get('data.date_open')['date_open']
          ])
          ->links() }}
      </div>      
    </div>
  </div>
</div>