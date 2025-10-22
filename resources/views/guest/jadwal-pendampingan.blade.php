<section class="relative" id="jadwal-pendampingan">
    <div class="container 2xl:max-w-[87.5rem] px-4 mx-auto">
        <div class="mx-auto text-center xl:max-w-3xl">
            <h1 class="mb-0 leading-normal capitalize">Jadwal Pendampingan</h1>
        </div>

        <!-- Swiper -->
        <div class="pb-6 swiper feedback-slider2-jadwal-pendampingan mt-5">
            <div class="swiper-wrapper">
                @foreach ($jadwalPenyuluhans as $jadwal)
                    <div class="swiper-slide">                        
                        <div class="p-5 rounded-md bg-gradient-to-b from-slate-100 to-white dark:from-zinc-800 dark:to-zinc-900"
                            data-aos="fade-up" data-aos-easing="linear">
                            <div class="mt-3">
                                {{-- START: Quota --}}
                                <span class="px-2.5 py-0.5 text-xs inline-block font-medium rounded border bg-sky-100 border-sky-200 text-sky-500 dark:bg-sky-500/20 dark:border-sky-500/20">{{ $jadwal->quota }} Kuota</span>
                                {{-- END: Quota --}}
                                {{-- START: Title --}}
                                <h6 class="mt-3 mb-2 text-lg truncate">
                                    <a target="_blank"
                                        href="#">{{ $jadwal->name }}
                                    </a>
                                </h6>
                                {{-- END: Title --}}

                                {{-- START: Description --}}
                                <p class="mb-3 text-slate-700 dark:text-zink-200 text-16">{{ $jadwal->description }}</p>
                                {{-- END: Description --}}

                                {{-- START: Meta --}}
                                <p class="mb-1 text-slate-500 dark:text-zink-200 text-9">Jenis:
                                    {{ $jadwal->jenisPenyuluhan->name }}</p>
                                <p class="mb-1 text-slate-500 dark:text-zink-200 text-9">Kategori:
                                    {{ $jadwal->kategori->name }}</p>
                                <p class="mb-1 text-slate-500 dark:text-zink-200 text-9">Penyuluh:
                                    {{ $jadwal->penyuluhs->pluck('user.name')->join(', ') }}</p>
                                {{-- END: Meta --}}

                                
                                
                                {{-- START: Date --}}
                                <div class="flex items-center gap-3 mt-3 text-slate-500 dark:text-zink-200">
                                    <span class="text-10 grow">
                                        {{ \Carbon\Carbon::parse($jadwal->start)->locale('id')->translatedFormat('j M Y') }}
                                    </span>
                                    <p>s/d</p>
                                    <span class="text-10 grow">
                                        {{ \Carbon\Carbon::parse($jadwal->end)->locale('id')->translatedFormat('j M Y') }}
                                    </span>
                                </div>
                                {{-- END: Date --}}

                                {{-- START: Button --}}
                                <div class="shrink-0 mt-2 text-center">
                                    <button type="button"
                                        data-id="{{ $jadwal->id }}"
                                        data-url-get ="{{ route('guest.jadwal-pendampingan.show', $jadwal->id) }}"
                                        class="btn-show-modal-jadwal px-2 py-1.5 text-xs text-white btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20">
                                        Selengkapnya
                                    </button>
                                </div>
                                {{-- End: Button --}}
                            </div>
                        </div><!--end-->
                    </div>
                @endforeach
            </div>
            <div class="mt-5 swiper-pagination"></div>
        </div>

    </div><!--end container-->
</section><!--end -->

{{-- START: Modal Jadwal --}}
@include('guest.partials.modal-show-jadwal-pendampingan')
{{-- END: Modal Jadwal --}}

@push('scripts')
    <!-- START: Swiper JS -->
    <script>
        new Swiper(".feedback-slider2-jadwal-pendampingan", {
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
    <!-- END: Swiper JS -->
    
    <script>
        $(document).on('click', '.btn-show-modal-jadwal', function(e) {
            e.preventDefault();

            // Trigger button to open modal
            $('#trigger-open-modal-show-jadwal').click();

            // Jadwal Id
            var jadwalId = $(this).data('id');
            // Url to get data
            var urlGetData = $(this).data('url-get');
            // Url to download attachment
            var urlDownloadAttachment = "{{ url('/jadwal-pendampingan/download-attachment') }}/" + jadwalId;
            
            // Send request to get jadwal data
            $.ajax({
                url: urlGetData, // Url for get data edit
                type: 'GET',
                success: function(response) {
                    // Populate modal fields with jadwal data
                    $('#name').text(response.name);
                    $('#description').html(response.description);
                    $('#jenis-penyuluhan').text(response.jenis_penyuluhan.name);
                    $('#kategori').text(response.kategori.name);
                    $('#quota').text(response.quota);
                    $('#penyuluh').text(response.penyuluhs.map(p => p.user.name).join(', '));
                    $('#start').text(new Date(response.start).toLocaleDateString('id-ID', {
                        day: 'numeric',
                        month: 'long',
                        year: 'numeric'
                    }));
                    $('#end').text(new Date(response.end).toLocaleDateString('id-ID', {
                        day: 'numeric',
                        month: 'long',
                        year: 'numeric'
                    }));
                    if (response.attachment_can_download == true) {
                        $('.not-have-attachment').hide();
                        $('.btn-download-attachment').show();
                        $('.btn-download-attachment').attr('href', urlDownloadAttachment);
                    } else {
                        $('.not-have-attachment').show();
                        $('.btn-download-attachment').hide();
                    }
                },
                error: function(xhr) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Gagal memuat data poklashar.',
                    });
                }
            });
        });
    </script>
@endpush