<div class="alert alert-warning alert-dismissible fade show alert-events" role="alert">
    <h6 class="alert-heading">{{ __('messages.newEvent') }}</h6>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
    <hr>
    <ul class="ul-content">        
    </ul>                       
</div>
{!! Form::hidden('messageNeworder', __('messages.NewOrder') ) !!}
{!! Form::hidden('messageWaiter', __('messages.Waiter') ) !!}
{!! Form::hidden('messageTable', __('messages.Table') ) !!}
{!! Form::hidden('messageOrder', __('messages.Order') ) !!}
{!! Form::hidden('messageHour', __('messages.Hour') ) !!}

