

@if(Session::has('danger'))                  
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <h6 class="alert-heading">{{ __('errors.somethingIsWrong') }}</h6>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <hr>
        <ul>
            @foreach (Session::get('danger') as $error)
                @if (array_key_exists(1,$error))
                    <li>{{ __('errors.'.$error[0],['Name'=>$error[1]]) }}</li>
                @else
                    <li>{{ __('errors.'.$error[0]) }}</li>
                @endif
            @endforeach
            {{Session::forget('danger')}}
        </ul>                       
    </div>
@endif


@if(Session::has('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <h6 class="alert-heading">{{ __('success.successful') }}</h6>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <hr>
        <ul>
            @foreach (Session::get('success') as $message)
                @if (array_key_exists(1,$message))
                    <li>{{ __('success.'.$message[0],['Name'=>$message[1]]) }}</li>
                @else
                    <li>{{ __('success.'.$message[0]) }}</li>
                @endif
            @endforeach
            {{Session::forget('success')}}
        </ul>                       
    </div>
@endif

@if(Session::has('info'))
    <div class="alert alert-info alert-dismissible fade show" role="alert">
        <h6 class="alert-heading">{{ __('success.successful') }}</h6>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <hr>
        <ul>
            @foreach (Session::get('info') as $message)
                @if (array_key_exists(1,$message))
                    <li>{{ __('info.'.$message[0],['Name'=>$message[1]]) }}</li>
                @else
                    <li>{{ __('info.'.$message[0]) }}</li>
                @endif
            @endforeach
            {{Session::forget('info')}}
        </ul>                       
    </div>
@endif


@if(!empty($danger))     
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <h6 class="alert-heading">{{ __('errors.somethingIsWrong') }}</h6>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <hr>
        <ul>
            @foreach ($danger as $error)
                @if (array_key_exists(1,$error))
                    <li>{{ __('errors.'.$error[0],['Name'=>$error[1]]) }}</li>
                @else
                    <li>{{ __('errors.'.$error[0]) }}</li>
                @endif
            @endforeach
            {{Session::forget('danger')}}
        </ul>                       
    </div>
@endif


@if(!empty($success))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <h6 class="alert-heading">{{ __('success.successful') }}</h6>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <hr>
        <ul>
            @foreach ($success as $message)
                @if (array_key_exists(1,$message))
                    <li>{{ __('success.'.$message[0],['Name'=>$message[1]]) }}</li>
                @else
                    <li>{{ __('success.'.$message[0]) }}</li>
                @endif
            @endforeach
            {{Session::forget('success')}}
        </ul>                       
    </div>
@endif

@if(!empty($info))
    <div class="alert alert-info alert-dismissible fade show" role="alert">
        <h6 class="alert-heading">{{ __('success.successful') }}</h6>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <hr>
        <ul>
            @foreach ($info as $message)
                @if (array_key_exists(1,$message))
                    <li>{{ __('info.'.$message[0],['Name'=>$message[1]]) }}</li>
                @else
                    <li>{{ __('info.'.$message[0]) }}</li>
                @endif
            @endforeach
            {{Session::forget('info')}}
        </ul>                       
    </div>
@endif



