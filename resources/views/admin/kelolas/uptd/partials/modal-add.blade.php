<div id="modal-add" modal-center
    class="fixed flex flex-col hidden transition-all duration-300 ease-in-out left-2/4 z-drawer -translate-x-2/4 -translate-y-2/4 show">
    <div class="w-screen md:w-[40rem] bg-white shadow rounded-md dark:bg-zink-600 flex flex-col h-full">
        <div class="flex items-center justify-between p-4 border-b border-slate-200 dark:border-zink-500">
            <h5 class="text-16">Tambah UPTD Baru</h5>
            <button data-modal-close="modal-add"
                class="transition-all duration-200 ease-linear text-slate-500 hover:text-red-500 dark:text-zink-200 dark:hover:text-red-500"><i
                    data-lucide="x" class="size-5"></i></button>
        </div>
        <form action="{{ route('kelola.uptd.store') }}" method="POST">
            @csrf
            {{-- Start Modal Body --}}
            <div class="max-h-[calc(theme('height.screen')_-_180px)] p-4 overflow-y-auto">
                {{-- Nama --}}
                <div class="">
                    <label for="" class="inline-block mb-2 text-base font-medium">Nama <strong
                            class="text-red-500">*</strong></label>
                    <input type="text" id="name" name="name"
                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                        placeholder="Masukkan nama" required>
                </div>
                {{-- Jenis Ikan --}}
                <div class="mt-3">
                    <label for="" class="inline-block mb-2 text-base font-medium">Jenis Ikan <strong
                            class="text-red-500">*</strong></label>
                    <select
                        class="select2 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                        name="jenis_ikan_id[]" id="jenis_ikan_id" multiple>
                        @foreach ($jenis_ikans as $jenis_ikan)
                            <option value="{{ $jenis_ikan->id }}">{{ $jenis_ikan->name }}</option>
                        @endforeach
                    </select>
                </div>
                {{-- Kalurahan --}}
                <div class="mt-3">
                    <label for="" class="inline-block mb-2 text-base font-medium">Kalurahan <strong
                            class="text-red-500">*</strong></label>
                    <select
                        class="select2 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                        name="kalurahan_id" id="kalurahan_id">
                        <option value=""></option>
                        @foreach ($kals as $kal)
                            <option value="{{ $kal->id }}">
                                {{ $kal->name . ' - ' . $kal->kecamatan->name . ' - ' . $kal->kecamatan->kabupaten->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                {{-- Dusun --}}
                <div class="mt-3">
                    <label for="" class="inline-block mb-2 text-base font-medium">Dusun <strong
                            class="text-red-500">*</strong></label>
                    <input type="text" id="dusun" name="dusun"
                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                        placeholder="Masukkan dusun" required>
                </div>
                {{-- Alamat --}}
                <div class="mt-3">
                    <label for="" class="inline-block mb-2 text-base font-medium">Alamat <strong
                            class="text-red-500">*</strong></label>
                    <input type="text" id="address" name="address"
                        class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                        placeholder="Masukkan alamat" required>
                </div>
                <div class="grid grid-cols-2 gap-4 mb-1 mt-3">
                    <div class="col-span">
                        {{-- Latitude --}}
                        <div class="">
                            <label for="" class="inline-block mb-2 text-base font-medium">Latitude <strong
                                    class="text-red-500">*</strong></label>
                            <input type="text" id="latitude" name="latitude"
                                class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                placeholder="Masukkan latitude" required>
                        </div>
                    </div>
                    <div class="col-span">
                        {{-- Longitude --}}
                        <div class="">
                            <label for="" class="inline-block mb-2 text-base font-medium">Longitude <strong
                                    class="text-red-500">*</strong></label>
                            <input type="text" id="longitude" name="longitude"
                                class="form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                                placeholder="Masukkan longitude" required>
                        </div>
                    </div>
                </div>
                <small class="text-red-500">*Klik 2 kali untuk menambahkan lokasi</small>
                <div class="leaflet-map w-full h-[300px]" id="map-add"></div>
            </div>
            {{-- End Modal Body --}}
            {{-- Start Modal Footer --}}
            <div class="flex items-center justify-between p-4 mt-auto border-t border-slate-200 dark:border-zink-500">
                <button type="submit"
                    class="btn bg-custom-500 text-white hover:bg-custom-600 focus:bg-custom-600 w-full">
                    <i class="ri-save-line"></i> Simpan
                </button>
            </div>
            {{-- End Modal Footer --}}
        </form>
    </div>
</div>
@push('scripts')
    <script>
        let mapAdd;

        function initMapAdd() {
            var theMarker = {};
            var latitude = -7.868823;
            var longitude = 110.341187;
            mapAdd = L.map('map-add', {
                center: [latitude, longitude],
                zoom: 11,
                doubleClickZoom: false
            });

            const tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
            }).addTo(mapAdd);

            delete L.Icon.Default.prototype._getIconUrl;

            L.Icon.Default.mergeOptions({
                iconUrl: 'https://unpkg.com/leaflet@1.9.4/dist/images/marker-icon.png',
                iconRetinaUrl: 'https://unpkg.com/leaflet@1.9.4/dist/images/marker-icon-2x.png',
                shadowUrl: 'https://unpkg.com/leaflet@1.9.4/dist/images/marker-shadow.png',
            });

            theMarker = L.marker([latitude, longitude]).addTo(mapAdd);
            // var searchControl = L.esri.Geocoding.geosearch().addTo(map);
            const searchControl = L.esri.Geocoding.geosearch({
                position: "topright",
                placeholder: "Masukkan alamat atau nama lokasi",
                useMapBounds: false,
            }).addTo(mapAdd);

            var results = L.layerGroup().addTo(mapAdd);

            // searchControl.on('results', function(data) {
            //     results.clearLayers();
            //     for (var i = data.results.length - 1; i >= 0; i--) {
            //         results.addLayer(L.marker(data.results[i].latlng));
            //     }
            // });

            mapAdd.on('dblclick',
                function(e) {
                    var coord = e.latlng.toString().split(',');
                    var lat = coord[0].split('(');
                    var lng = coord[1].split(')');
                    if (theMarker != undefined || results != undefined) {
                        mapAdd.removeLayer(theMarker);
                        mapAdd.removeLayer(results);
                    };

                    //Add a marker to show where you clicked.
                    theMarker = L.marker([lat[1], lng[0]]).addTo(mapAdd)
                        .bindPopup('' + coord + '')
                        .openPopup();
                    document.getElementById("latitude").value = lat[1];
                    document.getElementById("longitude").value = lng[0];
                });
        }
        $(document).ready(function() {
            initMapAdd();
        });
    </script>
@endpush
