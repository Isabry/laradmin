@extends('laradmin::layouts.default')

@section('styles')
@stop

@section('content')

@include('laradmin::users.list_users')

{{-- 
{!! $users !!}

<hr/>

@foreach($users as $user)
	{{ $user }}
@endforeach
--}}
@stop

@section('scripts')
@stop
