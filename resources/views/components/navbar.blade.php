<header
    class="h-20
           bg-white
           border-b border-gray-200
           flex items-center justify-between
           px-6
           sticky top-0 z-30"
>

    <div class="flex items-center gap-4">

        <button
            id="sidebar-toggle"
            type="button"
            class="w-10 h-10
                flex items-center justify-center
                rounded-lg
                hover:bg-[#F2F2F2]
                transition"
        >
            <svg
                class="w-6 h-6 text-[#252525]"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M4 6h16M4 12h16M4 18h16"
                />
            </svg>
        </button>

        <div class="flex items-center gap-2">

            <span class="text-sm text-gray-500">
                Home
            </span>

            <span class="text-gray-300">
                /
            </span>

            <span class="text-sm font-medium text-[#252525]">
                Dashboard
            </span>

        </div>

    </div>


    <div class="relative">

        <button
            id="profile-toggle"
            type="button"
            class="flex items-center gap-3
                   px-3 py-2
                   rounded-lg
                   hover:bg-[#F2F2F2]
                   transition"
        >

            <div
                class="w-9 h-9
                       rounded-full
                       bg-[#027333]
                       text-white
                       flex items-center justify-center
                       font-semibold text-sm"
            >
                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
            </div>

            <div class="hidden sm:block text-left">

                <p class="text-sm font-medium text-[#252525]">
                    {{ Auth::user()->name }}
                </p>

                <p class="text-xs text-gray-500">
                    Admin
                </p>

            </div>

            <svg
                class="w-4 h-4 text-gray-500"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
            >

                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M19 9l-7 7-7-7"
                />

            </svg>

        </button>

        <div
            id="profile-menu"
            class="hidden absolute right-0 mt-2
                   w-52
                   bg-white
                   border border-gray-200
                   rounded-xl
                   shadow-lg
                   overflow-hidden"
        >

            <div class="px-4 py-3 border-b border-gray-100">

                <p class="text-sm font-medium text-[#252525]">
                    {{ Auth::user()->name }}
                </p>

                <p class="text-xs text-gray-500 truncate">
                    {{ Auth::user()->email }}
                </p>

            </div>


            <a
                href="#"
                class="block px-4 py-3
                       text-sm text-gray-700
                       hover:bg-[#F2F2F2]"
            >
                Profile
            </a>


            <form
                method="POST"
                action="{{ route('logout') }}"
            >

                @csrf

                <button
                    type="submit"
                    class="w-full text-left
                           px-4 py-3
                           text-sm text-red-600
                           hover:bg-red-50"
                >
                    Logout
                </button>

            </form>

        </div>

    </div>

</header>