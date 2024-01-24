<footer class="py-8 bg-gray-800 flex flex-col items-center justify-center">
    <a href="{{ route('pages.home') }}" class="hover:cursor-pointer text-xl font-bold text-white leading-none">
        {{ config('app.name') }}
    </a>
    <div class="mt-8 text-center text-sm text-gray-200">
        Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
    </div>
</footer>
