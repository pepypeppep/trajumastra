@extends('layouts.guest.master')

@section('title', 'Beranda')

@section('content')
    @include('guest.home')

    @include('guest.news')

    @include('guest.peoples')

    @include('guest.data')

    @include('guest.about')

    @include('guest.transaction')

    @include('guest.newsletter')
@endsection
