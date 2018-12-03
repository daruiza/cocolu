@if(Session::has('permits'))    
    @php($permit = Session::get('permits')[$model])        
        @if($permit['active'])                                                  
            @foreach ($permit['options'] as $key_option => $option)                
                @if($option['active'])
                    @if(json_decode($option['label'], true)['menu'] == 'page')
                        
                        <a class="dropdown-item" href="{{ route(json_decode($permit['label'], true)['action'].'.'.$option['name'],['id'=>'0']) }}"
                           onclick="event.preventDefault();
                                         document.getElementById('{{json_decode($permit['label'], true)['action'].'-'.$option['name'].'-form'}}').submit();">
                            <i class="{{ json_decode($option['label'], true)['icon'] }}"></i>
                            {{  $option['name'] }}
                        </a>

                        {!! Form::open(array('id'=>json_decode($permit['label'], true)['action'].'-'.$option['name'].'-form','route' =>[json_decode($permit['label'], true)['action'].'.'.$option['name'],0],'method' => json_decode($option['label'], true)['method'] , 'onsubmit' =>'return validateForm()')) !!}
                            {{ Form::hidden('id','') }}                            
                        {!! Form::close() !!}

                    @endif                                            
                @endif
            @endforeach                
        @endif    
@endif