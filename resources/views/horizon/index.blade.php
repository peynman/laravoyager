@extends('voyager::master')

@section('page_title', 'Horizon')

@section('content')
    <div class="frame-media">
        <iframe src="{{ url('/horizon') }}"></iframe>
    </div>
@stop

@section('css')
    <style>
        .frame-media {
            position: relative;
            padding-bottom: 100%;
            padding-top: 30px;
            height: 0;
            overflow: hidden;
        }
        .frame-media iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: 0;
        }
    </style>
@stop

@section('javascript')
@stop
