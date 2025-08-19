@extends('layouts.guest.master')

@section('title', 'Beranda')

@section('content')
    @include('guest.home')

    @include('guest.news')

    @include('guest.peoples')

    @include('guest.bbi')

    @include('guest.tpi')

    @include('guest.about')

    @include('guest.transaction')

    @include('guest.newsletter')
@endsection

@push('scripts')
    <!-- leaflet plugin -->
    <script src="{{ URL::asset('assets/libs/leaflet/leaflet.js') }}"></script>
    <script src="{{ URL::asset('assets/libs/leaflet/esri-leaflet.js') }}"></script>
    <script src="{{ URL::asset('assets/libs/leaflet/esri-leaflet-geocoder.js') }}"></script>
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

    {{-- Start BBI --}}
    <script>
        let mapBbi = null;
        var bbiMarkers = {};

        function initMapBbi() {
            var lat = -7.868823;
            var lng = 110.341187;

            mapBbi = L.map('map-bbi', {
                center: [lat, lng],
                zoom: 10,
                doubleClickZoom: false
            });

            const tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
            }).addTo(mapBbi);

            delete L.Icon.Default.prototype._getIconUrl;

            L.Icon.Default.mergeOptions({
                iconUrl: 'https://unpkg.com/leaflet@1.9.4/dist/images/marker-icon.png',
                iconRetinaUrl: 'https://unpkg.com/leaflet@1.9.4/dist/images/marker-icon-2x.png',
                shadowUrl: 'https://unpkg.com/leaflet@1.9.4/dist/images/marker-shadow.png',
            });
            @foreach ($bbis as $bbi)
                var customPopupContent = `<div class="card shadow-none">
                        <div class="!px-6 card-body flex flex-col h-full">
                            <div class="flex items-center justify-center mx-auto text-xl bg-white rounded-full shadow size-16 dark:bg-zink-600 -mt-14">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" data-lucide="map-pin" class="lucide lucide-map-pin text-sky-500 fill-sky-100 dark:fill-sky-500/20"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                            </div>
                            <div class="mt-5 text-center">
                                <h6 class="mb-2 text-16">{{ $bbi->name }}</h6>
                                <p class="mb-5 text-slate-500 dark:text-zink-200">{{ $bbi->address }}<br>{{ $bbi->dusun }}, {{ $bbi->kalurahan->name }}, {{ $bbi->kalurahan->kecamatan->name }}, {{ $bbi->kalurahan->kecamatan->kabupaten->name }}</p>

                            </div>
                            <div class="mt-auto text-center">
                                <a href="#!" class="transition-all duration-200 ease-linear text-custom-500 hover:text-custom-800 dark:hover:text-custom-400">({{ $bbi->latitude }}, {{ $bbi->longitude }})</a>
                            </div>
                        </div>
                    </div>`;
                var marker = L.marker([{{ $bbi->latitude }}, {{ $bbi->longitude }}]).addTo(mapBbi).bindPopup(
                    customPopupContent);
                marker._id = "marker-bbi-{{ $bbi->id }}";
                bbiMarkers["{{ $bbi->id }}"] = marker;
            @endforeach
        }

        initMapBbi();

        $('.bbi-row').on('click', function() {
            var id = $(this).data('id');
            bbiMarkers[id].openPopup();
        });
    </script>
    {{-- End BBI --}}

    {{-- Start TPI --}}
    <script>
        let mapTpi = null;
        var tpiMarkers = {};

        function initMapTpi() {
            var lat = -7.868823;
            var lng = 110.341187;

            mapTpi = L.map('map-tpi', {
                center: [lat, lng],
                zoom: 10,
                doubleClickZoom: false
            });

            const tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
            }).addTo(mapTpi);

            delete L.Icon.Default.prototype._getIconUrl;

            L.Icon.Default.mergeOptions({
                iconUrl: 'https://unpkg.com/leaflet@1.9.4/dist/images/marker-icon.png',
                iconRetinaUrl: 'https://unpkg.com/leaflet@1.9.4/dist/images/marker-icon-2x.png',
                shadowUrl: 'https://unpkg.com/leaflet@1.9.4/dist/images/marker-shadow.png',
            });
            @foreach ($tpis as $tpi)
                var customPopupContent = `<div class="card shadow-none">
                        <div class="!px-6 card-body flex flex-col h-full">
                            <div class="flex items-center justify-center mx-auto text-xl bg-white rounded-full shadow size-16 dark:bg-zink-600 -mt-14">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" data-lucide="map-pin" class="lucide lucide-map-pin text-sky-500 fill-sky-100 dark:fill-sky-500/20"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                            </div>
                            <div class="mt-5 text-center">
                                <h6 class="mb-2 text-16">{{ $tpi->name }}</h6>
                                <p class="mb-5 text-slate-500 dark:text-zink-200">{{ $tpi->address }}<br>{{ $tpi->dusun }}, {{ $tpi->kalurahan->name }}, {{ $tpi->kalurahan->kecamatan->name }}, {{ $tpi->kalurahan->kecamatan->kabupaten->name }}</p>

                            </div>
                            <div class="mt-auto text-center">
                                <a href="#!" class="transition-all duration-200 ease-linear text-custom-500 hover:text-custom-800 dark:hover:text-custom-400">({{ $tpi->latitude }}, {{ $tpi->longitude }})</a>
                            </div>
                        </div>
                    </div>`;
                var marker = L.marker([{{ $tpi->latitude }}, {{ $tpi->longitude }}]).addTo(mapTpi).bindPopup(
                    customPopupContent);
                marker._id = "marker-tpi-{{ $tpi->id }}";
                tpiMarkers["{{ $tpi->id }}"] = marker;
            @endforeach
        }

        initMapTpi();

        $('.tpi-row').on('click', function() {
            var id = $(this).data('id');
            tpiMarkers[id].openPopup();
        });
    </script>
    {{-- End TPI --}}
@endpush
