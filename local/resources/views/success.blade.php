@extends('app')

@section('title', 'Forgot Password')
    
@section('content')
@if(Session::has('succ_msg'))
        <div class="alert alert-success">
                <ul>
                        <li>{!! Session::get('succ_msg') !!}</li>
                </ul>
        </div>
@endif
@endsection