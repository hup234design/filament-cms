<header class="px-8  py-12 bg-gray-600">
    <div class="flex justify-between items-center">
        <div class="flex-shrink-0">
            <a href="{{ route('pages.home') }}" class="hover:cursor-pointer text-3xl font-bold text-white leading-none">
                {{ config('app.name') }}
            </a>
        </div>
        <div class="inline-block">
            @if($menus['primary'])
                <ul class="pb-4 flex items-center justify-end divide-x divide-gray-100">
                    @foreach($menus['primary'] as $item)
                        <li class="leading-none px-4">
                            @if($item['route'])
                                <a href="{{ route($item['route'], $item['slug']) }}" class="hover:cursor-pointer text-gray-100 font-semibold text-lg leading-none">
                                    {{ $item['title'] }}
                                </a>
                            @else
                                <a href="javascript: void;" class="hover:cursor-pointer text-gray-100 font-semibold text-lg leading-none">
                                    {{ $item['title'] }}
                                </a>
                            @endif
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
</header>
