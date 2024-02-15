<x-app-layout>

{{--    <x-page-header :header="$page->header" :title="$page->title" />--}}

        @section('header')
        <div
            x-data="{swiper: null}"
            x-init="swiper = new Swiper($refs.container, {
                autoplay: {
                    delay: 10000,
                },
                slidesPerView: 1,
                spaceBetween: 0,
                loop: true,
                effect: 'slide',
                navigation: {
                    enabled: true,
                    nextEl: '.swiper-next',
                    prevEl: '.swiper-previous',
                }
             })"
            class="relative overflow-hidden"
        >
            <div class="swiper-container w-full" x-ref="container">
                <div class="swiper-wrapper">
                    <div class="swiper-slide max-w-full h-[400px] bg-red-200 flex justify-center items-center">
                        <span class="text-3xl font-bold">SLIDE ONE</span>
                    </div>
                    <div class="swiper-slide max-w-full h-[400px] bg-blue-200 flex justify-center items-center">
                        <span class="text-3xl font-bold">SLIDE TWO</span>
                    </div>
                    <div class="swiper-slide max-w-full h-[400px] bg-green-200 flex justify-center items-center">
                        <span class="text-3xl font-bold">SLIDE THREE</span>
                    </div>
                </div>
{{--                <div class="swiper-button-next mt-16"></div>--}}
{{--                <div class="swiper-button-prev mt-16"></div>--}}
            </div>

            <x-heroicon-s-arrow-left-circle class="swiper-previous absolute top-1/2 left-0 h-12 w-12 ml-2 rounded-full z-50 -translate-y-1/2" />
            <x-heroicon-s-arrow-right-circle class="swiper-next absolute top-1/2 right-0 h-12 w-12 m2-2 rounded-full z-50 -translate-y-1/2" />

            <div class="absolute inset-x-0 bottom-0 flex items-center justify-center gap-8 mt-8 z-50">
                <div class="h-16 w-40 bg-red-400 border border-black" x-on:click="swiper.slideTo(0,500,false)"></div>
                <div class="h-16 w-40 bg-blue-400 border border-black" x-on:click="swiper.slideTo(1,500,false)"></div>
                <div class="h-16 w-40 bg-green-400 border border-black" x-on:click="swiper.slideTo(2,500,false)"></div>
            </div>
        </div>
        @endsection

    <div class="prose max-w-none mb-202">
        <h1>{{ $page->title }}</h1>
        @if( $page->content ?? null )
            {!! tiptap_converter()->asHTML($page->content) !!}
        @endif
    </div>
</x-app-layout>
