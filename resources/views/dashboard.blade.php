@extends('layouts.app')

@section('content')

<div class="space-y-6">

    <div>
        <h1 class="text-2xl font-bold text-[#252525]">
            Dashboard
        </h1>

        <p class="mt-1 text-sm text-gray-500">
            Procurement Management Overview
        </p>
    </div>


    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-5">

        <div class="bg-white rounded-xl border border-gray-200 p-5">

            <div class="flex items-center justify-between">

                <div>
                    <p class="text-sm text-gray-500">
                        Declined
                    </p>

                    <h2 class="mt-2 text-3xl font-bold text-[#252525]">
                        5
                    </h2>
                </div>

                <div
                    class="w-11 h-11
                           rounded-lg
                           bg-red-50
                           flex items-center justify-center"
                >
                    <svg
                        class="w-6 h-6 text-red-500"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M6 18L18 6M6 6l12 12"
                        />
                    </svg>
                </div>

            </div>

            <p class="mt-4 text-xs text-gray-400">
                Total declined procurement
            </p>

        </div>


        <div class="bg-white rounded-xl border border-gray-200 p-5">

            <div class="flex items-center justify-between">

                <div>
                    <p class="text-sm text-gray-500">
                        Approved
                    </p>

                    <h2 class="mt-2 text-3xl font-bold text-[#252525]">
                        24
                    </h2>
                </div>

                <div
                    class="w-11 h-11
                           rounded-lg
                           bg-green-50
                           flex items-center justify-center"
                >
                    <svg
                        class="w-6 h-6 text-[#027333]"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M5 13l4 4L19 7"
                        />
                    </svg>
                </div>

            </div>

            <p class="mt-4 text-xs text-gray-400">
                Total approved procurement
            </p>

        </div>

        <div class="bg-white rounded-xl border border-gray-200 p-5">

            <div class="flex items-center justify-between">

                <div>
                    <p class="text-sm text-gray-500">
                        Pending
                    </p>

                    <h2 class="mt-2 text-3xl font-bold text-[#252525]">
                        8
                    </h2>
                </div>

                <div
                    class="w-11 h-11
                           rounded-lg
                           bg-yellow-50
                           flex items-center justify-center"
                >
                    <svg
                        class="w-6 h-6 text-[#F2D027]"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M12 8v4l3 2"
                        />

                        <circle
                            cx="12"
                            cy="12"
                            r="9"
                            stroke-width="2"
                        />
                    </svg>
                </div>

            </div>

            <p class="mt-4 text-xs text-gray-400">
                Total pending procurement
            </p>

        </div>

        <div class="bg-white rounded-xl border border-gray-200 p-5">

            <div class="flex items-center justify-between">

                <div>
                    <p class="text-sm text-gray-500">
                        On Process
                    </p>

                    <h2 class="mt-2 text-3xl font-bold text-[#252525]">
                        12
                    </h2>
                </div>

                <div
                    class="w-11 h-11
                           rounded-lg
                           bg-blue-50
                           flex items-center justify-center"
                >
                    <svg
                        class="w-6 h-6 text-blue-500"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M12 8v4l3 2"
                        />

                        <circle
                            cx="12"
                            cy="12"
                            r="9"
                            stroke-width="2"
                        />
                    </svg>
                </div>

            </div>

            <p class="mt-4 text-xs text-gray-400">
                Procurement currently in process
            </p>

        </div>

    </div>


    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

        <div
            class="xl:col-span-2
                   bg-white
                   rounded-xl
                   border border-gray-200
                   overflow-hidden"
        >

            <div
                class="px-6 py-5
                       border-b border-gray-200
                       flex items-center justify-between"
            >

                <div>
                    <h2 class="font-semibold text-[#252525]">
                        On Process Goods
                    </h2>

                    <p class="text-xs text-gray-500 mt-1">
                        Goods currently being processed
                    </p>
                </div>

                <button
                    type="button"
                    class="text-sm
                           font-medium
                           text-[#027333]
                           hover:text-[#025928]"
                >
                    View All
                </button>

            </div>


            <div class="overflow-x-auto">

                <table class="w-full text-sm">

                    <thead class="bg-[#F2F2F2]">

                        <tr>

                            <th
                                class="px-6 py-4
                                       text-left
                                       font-medium
                                       text-gray-500"
                            >
                                Item
                            </th>

                            <th
                                class="px-6 py-4
                                       text-left
                                       font-medium
                                       text-gray-500"
                            >
                                Vendor
                            </th>

                            <th
                                class="px-6 py-4
                                       text-left
                                       font-medium
                                       text-gray-500"
                            >
                                Status
                            </th>

                        </tr>

                    </thead>


                    <tbody class="divide-y divide-gray-100">

                        <tr class="hover:bg-gray-50">

                            <td class="px-6 py-4 font-medium text-[#252525]">
                                Laptop Dell Latitude
                            </td>

                            <td class="px-6 py-4 text-gray-500">
                                PT Teknologi Indonesia
                            </td>

                            <td class="px-6 py-4">

                                <span
                                    class="inline-flex
                                           items-center
                                           px-2.5 py-1
                                           rounded-full
                                           text-xs
                                           font-medium
                                           bg-blue-50
                                           text-blue-600"
                                >
                                    On Process
                                </span>

                            </td>

                        </tr>


                        <tr class="hover:bg-gray-50">

                            <td class="px-6 py-4 font-medium text-[#252525]">
                                Office Printer
                            </td>

                            <td class="px-6 py-4 text-gray-500">
                                PT Print Solution
                            </td>

                            <td class="px-6 py-4">

                                <span
                                    class="inline-flex
                                           items-center
                                           px-2.5 py-1
                                           rounded-full
                                           text-xs
                                           font-medium
                                           bg-blue-50
                                           text-blue-600"
                                >
                                    On Process
                                </span>

                            </td>

                        </tr>


                        <tr class="hover:bg-gray-50">

                            <td class="px-6 py-4 font-medium text-[#252525]">
                                Network Switch
                            </td>

                            <td class="px-6 py-4 text-gray-500">
                                PT Network Nusantara
                            </td>

                            <td class="px-6 py-4">

                                <span
                                    class="inline-flex
                                           items-center
                                           px-2.5 py-1
                                           rounded-full
                                           text-xs
                                           font-medium
                                           bg-blue-50
                                           text-blue-600"
                                >
                                    On Process
                                </span>

                            </td>

                        </tr>


                        <tr class="hover:bg-gray-50">

                            <td class="px-6 py-4 font-medium text-[#252525]">
                                Office Chair
                            </td>

                            <td class="px-6 py-4 text-gray-500">
                                PT Furniture Jaya
                            </td>

                            <td class="px-6 py-4">

                                <span
                                    class="inline-flex
                                           items-center
                                           px-2.5 py-1
                                           rounded-full
                                           text-xs
                                           font-medium
                                           bg-blue-50
                                           text-blue-600"
                                >
                                    On Process
                                </span>

                            </td>

                        </tr>

                    </tbody>

                </table>

            </div>

        </div>

        <div
            class="bg-white
                   rounded-xl
                   border border-gray-200
                   overflow-hidden"
        >

            <div
                class="px-6 py-5
                       border-b border-gray-200"
            >

                <h2 class="font-semibold text-[#252525]">
                    Vendor List
                </h2>

                <p class="text-xs text-gray-500 mt-1">
                    Registered vendors
                </p>

            </div>


            <div class="divide-y divide-gray-100">

                <div class="px-6 py-4 flex items-center gap-3">

                    <div
                        class="w-10 h-10
                               rounded-lg
                               bg-[#E8F5EE]
                               text-[#027333]
                               flex items-center justify-center
                               font-semibold"
                    >
                        TI
                    </div>

                    <div>
                        <p class="text-sm font-medium text-[#252525]">
                            PT Teknologi Indonesia
                        </p>

                        <p class="text-xs text-gray-500">
                            Technology
                        </p>
                    </div>

                </div>


                <div class="px-6 py-4 flex items-center gap-3">

                    <div
                        class="w-10 h-10
                               rounded-lg
                               bg-[#E8F5EE]
                               text-[#027333]
                               flex items-center justify-center
                               font-semibold"
                    >
                        PS
                    </div>

                    <div>
                        <p class="text-sm font-medium text-[#252525]">
                            PT Print Solution
                        </p>

                        <p class="text-xs text-gray-500">
                            Printing
                        </p>
                    </div>

                </div>


                <div class="px-6 py-4 flex items-center gap-3">

                    <div
                        class="w-10 h-10
                               rounded-lg
                               bg-[#E8F5EE]
                               text-[#027333]
                               flex items-center justify-center
                               font-semibold"
                    >
                        PN
                    </div>

                    <div>
                        <p class="text-sm font-medium text-[#252525]">
                            PT Network Nusantara
                        </p>

                        <p class="text-xs text-gray-500">
                            Networking
                        </p>
                    </div>

                </div>


                <div class="px-6 py-4 flex items-center gap-3">

                    <div
                        class="w-10 h-10
                               rounded-lg
                               bg-[#E8F5EE]
                               text-[#027333]
                               flex items-center justify-center
                               font-semibold"
                    >
                        PF
                    </div>

                    <div>
                        <p class="text-sm font-medium text-[#252525]">
                            PT Furniture Jaya
                        </p>

                        <p class="text-xs text-gray-500">
                            Furniture
                        </p>
                    </div>

                </div>

            </div>

        </div>

    </div>

    <div
        class="bg-white
               rounded-xl
               border border-gray-200
               p-6"
    >

        <div class="mb-6">

            <h2 class="font-semibold text-[#252525]">
                Statistics
            </h2>

            <p class="text-xs text-gray-500 mt-1">
                Procurement status overview
            </p>

        </div>


        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">

            <div
                class="rounded-lg
                       bg-[#F2F2F2]
                       p-5"
            >

                <p class="text-xs text-gray-500">
                    Declined
                </p>

                <p class="mt-2 text-xl font-bold text-[#252525]">
                    5
                </p>

            </div>


            <div
                class="rounded-lg
                       bg-[#F2F2F2]
                       p-5"
            >

                <p class="text-xs text-gray-500">
                    Approved
                </p>

                <p class="mt-2 text-xl font-bold text-[#027333]">
                    24
                </p>

            </div>


            <div
                class="rounded-lg
                       bg-[#F2F2F2]
                       p-5"
            >

                <p class="text-xs text-gray-500">
                    Pending
                </p>

                <p class="mt-2 text-xl font-bold text-[#252525]">
                    8
                </p>

            </div>


            <div
                class="rounded-lg
                       bg-[#F2F2F2]
                       p-5"
            >

                <p class="text-xs text-gray-500">
                    On Process
                </p>

                <p class="mt-2 text-xl font-bold text-[#252525]">
                    12
                </p>

            </div>

        </div>

    </div>

</div>

@endsection