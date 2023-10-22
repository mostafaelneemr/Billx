@extends('errors::illustrated-layout')

@section('code', '500')
@section('title', __('Error'))

@section('image')
    <div style="background-image: url({{ asset('assets/media/error/bg6.jpg') }});" class="absolute pin bg-cover bg-no-repeat md:bg-left lg:bg-center">
    </div>
@endsection

@section('message', __('Whoops, something went wrong on our servers.'))
