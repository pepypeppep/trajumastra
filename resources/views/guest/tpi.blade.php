<section class="relative py-24 xl:py-32" id="tpi">
    <div class="absolute bottom-0 right-0 size-64 bg-custom-500/10 blur-3xl"></div>
    <div class="container 2xl:max-w-[87.5rem] px-4 mx-auto">
        <div class="grid items-center grid-cols-1 gap-6 mt-20 lg:grid-cols-12">
            <div class="relative lg:col-span-6">
                <p class="mb-2 text-purple-500 text-15" data-aos="fade-right" data-aos-delay="300">Data</p>
                <h1 class="mb-3 leading-normal capitalize" data-aos="fade-right" data-aos-delay="400">TPI (Tempat
                    Pelelangan Ikan)</h1>
                <p class="mb-5 text-lg text-slate-500 dark:text-zinc-400" data-aos="fade-right" data-aos-delay="500">
                    Lokasi resmi yang disediakan untuk melakukan transaksi jual beli hasil tangkapan ikan, biasanya
                    dikelola oleh pemerintah daerah, koperasi nelayan, atau pihak berwenang di bidang perikanan.</p>
                <table id="rowBorder" class="hover-group dataTables" style="width:100%" data-aos="fade-right"
                    data-aos-delay="600">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Alamat</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200 dark:divide-zink-500">
                        @foreach ($tpis as $tpi)
                            <tr data-id={{ $tpi->id }} title="Klik untuk melihat data TPI {{ $tpi->name }}"
                                class="tpi-row cursor-pointer hover:bg-slate-200 dark:hover:bg-slate-100">
                                <td>{{ $tpi->name }}</td>
                                <td>{{ $tpi->address }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div><!--end col-->
            <div class="ml-auto lg:col-span-12 lg:col-start-8 w-full">
                <p class="mb-2 text-purple-500 text-15" data-aos="fade-left" data-aos-delay="300">Peta Sebaran</p>
                <p class="mb-5 text-lg text-slate-500 dark:text-zinc-400" data-aos="fade-left" data-aos-delay="500">
                    Berikut ini adalah peta sebaran data TPI (Tempat Pelelangan Ikan)</p>
                <div class="leaflet-map w-full" style="height: 35rem;" id="map-tpi"></div>
            </div><!--end col-->
        </div><!--end grid-->
    </div><!--end container-->
</section><!--end -->
