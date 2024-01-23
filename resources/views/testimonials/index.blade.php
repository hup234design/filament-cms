<x-cms::layouts.app>

    <div class="prose max-w-none">
        <h1>Testimonials</h1>
    </div>

    <div class="mt-16 space-y-12">
        @foreach($testimonials as $testimonial)
            <div class="prose max-w-none">
                <blockquote>
                    <p>{{ nl2br($testimonial->content) }}</p>
                </blockquote>
                <p class="font-bold">
                    {{ $testimonial->name }}
                </p>
            </div>
        @endforeach
    </div>

    @if( $testimonials->hasPages() )
        <hr class="my-12">
        <div>
            {{ $testimonials->links() }}
        </div>
    @endif

</x-cms::layouts.app>
