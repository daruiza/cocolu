@auth                         
	<!-- Admin -->
    @if(Auth::user()->rol_id == 2)
    	<!-- Nueva orden Creada -->
	    <neworder-component 
	        :user="{{ auth()->user() }}">        
	    </neworder-component>

	    <!-- Nuevo Mensaje -->
	    <newmessage-component 
	        :user="{{ auth()->user() }}">        
	    </newmessage-component>
    @endif

    <!-- Waiter -->
    @if(Auth::user()->rol_id == 3)
    	
    @endif

    {!! Form::hidden('messageNeworder', __('messages.NewOrder') ) !!}
    {!! Form::hidden('messageNewmessage', __('messages.NewMessage') ) !!}    
	{!! Form::hidden('messageWaiter', __('messages.Waiter') ) !!}
	{!! Form::hidden('messageTable', __('messages.Table') ) !!}
	{!! Form::hidden('messageOrder', __('messages.Order') ) !!}
	{!! Form::hidden('messageHour', __('messages.Hour') ) !!}
@endauth

