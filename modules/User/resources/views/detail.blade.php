@extends('layouts.client')
@section('title', 'Trang chi tiết người dùng')
@section('content')
<h1>{{ trans('user::custom.title') }}:{{$id}}</h1>
@endsection