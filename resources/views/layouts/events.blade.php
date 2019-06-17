@auth                         
    @if(Auth::user()->rol_id == 2)
    	<!-- Nueva orden Creada -->
	    <neworder-component 
	        :user="{{ auth()->user() }}">        
	    </neworder-component>
    @endif
@endauth     