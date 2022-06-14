@extends('user.layouts.masterBlank')
@section('title', 'Sıralamalar | ')

@section('subheader')

@endsection

@section('content')

    <div class="row" style="margin-top: -120px" id="achievementsRow"></div>

@endsection

@section('customStyles')
    @include('user.modules.santralMonitoring.monitor.achievement.components.style')
@endsection

@section('customScripts')
    @include('user.modules.santralMonitoring.monitor.achievement.components.script')
@endsection
