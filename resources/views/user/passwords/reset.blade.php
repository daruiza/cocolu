@extends('layouts.app')

@section('template')
    <link href="{{ asset('css/custom/login.css') }}" rel="stylesheet">    
    <link href="{{ asset('css/custom/perfil.css') }}" rel="stylesheet"> 
@endsection

@section('content')
<div class="flex-center position-ref full-height container">    
    <div class="container">
        <div class="row justify-content-center">

            <div class="col-md-4 ">                
                <div class="card">
                    <div class="card-header">{{ __('messages.Options') }}</div>
                    @if (!empty($options) )
                        <div class="card-body">
                            <ul class="list-group">                                 
                                @foreach( $options as $option )
                                    <li class="list-group-item li-option" onclick="event.preventDefault();
                                                 document.getElementById('{{ $option }}').submit()";>
                                        {{ __('messages.'. $option) }}  
                                    </li>
                                @endforeach
                            </ul>   
                        </div>

                        <form id="editProfile" action="{{ route('user.edit', \Auth::user()->id ) }}" method="GET" style="display: none;">
                            
                        </form>

                        <form id="editStore" action="{{ route('store.edit', \Auth::user()->id ) }}" method="GET" style="display: none;">                               
                        </form>

                        <form id="workClousure" action="{{ route('clousure.update', \Auth::user()->id ) }}" method="POST" ">
                                @csrf                               
                                <input type="hidden" name="id" value="{{ \Auth::user()->id }}">
                            </form>

                        <form id="passwordChange" action="{{ route('user.changepassword') }}" method="POST" style="display: none;">
                            @csrf                               
                            <input type="hidden" name="id" value="{{ \Auth::user()->id }}">
                        </form>

                    @endif                      
                </div>
            </div>

            <div class="col-md-8 login-card">
                @include('layouts.alert')
                <div class="card">
                    <div class="card-header">{{ __('messages.Change Password') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('user.passwordrequest') }}">
                            @csrf                        
                            <input type="hidden" name="token" value="{{ $token }}">
                            <input type="hidden" name="id" value="{{ \Auth::user()->id }}">
                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('messages.Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('messages.Confirm Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('messages.Reset Password') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
