@extends('layouts.app')

@section('template')
    <link href="{{ asset('css/custom/login.css') }}" rel="stylesheet">    
@endsection

@section('content')

@auth<!-- no fondo -->
@else
    <div class="video-container">
        <video loop="loop" id="video_background" autoplay preload muted>
          <source 
            src="{{ asset('media/EnteringTheStronghold.webm') }}" 
            src="{{ asset('media/EnteringTheStronghold.mp4') }}"
            type="video/webm">           
          </source>
        </video>
    </div>
@endauth

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 login-card">
            <div class="card">
                <div class="card-header">{{ __('messages.Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}" lang="{{ app()->getLocale() }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-sm-4 col-form-label text-md-right">{{ __('messages.E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus oninvalid="setCustomValidity(' {{ __('messages.E-Mail Address fail1') }}'+this.value+'{{ __('messages.E-Mail Address fail2') }}' )">

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

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
                            <div class="col-md-6 offset-md-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> {{ __('messages.Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('messages.Login') }}
                                </button>

                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('messages.Forgot Your Password?') }}
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6 align-self-center">
        </div>
    </div>
</div>
@endsection
