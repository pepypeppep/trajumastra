<section class="relative py-24 xl:py-32" id="feedback">
    <div class="container 2xl:max-w-[87.5rem] px-4 mx-auto">
        <!-- Swiper -->
        <div class="pb-6 swiper feedback-slider">
            <div class="swiper-wrapper">
                @for ($i = 1; $i < 6; $i++)
                    <div class="">
                        <div class="p-5 text-center" data-aos="fade-up" data-aos-easing="linear">
                            @php
                                $arr = ['custom', 'green', 'orange', 'sky', 'yellow', 'red', 'purple', 'slate'];
                                $rand = array_rand($arr);
                                $class = $arr[$rand];
                            @endphp
                            <div class="mx-auto flex items-center justify-center rounded-full size-32 btn text-{{ $class }}-500 bg-{{ $class }}-100 hover:text-white hover:bg-{{ $class }}-600 focus:text-white focus:bg-{{ $class }}-600 focus:ring focus:ring-{{ $class }}-100 active:text-white active:bg-{{ $class }}-600 active:ring active:ring-{{ $class }}-100 cursor-pointer"
                                style="font-size: 4rem; display: flex; align-items: center; justify-content: center;">
                                10
                            </div>
                            <p class="mt-6 text-16">" Jumlah data XXX saat ini "</p>
                            <h6 class="mt-4 mb-1 text-15">Angela Ulligan</h6>
                        </div>
                    </div>
                @endfor
                {{-- @for ($i = 1; $i < 6; $i++)
                    <div class="">
                        <div class="p-5 text-center" data-aos="fade-up" data-aos-easing="linear">
                            <div class="mx-auto rounded-full size-20 bg-custom-500/10">
                                <img src="./assets/images/avatar-2.png" alt="" class="rounded-full size-20">
                            </div>
                            <p class="mt-6 text-16">" The best templates which is supported multiple programming
                                languages with beautiful templates. thank you for the valuable template. "</p>
                            <h6 class="mt-4 mb-1 text-15">Angela Ulligan</h6>
                            <div class="text-yellow-500">
                                <i class="ri-star-fill"></i>
                                <i class="ri-star-fill"></i>
                                <i class="ri-star-fill"></i>
                                <i class="ri-star-fill"></i>
                                <i class="ri-star-fill"></i>
                            </div>
                        </div>
                    </div>
                @endfor --}}
            </div>
        </div>
    </div><!--end container-->
</section><!--end -->
