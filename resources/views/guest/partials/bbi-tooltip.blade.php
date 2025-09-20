<div class="card shadow-none">
    <div class="!px-6 card-body flex flex-col h-full">
        <div
            class="flex items-center justify-center mx-auto text-xl bg-white rounded-full shadow size-16 dark:bg-zink-600 -mt-14">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                data-lucide="map-pin" class="lucide lucide-map-pin text-sky-500 fill-sky-100 dark:fill-sky-500/20">
                <path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"></path>
                <circle cx="12" cy="10" r="3"></circle>
            </svg>
        </div>
        <div class="mt-5 text-center">
            <h6 class="mb-2 text-16">{{ $bbi->name }}</h6>
            <p class="mb-1 text-slate-500 dark:text-zink-200">{{ $bbi->phone }}</p>
            <p class="mb-5 text-slate-500 dark:text-zink-200">{{ $bbi->address }}<br>{{ $bbi->dusun }},
                {{ $bbi->kalurahan->name }}, {{ $bbi->kalurahan->kecamatan->name }},
                {{ $bbi->kalurahan->kecamatan->kabupaten->name }}</p>
        </div>
        <div class="mt-auto text-center">
            <a href="https://www.google.com/maps/search/?api=1&query={{ $bbi->latitude }},{{ $bbi->longitude }}"
                class="transition-all duration-200 ease-linear text-custom-500 hover:text-custom-800 dark:hover:text-custom-400"
                target="_blank" rel="noopener noreferrer">({{ $bbi->latitude }},{{ $bbi->longitude }})</a>
        </div>
        <div class="mt-3 text-center">
            <div data-simplebar class="flex flex-col gap-4" style="height: 230px;">
                <div class="flex flex-col gap-3">
                    @foreach ($bbi->stok_ikans as $stok)
                        <div class="border rounded-md border-slate-200 dark:border-zink-500">
                            <div class="flex flex-wrap items-center gap-3 p-2">
                                <div class="rounded-full size-10 shrink-0">
                                    <img src="{{ $stok->jenis_ikan->imageUrl }}" alt=""
                                        class="h-10 rounded-full">
                                </div>
                                <div class="grow">
                                    <h6 class="mb-1"><a href="#!">{{ $stok->jenis_ikan->name }}</a></h6>
                                    <p class="text-slate-500 dark:text-zink-200"
                                        style="margin-top: 0;margin-bottom: 0;">Stok: {{ $stok->stok ?? 0 }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
