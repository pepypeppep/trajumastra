@extends('layouts.guest.master')

@section('title', 'Beranda')

@section('content')
    @include('guest.home')

    {{-- @include('guest.feedback') --}}

    @include('guest.news')

    @include('guest.peoples')

    @include('guest.bbi')

    @include('guest.tpi')

    @include('guest.transaction')

    @include('guest.newsletter')
@endsection

@push('scripts')
    <!-- leaflet plugin -->
    <script src="{{ URL::asset('assets/libs/leaflet/leaflet.js') }}"></script>
    <script src="{{ URL::asset('assets/libs/leaflet/esri-leaflet.js') }}"></script>
    <script src="{{ URL::asset('assets/libs/leaflet/esri-leaflet-geocoder.js') }}"></script>
    <script src="{{ URL::asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>
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

    {{-- Start Pelaku Usaha --}}
    <script>
        getPelakuUsahaChart();

        //Pages Interaction
        function getPelakuUsahaChart() {
            $.ajax({
                url: "/",
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    pelakuUsahaChart(data)
                }
            });
        }

        function pelakuUsahaChart(data) {
            const maxDataValue = Math.max(...data.data);
            const yaxisMax = maxDataValue + 1;
            var options = {
                series: [{
                    name: 'Jumlah',
                    data: data.data
                }, ],
                chart: {
                    height: 350,
                    type: 'bar',
                    toolbar: {
                        show: false,
                    }
                },
                plotOptions: {
                    bar: {
                        borderRadius: 10,
                        borderRadiusApplication: 'end',
                        borderRadiusWhenStacked: 'last',
                    }
                },
                dataLabels: {
                    enabled: true,
                    offsetY: -20,
                    style: {
                        fontSize: '12px',
                        colors: ["#304758"]
                    }
                },

                xaxis: {
                    categories: data.categories,
                },
                yaxis: {
                    title: {
                        text: 'Jumlah'
                    },
                    // tickAmount: 1,
                    type: 'integer',
                    min: 0,
                    max: yaxisMax,
                    labels: {
                        formatter: function(value) {
                            return parseInt(value);
                        }
                    }
                },
                stroke: {
                    show: true,
                    width: 4,
                    colors: ['transparent']
                },
                colors: ['#5895f7']
            };

            var chart = new ApexCharts(document.querySelector("#pagesInteraction"), options);
            chart.render();
        }
    </script>
    {{-- End Pelaku Usaha --}}

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
                scrollWheelZoom: false,
                // doubleClickZoom: false
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
                var customPopupContent = `@include('guest.partials.bbi-tooltip')`
                var marker = L.marker([{{ $bbi->latitude }}, {{ $bbi->longitude }}]).addTo(mapBbi).bindPopup(
                    customPopupContent);
                marker._id = "marker-bbi-{{ $bbi->id }}";
                bbiMarkers["{{ $bbi->id }}"] = marker;
            @endforeach

            mapBbi.on('popupclose', function() {
                mapBbi.setView([lat, lng], 10);
            });
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
                scrollWheelZoom: false,
                // doubleClickZoom: false
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
                var customPopupContent = `@include('guest.partials.tpi-tooltip')`
                var marker = L.marker([{{ $tpi->latitude }}, {{ $tpi->longitude }}]).addTo(mapTpi).bindPopup(
                    customPopupContent);
                marker._id = "marker-tpi-{{ $tpi->id }}";
                tpiMarkers["{{ $tpi->id }}"] = marker;
            @endforeach

            mapTpi.on('popupclose', function() {
                mapTpi.setView([lat, lng], 10);
            });
        }

        initMapTpi();

        $('.tpi-row').on('click', function() {
            var id = $(this).data('id');
            tpiMarkers[id].openPopup();
        });
    </script>
    {{-- End TPI --}}
@endpush
