@extends('layouts.app')

@section('breadcrumb')
    Record of Goods Transfer / Create
@endsection

@section('content')

<div class="max-w-7xl mx-auto">

    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-semibold text-[#252525]">
                Create Record of Goods Transfer
            </h1>

            <p class="text-sm text-gray-500 mt-1">
                Buat berita acara serah terima barang
            </p>
        </div>
    </div>

    <form
        action="{{ route('record-of-goods-transfers.store') }}"
        method="POST"
    >
        @csrf

        <div class="bg-white rounded-xl shadow-sm p-6 mb-6">

            <h2 class="text-lg font-semibold mb-5">
                Informasi Serah Terima
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                <div>
                    <label class="block text-sm font-medium mb-2">
                        Nomor Record
                    </label>

                    <input
                        type="text"
                        name="record_number"
                        value="{{ old('record_number') }}"
                        class="w-full rounded-lg border-gray-300 focus:border-[#027333] focus:ring-[#027333]"
                        required
                    >

                    @error('record_number')
                        <p class="text-sm text-red-600 mt-1">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium mb-2">
                        Tanggal Serah Terima
                    </label>

                    <input
                        type="date"
                        name="transfer_date"
                        value="{{ old('transfer_date', date('Y-m-d')) }}"
                        class="w-full rounded-lg border-gray-300 focus:border-[#027333] focus:ring-[#027333]"
                        required
                    >

                    @error('transfer_date')
                        <p class="text-sm text-red-600 mt-1">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium mb-2">
                        Nama Penerima
                    </label>

                    <input
                        type="text"
                        name="recipient_name"
                        value="{{ old('recipient_name') }}"
                        class="w-full rounded-lg border-gray-300 focus:border-[#027333] focus:ring-[#027333]"
                        required
                    >

                    @error('recipient_name')
                        <p class="text-sm text-red-600 mt-1">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium mb-2">
                        Jabatan Penerima
                    </label>

                    <input
                        type="text"
                        name="recipient_position"
                        value="{{ old('recipient_position') }}"
                        class="w-full rounded-lg border-gray-300 focus:border-[#027333] focus:ring-[#027333]"
                        required
                    >

                    @error('recipient_position')
                        <p class="text-sm text-red-600 mt-1">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium mb-2">
                        Perusahaan Penerima
                    </label>

                    <input
                        type="text"
                        name="recipient_company"
                        value="{{ old('recipient_company') }}"
                        class="w-full rounded-lg border-gray-300 focus:border-[#027333] focus:ring-[#027333]"
                        required
                    >

                    @error('recipient_company')
                        <p class="text-sm text-red-600 mt-1">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

            </div>

        </div>

        <div class="bg-white rounded-xl shadow-sm p-6">

            <div class="flex items-center justify-between mb-5">

                <div>
                    <h2 class="text-lg font-semibold">
                        Daftar Barang
                    </h2>

                    <p class="text-sm text-gray-500 mt-1">
                        Masukkan barang yang diserahterimakan
                    </p>
                </div>

                <button
                    type="button"
                    id="add-item"
                    class="px-4 py-2 bg-[#027333] text-white rounded-lg hover:bg-[#025928] transition"
                >
                    + Tambah Barang
                </button>

            </div>

            <div class="overflow-x-auto">

                <table class="w-full text-sm">

                    <thead>
                        <tr class="border-b bg-[#F2F2F2]">

                            <th class="px-3 py-3 text-left w-12">
                                No
                            </th>

                            <th class="px-3 py-3 text-left min-w-[220px]">
                                Nama Barang
                            </th>

                            <th class="px-3 py-3 text-left min-w-[160px]">
                                Merk
                            </th>

                            <th class="px-3 py-3 text-left min-w-[100px]">
                                Qty
                            </th>

                            <th class="px-3 py-3 text-left min-w-[120px]">
                                Satuan
                            </th>

                            <th class="px-3 py-3 text-left min-w-[180px]">
                                Kondisi
                            </th>

                            <th class="px-3 py-3 text-center w-20">
                                Aksi
                            </th>

                        </tr>
                    </thead>

                    <tbody id="items-container">

                        <tr class="item-row border-b">

                            <td class="px-3 py-3 item-number">
                                1
                            </td>

                            <td class="px-3 py-3">
                                <input
                                    type="text"
                                    name="items[0][nama_barang]"
                                    class="w-full rounded-lg border-gray-300"
                                    required
                                >
                            </td>

                            <td class="px-3 py-3">
                                <input
                                    type="text"
                                    name="items[0][brand]"
                                    class="w-full rounded-lg border-gray-300"
                                >
                            </td>

                            <td class="px-3 py-3">
                                <input
                                    type="number"
                                    name="items[0][quantity]"
                                    min="0.01"
                                    step="0.01"
                                    class="w-full rounded-lg border-gray-300"
                                    required
                                >
                            </td>

                            <td class="px-3 py-3">
                                <input
                                    type="text"
                                    name="items[0][satuan]"
                                    class="w-full rounded-lg border-gray-300"
                                    required
                                >
                            </td>

                            <td class="px-3 py-3">
                                <input
                                    type="text"
                                    name="items[0][kondisi]"
                                    class="w-full rounded-lg border-gray-300"
                                    required
                                >
                            </td>

                            <td class="px-3 py-3 text-center">

                                <button
                                    type="button"
                                    class="remove-item text-red-600 hover:text-red-800"
                                >
                                    Hapus
                                </button>

                            </td>

                        </tr>

                    </tbody>

                </table>

            </div>

            <div class="flex justify-end gap-3 mt-6">

                <a
                    href="{{ route('record-of-goods-transfers.index') }}"
                    class="px-5 py-2.5 rounded-lg border border-gray-300 hover:bg-gray-50 transition"
                >
                    Batal
                </a>

                <button
                    type="submit"
                    class="px-5 py-2.5 rounded-lg bg-[#027333] text-white hover:bg-[#025928] transition"
                >
                    Simpan & Generate
                </button>

            </div>

        </div>

    </form>

</div>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const container = document.getElementById('items-container');
    const addButton = document.getElementById('add-item');

    function updateRows() {

        const rows = container.querySelectorAll('.item-row');

        rows.forEach(function (row, index) {

            row.querySelector('.item-number').textContent =
                index + 1;

            row.querySelectorAll('input').forEach(function (input) {

                const field = input.name.match(
                    /items\[\d+\]\[(.*?)\]/
                );

                if (field) {
                    input.name =
                        `items[${index}][${field[1]}]`;
                }

            });

        });

    }

    function createRow() {

        const row = document.createElement('tr');

        row.className = 'item-row border-b';

        row.innerHTML = `
            <td class="px-3 py-3 item-number"></td>

            <td class="px-3 py-3">
                <input
                    type="text"
                    class="w-full rounded-lg border-gray-300"
                    data-field="nama_barang"
                    required
                >
            </td>

            <td class="px-3 py-3">
                <input
                    type="text"
                    class="w-full rounded-lg border-gray-300"
                    data-field="brand"
                >
            </td>

            <td class="px-3 py-3">
                <input
                    type="number"
                    min="0.01"
                    step="0.01"
                    class="w-full rounded-lg border-gray-300"
                    data-field="quantity"
                    required
                >
            </td>

            <td class="px-3 py-3">
                <input
                    type="text"
                    class="w-full rounded-lg border-gray-300"
                    data-field="satuan"
                    required
                >
            </td>

            <td class="px-3 py-3">
                <input
                    type="text"
                    class="w-full rounded-lg border-gray-300"
                    data-field="kondisi"
                    required
                >
            </td>

            <td class="px-3 py-3 text-center">
                <button
                    type="button"
                    class="remove-item text-red-600 hover:text-red-800"
                >
                    Hapus
                </button>
            </td>
        `;

        row.querySelectorAll('input').forEach(function (input) {
            input.name = `items[0][${input.dataset.field}]`;
        });

        return row;
    }

    addButton.addEventListener('click', function () {

        container.appendChild(createRow());

        updateRows();

    });

    container.addEventListener('click', function (event) {

        if (
            event.target.classList.contains('remove-item')
        ) {

            const rows =
                container.querySelectorAll('.item-row');

            if (rows.length <= 1) {
                return;
            }

            event.target
                .closest('.item-row')
                .remove();

            updateRows();

        }

    });

    updateRows();

});
</script>

@endsection