@extends('layouts.app')

@section('breadcrumb')
    Record of Goods Transfer
@endsection

@section('content')

<div class="max-w-7xl mx-auto">

    @if(session('success'))
        <div class="mb-5 rounded-lg bg-green-100 px-4 py-3 text-sm text-green-800">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="mb-5 rounded-lg bg-red-100 px-4 py-3 text-sm text-red-800">
            {{ session('error') }}
        </div>
    @endif

    <div class="flex items-center justify-between mb-6">

        <div>
            <h1 class="text-2xl font-semibold text-[#252525]">
                Record of Goods Transfer
            </h1>

            <p class="text-sm text-gray-500 mt-1">
                Daftar berita acara serah terima barang
            </p>
        </div>

        <a
            href="{{ route('record-of-goods-transfers.create') }}"
            class="px-5 py-2.5 bg-[#027333] text-white rounded-lg hover:bg-[#025928] transition"
        >
            + Create Record
        </a>

    </div>

    <div class="bg-white rounded-xl shadow-sm overflow-hidden">

        <div class="overflow-x-auto">

            <table class="w-full text-sm">

                <thead>
                    <tr class="bg-[#F2F2F2] border-b">

                        <th class="px-5 py-4 text-left">
                            No.
                        </th>

                        <th class="px-5 py-4 text-left">
                            Nomor Record
                        </th>

                        <th class="px-5 py-4 text-left">
                            Tanggal
                        </th>

                        <th class="px-5 py-4 text-left">
                            Penerima
                        </th>

                        <th class="px-5 py-4 text-left">
                            Perusahaan
                        </th>

                        <th class="px-5 py-4 text-left">
                            Jumlah Barang
                        </th>

                        <th class="px-5 py-4 text-center">
                            Download
                        </th>

                    </tr>
                </thead>

                <tbody>

                    @forelse($records as $index => $record)

                        <tr class="border-b last:border-b-0 hover:bg-gray-50">

                            <td class="px-5 py-4">
                                {{ $index + 1 }}
                            </td>

                            <td class="px-5 py-4 font-medium">
                                {{ $record->record_number }}
                            </td>

                            <td class="px-5 py-4">
                                {{ $record->transfer_date->format('d/m/Y') }}
                            </td>

                            <td class="px-5 py-4">
                                <div>
                                    {{ $record->recipient_name }}
                                </div>

                                <div class="text-xs text-gray-500 mt-1">
                                    {{ $record->recipient_position }}
                                </div>
                            </td>

                            <td class="px-5 py-4">
                                {{ $record->recipient_company }}
                            </td>

                            <td class="px-5 py-4">
                                {{ $record->items->count() }}
                            </td>

                            <td class="px-5 py-4 text-center">

                                <a
                                    href="{{ route('record-of-goods-transfers.download', $record) }}"
                                    class="inline-flex px-4 py-2 rounded-lg bg-[#027333] text-white hover:bg-[#025928] transition"
                                >
                                    Word
                                </a>

                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td
                                colspan="6"
                                class="px-5 py-10 text-center text-gray-500"
                            >
                                Belum ada Record of Goods Transfer.
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection