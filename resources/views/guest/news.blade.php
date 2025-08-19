<section class="relative py-24 xl:py-32" id="berita">
    <div class="container 2xl:max-w-[87.5rem] px-4 mx-auto">
        <div class="mx-auto text-center xl:max-w-3xl">
            <h1 class="mb-0 leading-normal capitalize">Berita Terkini</h1>
        </div>
        {{-- <div class="grid grid-cols-1 gap-5 mt-12 md:grid-cols-2 xl:grid-cols-4">
            @foreach ($news as $nw)
                <div class="p-5 rounded-md bg-gradient-to-b from-slate-100 to-white dark:from-zinc-800 dark:to-zinc-900"
                    data-aos="fade-up" data-aos-easing="linear">
                    <img src="https://dkp.bantulkab.go.id/storage/dkp/{{ $nw->image }}" alt=""
                        class="mx-auto w-full h-52">
                    <div class="mt-3">
                        <p class="mb-3"><i data-lucide="eye"
                                class="inline-block text-yellow-500 align-middle size-4 ltr:mr-1 rtl:ml-1"></i>
                            ({{ $nw->stats }})
                        </p>
                        <h5><a href="#!">{{ $nw->title_id }}</a></h5>

                        <div class="flex items-center gap-3 mt-3">
                            <span class="text-16 grow">
                                {{ \Carbon\Carbon::parse($nw->published_at)->locale('id_ID')->translatedFormat('j F Y') }}
                            </span>
                            <div class="shrink-0">
                                <button type="button"
                                    class="px-2 py-1.5 text-xs text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20">Selengkapnya</button>
                            </div>
                        </div>
                    </div>
                </div><!--end-->
            @endforeach
        </div><!--end grid--> --}}

        <!-- Swiper -->
        <div class="pb-6 swiper feedback-slider2 mt-5">
            <div class="swiper-wrapper">
                @foreach ($news as $nw)
                    <div class="swiper-slide">
                        <div class="p-5 rounded-md bg-gradient-to-b from-slate-100 to-white dark:from-zinc-800 dark:to-zinc-900"
                            data-aos="fade-up" data-aos-easing="linear">
                            <img src="https://dkp.bantulkab.go.id/storage/dkp/{{ $nw->image }}" alt=""
                                class="mx-auto w-full h-52">
                            <div class="mt-3">
                                <p class="mb-3"><i data-lucide="eye"
                                        class="inline-block text-yellow-500 align-middle size-4 ltr:mr-1 rtl:ml-1"></i>
                                    ({{ $nw->stats }})
                                </p>
                                <h5><a target="_blank"
                                        href="https://dkp.bantulkab.go.id/news/{{ $nw->slug }}">{{ $nw->title_id }}</a>
                                </h5>

                                <div class="flex items-center gap-3 mt-3">
                                    <span class="text-16 grow">
                                        {{ \Carbon\Carbon::parse($nw->published_at)->locale('id_ID')->translatedFormat('j F Y') }}
                                    </span>
                                    <div class="shrink-0">
                                        <button type="button"
                                            onclick="window.open('https://dkp.bantulkab.go.id/news/{{ $nw->slug }}', '_blank')"
                                            class="px-2 py-1.5 text-xs text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20">Selengkapnya</button>
                                    </div>
                                </div>
                            </div>
                        </div><!--end-->
                    </div>
                @endforeach
            </div>
            <div class="mt-5 swiper-pagination"></div>
        </div>

    </div><!--end container-->
</section><!--end -->
