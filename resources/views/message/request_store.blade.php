@extends('layouts.app_request')

@section('template')
    
@endsection

@section('content')


@endsection

@section('style')
<style type="text/css">
    body{
        background-color: {{ json_decode($store->label,true)['table']['colorbody'] }};
    }
</style>
@endsection