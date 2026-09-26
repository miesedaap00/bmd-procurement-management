@extends('layouts.app')

@section('breadcrumb')
    Quotation
@endsection

@section('content')

<div class="mb-6 flex items-center justify-between">

    <div>
        <h1 class="text-2xl font-bold text-[#252525]">
            Quotation
        </h1>

        <p class="mt-1 text-sm text-gray-500">
            Daftar penawaran harga
        </p>
    </div>

    <a
        href="{{ route('quotations.create') }}"
        class="inline-flex items-center gap-2 px-4 py-2.5 rounded-lg bg-[#027333] text-white text-sm font-medium hover:bg-[#025928] transition"
    >
        <span class="text-lg leading-none">+</span>
        <span>Create Quotation</span>
    </a>

</div>

@if(session('success'))
    <div class="mb-6 rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="mb-6 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
        {{ session('error') }}
    </div>
@endif

<div class="bg-white rounded-xl shadow-sm border border-gray-200">

    <div class="p-6 border-b border-gray-200">

        <h2 class="text-lg font-semibold text-[#252525]">
            Daftar Quotation
        </h2>

        <p class="mt-1 text-sm text-gray-500">
            Data penawaran harga yang telah dibuat
        </p>

    </div>

    <div class="overflow-x-auto">

        <table class="w-full text-sm">

            <thead>
                <tr class="border-b border-gray-200 bg-gray-50">

                    <th class="px-6 py-4 text-left font-semibold text-[#252525]">
                        No.
                    </th>

                    <th class="px-6 py-4 text-left font-semibold text-[#252525]">
                        Nomor Quotation
                    </th>

                    <th class="px-6 py-4 text-left font-semibold text-[#252525]">
                        Client
                    </th>

                    <th class="px-6 py-4 text-left font-semibold text-[#252525]">
                        Tanggal
                    </th>

                    <th class="px-6 py-4 text-right font-semibold text-[#252525]">
                        Total
                    </th>

                    <th class="px-6 py-4 text-center font-semibold text-[#252525]">
                        Download
                    </th>

                </tr>
            </thead>

            <tbody>

                @forelse($quotations as $index => $quotation)

                    <tr class="border-b border-gray-100 hover:bg-gray-50 transition">

                        <td class="px-6 py-4 text-gray-600">
                            {{ $index + 1 }}
                        </td>

                        <td class="px-6 py-4">

                            <div class="font-medium text-[#252525]">
                                {{ $quotation->quotation_number }}
                            </div>

                        </td>

                        <td class="px-6 py-4">

                            <div class="font-medium text-[#252525]">
                                {{ $quotation->client_name }}
                            </div>

                            <div class="mt-1 text-xs text-gray-500 max-w-xs">
                                {{ $quotation->client_address }}
                            </div>

                        </td>

                        <td class="px-6 py-4 text-gray-600">
                            {{ $quotation->quotation_date->format('d/m/Y') }}
                        </td>

                        <td class="px-6 py-4 text-right font-medium text-[#252525]">

                            {{ number_format(
                                $quotation->items->sum('total'),
                                2,
                                ',',
                                '.'
                            ) }}

                        </td>

                        <td class="px-6 py-4">

                            <div class="flex items-center justify-center gap-2">

                                <a
                                    href="{{ route('quotations.download-word', $quotation) }}"
                                    class="inline-flex items-center gap-2 px-3 py-2 rounded-lg border border-[#027333] text-[#027333] text-xs font-medium hover:bg-[#027333] hover:text-white transition"
                                >
                                    <span>DOCX</span>
                                    <span>Word</span>
                                </a>

                                <a
                                    href="{{ route('quotations.download-pdf', $quotation) }}"
                                    class="inline-flex items-center gap-2 px-3 py-2 rounded-lg border border-red-500 text-red-500 text-xs font-medium hover:bg-red-500 hover:text-white transition"
                                >
                                    <span>PDF</span>
                                    <span>PDF</span>
                                </a>

                            </div>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td
                            colspan="6"
                            class="px-6 py-12 text-center"
                        >

                            <div class="text-gray-400 text-4xl mb-3">
                                📄
                            </div>

                            <p class="text-sm font-medium text-[#252525]">
                                Belum ada quotation
                            </p>

                            <p class="mt-1 text-xs text-gray-500">
                                Buat quotation pertama untuk mulai menggunakan fitur ini.
                            </p>

                            <a
                                href="{{ route('quotations.create') }}"
                                class="inline-flex items-center gap-2 mt-4 px-4 py-2 rounded-lg bg-[#027333] text-white text-sm font-medium hover:bg-[#025928] transition"
                            >
                                <span>+</span>
                                <span>Create Quotation</span>
                            </a>

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection