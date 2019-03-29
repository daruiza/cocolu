<form id="editProfile" action="{{ route('user.edit', \Auth::user()->id ) }}" method="GET" ">                                
</form>

<form id="editStore" action="{{ route('store.edit', \Auth::user()->id ) }}" method="GET" ">

</form>

<form id="workClousure" action="{{ route('clousure.update', \Auth::user()->id ) }}" method="POST" ">
	@csrf
	{{ method_field('PATCH') }}                         	
	<input type="hidden" name="id" value="{{ \Auth::user()->id }}">
</form>

<form id="passwordChange" action="{{ route('user.changepassword') }}" method="POST" ">
	@csrf                            	
	<input type="hidden" name="id" value="{{ \Auth::user()->id }}">
</form>