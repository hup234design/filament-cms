<x-app-layout>
    <div class="lg:flex">
        <div class="lg:flex-1">
            {{ $slot }}
        </div>
        <div class="min-h-80 mt-12 bg-gray-100 lg:w-96 lg:mt-0 lg:ml-12 lg:flex-shrink-0 ">
            {{-- --}}
        </div>
    </div>
</x-app-layout>
