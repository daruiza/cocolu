<div class="card-body">
    <ul class="list-group">                                 
        @foreach( $data['options'] as $option )            
            <li class="list-group-item li-option" onclick="event.preventDefault();
                         document.getElementById('{{ $option }}').submit()">
                {{ __('options.'. $option) }}  
            </li>
        @endforeach
    </ul>   
</div>

<form id="consultClousure" action="{{ route('clousure.showclousures', \Auth::user()->id ) }}" method="GET"></form>

<form id="editStore" action="{{ route('store.edit', \Auth::user()->id ) }}" method="GET"></form>

<form id="editClousure" action="{{ route('clousure.edit', \Auth::user()->id ) }}" method="GET"></form>

<form id="passwordChange" action="{{ route('user.changepassword') }}" method="POST">
    @csrf                               
    <input type="hidden" name="id" value="{{ \Auth::user()->id }}">
</form>

<form id="sendMessage" action="{{ route('message.create') }}" method="GET"></form>