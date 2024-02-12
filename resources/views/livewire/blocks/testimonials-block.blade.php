<div>

    @if(($blockData['selection'] ?? 'single') == 'single')
        <div class="bg-white">
            <div class="container py-24 text-center">
                <blockquote class="text-xl font-light">
                    {!! nl2br($testimonial->content) !!}
                </blockquote>
            </div>
        </div>
    @else
        <div class="glide">
            <div class="glide__track" data-glide-el="track">
                <ul class="glide__slides">
                    @foreach( $testimonials as $testimonial)
                        <li class="glide__slide">
                            <div class="bg-white py-16 px-32 text-center">
                                <blockquote class="text-xl font-light">
                                    {!! nl2br($testimonial->content) !!}
                                </blockquote>
                                <p class="text-xl font-bold mt-8">{{ $testimonial->name }}</p>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="glide__arrows" data-glide-el="controls">
                <button class="glide__arrow  glide__arrow--left" data-glide-dir="<" class="bg-transparent shadow-none">
                    <x-heroicon-s-chevron-left class="w-8 h-8 text-black" />
                </button>
                <button class="glide__arrow glide__arrow--right" data-glide-dir=">">
                    <x-heroicon-s-chevron-right class="w-8 h-8 text-black" />
                </button>
            </div>
        </div>
    @endif
</div>
