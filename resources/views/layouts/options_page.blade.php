@if(Session::has('permits'))    
    @php($permit = Session::get('permits')[$model])        
        @if($permit['active'])

            @foreach ($permit['options'] as $key_option => $option)                
                @if($option['active'])
                    @if(json_decode($option['label'], true)['menu'] == 'page')                      

                        <a class="dropdown-item option-{{$option['name']}}" href="javascript: {{ json_decode($permit['label'], true)['action'].'_'.$option['name'] }}_submit('{{json_decode($permit['label'], true)['action'].'-'.$option['name']}}-form')">
                            <i class="{{ json_decode($option['label'], true)['icon'] }}"></i>
                            <span>{{ __('options.'.$option['name']) }}</span>
                                
                        </a>                        

                        {!! Form::open(array('id'=>json_decode($permit['label'], true)['action'].'-'.$option['name'].'-form','route' =>[json_decode($permit['label'], true)['action'].'.'.$option['name'],0],'method' => json_decode($option['label'], true)['method'] , 'onsubmit' =>'return validateForm()')) !!}
                            {{ Form::hidden('id','') }}                            
                        {!! Form::close() !!}
                    @endif                                            
                @endif
            @endforeach                
        @endif    
@endif
