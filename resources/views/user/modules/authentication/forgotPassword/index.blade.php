@extends('user.layouts.auth')
@section('title', 'Şifremi Unuttum | ')

@section('content')



@endsection

@section('customStyles')
    @include('user.modules.auth.forgotPassword.components.style')
@endsection

@section('customScripts')
    @include('user.modules.auth.forgotPassword.components.script')
@endsection
