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

@push('scripts')
    <script>
        new Swiper(".feedback-slider2", {
            slidesPerView: 1,
            spaceBetween: 10,
            autoplay: {
                delay: 2500,
                disableOnInteraction: false,
            },
            loop: true,
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            breakpoints: {
                768: {
                    slidesPerView: 3,
                    spaceBetween: 40,
                },
                1024: {
                    slidesPerView: 4,
                    spaceBetween: 50,
                },
            },
        });
    </script>
@endpush
