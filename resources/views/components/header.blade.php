<header class="py-8 bg-gray-600">
    <div class="max-w-7xl mx-auto px-8 flex justify-between items-center">
        <div class="flex-shrink-0">
            <a href="{{ route('pages.home') }}" class="hover:cursor-pointer text-3xl font-bold text-white leading-none">
                {{ config('app.name') }}
            </a>
        </div>
            <div class="inline-block divide-y">
            <ul class="pb-4 flex items-center justify-end divide-x-2 divide-gray-100">
                <li class="leading-none px-4">
                    <a href="{{ route('pages.home') }}" class="hover:cursor-pointer text-gray-100 font-semibold text-lg leading-none">
                        Home
                    </a>
                </li>
                @foreach( \Hup234design\FilamentCms\Models\Page::where('is_home',false)->visible()->pluck('title','slug') as $slug=>$title)
                    <li class="leading-none px-4">
                        <a href="{{ route('pages.page', $slug) }}" class="hover:cursor-pointer text-gray-100 font-semibold text-lg leading-none">
                            {{ $title }}
                        </a>
                    </li>
                @endforeach
            </ul>
            <ul class="pt-4 flex items-center justify-end divide-x-2 divide-gray-100">
                <li class="leading-none px-4">
                    <a href="{{ route('services.index') }}" class="hover:cursor-pointer text-gray-100 font-semibold text-lg leading-none">
                        Services
                    </a>
                </li>
                <li class="leading-none px-4">
                    <a href="{{ route('testimonials.index') }}" class="hover:cursor-pointer text-gray-100 font-semibold text-lg leading-none">
                        Testimonials
                    </a>
                </li>
                <li class="leading-none px-4">
                    <a href="{{ route('posts.index') }}" class="hover:cursor-pointer text-gray-100 font-semibold text-lg leading-none">
                        Posts
                    </a>
                </li>
            </ul>
        </div>
    </div>



</header>
