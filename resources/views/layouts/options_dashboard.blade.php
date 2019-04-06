
<div class="card-body">
    <ul class="list-group">                                 
        @foreach( $data['options'] as $option )            
            <li class="list-group-item li-option" onclick="event.preventDefault();
                         document.getElementById('{{ $option }}').submit()";>
                {{ __('messages.'. $option) }}  
            </li>
        @endforeach
    </ul>   
</div>

<form id="editProfile" action="{{ route('user.edit', \Auth::user()->id ) }}" method="GET" "></form>

<form id="editStore" action="{{ route('store.edit', \Auth::user()->id ) }}" method="GET" "></form>

<form id="editClousure" action="{{ route('clousure.edit', \Auth::user()->id ) }}" method="GET" "></form>

<form id="passwordChange" action="{{ route('user.changepassword') }}" method="POST" ">
    @csrf                               
    <input type="hidden" name="id" value="{{ \Auth::user()->id }}">
</form>