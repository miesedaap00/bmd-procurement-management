<div class="mb-6">

    <div class="flex items-center gap-2 text-sm">

        <a
            href="{{ route('dashboard') }}"
            class="text-gray-500 hover:text-[#027333] transition"
        >
            Dashboard
        </a>

        @hasSection('breadcrumb')
            <span class="text-gray-400">
                /
            </span>

            <span class="text-[#252525] font-medium">
                @yield('breadcrumb')
            </span>
        @endif

    </div>

</div>