@extends('layouts.app')

@section('content')


<!------ Include the above in your HEAD tag ---------->

<link href="{{ asset('css/style.css') }}" rel="stylesheet">
<link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css'><link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.2/css/font-awesome.min.css'>

<message-component :user="{{json_encode(Auth::User()) }}"></message-component>

@endsection
