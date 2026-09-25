<aside
    id="sidebar"
    data-closed="false"
    class="fixed top-0 left-0 z-40
           w-64 h-screen
           bg-[#025928]
           text-white
           flex flex-col
           transition-transform duration-300"
>

    <div class="h-20 flex items-center px-6 border-b border-white/10">

        <div
            class="w-12 h-12 rounded-lg
                   bg-[#F2D027]
                   flex items-center justify-center
                   mr-3"
        >
            <span class="text-[#025928] font-bold">
                BMD
            </span>
        </div>

        <div>

            <h1 class="font-bold text-sm">
                Bimadaya
            </h1>

            <p class="text-xs text-white/60">
                Procurement Management
            </p>

        </div>

    </div>

    <nav class="flex-1 px-4 py-6 space-y-2">

        <a
            href="{{ route('dashboard') }}"
            class="flex items-center gap-3
                px-4 py-3
                rounded-lg
                text-sm font-medium
                transition
                {{ request()->routeIs('dashboard') ? 'bg-white/10' : 'hover:bg-white/10' }}"
        >

            <span>Dashboard</span>
        </a>

        <a
            href="{{ route('purchase-orders.index') }}"
            class="flex items-center gap-3
                   px-4 py-3
                   rounded-lg
                   text-sm font-medium
                   hover:bg-white/10
                   transition
                   {{ request()->routeIs('purchase-orders.index') ? 'bg-white/10' : 'hover:bg-white/10' }}"
        >

            <span>Purchase Order</span>

        </a>

        <a
            href="#"
            class="flex items-center gap-3
                   px-4 py-3
                   rounded-lg
                   text-sm font-medium
                   hover:bg-white/10
                   transition"
        >

            <span>Quotation</span>

        </a>

        <a
            href="#"
            class="flex items-center gap-3
                   px-4 py-3
                   rounded-lg
                   text-sm font-medium
                   hover:bg-white/10
                   transition"
        >

            <span>Goods Transfer</span>

        </a>

        <a
            href="#"
            class="flex items-center gap-3
                   px-4 py-3
                   rounded-lg
                   text-sm font-medium
                   hover:bg-white/10
                   transition"
        >

            <span>Invoice</span>

        </a>

        <a
            href="#"
            class="flex items-center gap-3
                   px-4 py-3
                   rounded-lg
                   text-sm font-medium
                   hover:bg-white/10
                   transition"
        >

            <span>Receipt</span>

        </a>

    </nav>

    <div class="p-4 border-t border-white/10">

        <p class="text-xs text-white/50 text-center">
            Bimadaya Procurement Management
        </p>

    </div>

</aside>