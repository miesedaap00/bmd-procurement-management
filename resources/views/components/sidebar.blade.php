<aside
    id="sidebar"
    class="fixed top-0 left-0 z-40
           w-64 h-screen
           bg-[#025928]
           text-white
           flex flex-col
           transition-transform duration-300"
>

    {{-- Logo --}}
    <div class="h-20 flex items-center px-6 border-b border-white/10">

        <div
            class="w-10 h-10 rounded-lg
                   bg-[#F2D027]
                   flex items-center justify-center
                   mr-3"
        >
            <span class="text-[#025928] font-bold">
                PM
            </span>
        </div>

        <div>

            <h1 class="font-bold text-sm">
                Procurement
            </h1>

            <p class="text-xs text-white/60">
                Management System
            </p>

        </div>

    </div>


    {{-- Navigation --}}
    <nav class="flex-1 px-4 py-6 space-y-2">

        {{-- Dashboard --}}
        <a
            href="{{ route('dashboard') }}"
            class="flex items-center gap-3
                   px-4 py-3
                   rounded-lg
                   text-sm font-medium
                   bg-white/10
                   hover:bg-white/15
                   transition"
        >

            <svg
                class="w-5 h-5"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0h6"
                />
            </svg>

            <span>Dashboard</span>

        </a>


        {{-- Purchase Order --}}
        <a
            href="#"
            class="flex items-center gap-3
                   px-4 py-3
                   rounded-lg
                   text-sm font-medium
                   hover:bg-white/10
                   transition"
        >

            <span class="w-5 text-center">
                📄
            </span>

            <span>Purchase Order</span>

        </a>


        {{-- Quotation --}}
        <a
            href="#"
            class="flex items-center gap-3
                   px-4 py-3
                   rounded-lg
                   text-sm font-medium
                   hover:bg-white/10
                   transition"
        >

            <span class="w-5 text-center">
                📋
            </span>

            <span>Quotation</span>

        </a>


        {{-- Goods Transfer --}}
        <a
            href="#"
            class="flex items-center gap-3
                   px-4 py-3
                   rounded-lg
                   text-sm font-medium
                   hover:bg-white/10
                   transition"
        >

            <span class="w-5 text-center">
                📦
            </span>

            <span>Goods Transfer</span>

        </a>


        {{-- Invoice --}}
        <a
            href="#"
            class="flex items-center gap-3
                   px-4 py-3
                   rounded-lg
                   text-sm font-medium
                   hover:bg-white/10
                   transition"
        >

            <span class="w-5 text-center">
                🧾
            </span>

            <span>Invoice</span>

        </a>


        {{-- Receipt --}}
        <a
            href="#"
            class="flex items-center gap-3
                   px-4 py-3
                   rounded-lg
                   text-sm font-medium
                   hover:bg-white/10
                   transition"
        >

            <span class="w-5 text-center">
                📝
            </span>

            <span>Receipt</span>

        </a>

    </nav>


    {{-- Footer --}}
    <div class="p-4 border-t border-white/10">

        <p class="text-xs text-white/50 text-center">
            Procurement Management
        </p>

    </div>

</aside>