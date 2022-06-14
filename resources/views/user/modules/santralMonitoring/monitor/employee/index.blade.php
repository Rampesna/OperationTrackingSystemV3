@extends('user.layouts.masterBlank')
@section('title', 'Personel Takibi | ')

@section('subheader')

@endsection

@section('content')



@endsection

@section('customStyles')
    @include('user.modules.santralMonitoring.monitor.employee.components.style')
@endsection

@section('customScripts')
    @include('user.modules.santralMonitoring.monitor.employee.components.script')
@endsection
