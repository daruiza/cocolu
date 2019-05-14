@extends('layouts.app')

@section('template')     
@endsection

@section('content')
    <div class="flex-center position-ref full-height container">    
    <div class="container">
        <div class="row">

            <div class="col-md-3 col-lateral-table">                
                <div class="col-md-12">
                <div class="card card-menu-table">
                    <div class="card-header">{{ __('form.WaiterIndex') }}</div>
                    <div class="card-body">
                        <div class="container services-table">
                            <div class="row">                                
                                <div class="col-md-12 table"></div>
                                <div class="col-md-12 bartender"></div>
                                <div class="col-md-12 orders"></div>
                                <div class="col-md-12 new-orders"></div>
                            </div>                                                  
                        </div>                  
                    </div>                            
                </div>
                </div>
                <div class="col-md-12">
                <div class="card card-menu-table">
                    <div class="card-header">{{ __('form.WaiterOptions') }}</div>
                    <div class="card-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    @include('layouts.options_page',['model'=>'Waiters'])                       
                                </div>
                            </div>                                                  
                        </div>                  
                    </div>                            
                </div>
                </div>
            </div>

            <div class="col-md-9">
                @include('layouts.alert')
                <div class="card">
                    <div class="card-header">{{ __('messages.Change Password') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('waiter.passwordrequest') }}">
                            @csrf
                            <input type="hidden" name="id" value="{{ \Auth::user()->id }}">
                            <input type="hidden" name="waiter_id" value="{{ $waiter->id }}">
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

@section('script')
<script type="text/javascript" src="{{ asset('js/entity/waiter.js') }}"></script>
    <script type="text/javascript">
    </script>
@endsection

@section('style')   
    <link href="{{ asset('css/custom/col_md_custom.css') }}" rel="stylesheet"> 
    <style type="text/css">
    </style>
@endsection
