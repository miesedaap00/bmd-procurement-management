@extends('layouts.app')

@section('breadcrumb')
    Quotation / Create
@endsection

@section('content')

<div class="mb-6">
    <h1 class="text-2xl font-bold text-[#252525]">
        Create Quotation
    </h1>

    <p class="mt-1 text-sm text-gray-500">
        Buat penawaran harga baru untuk client
    </p>
</div>

<form
    action="{{ route('quotations.store') }}"
    method="POST"
    id="quotation-form"
>
    @csrf

    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-6">

        <h2 class="text-lg font-semibold text-[#252525] mb-6">
            Informasi Quotation
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <div>
                <label class="block text-sm font-medium text-[#252525] mb-2">
                    Nomor Quotation
                </label>

                <input
                    type="text"
                    name="quotation_number"
                    value="{{ old('quotation_number') }}"
                    placeholder="Contoh: 123/BMG/VI/2026"
                    required
                    class="w-full rounded-lg border-gray-300 focus:border-[#027333] focus:ring-[#027333]"
                >

                @error('quotation_number')
                    <p class="mt-1 text-sm text-red-600">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-[#252525] mb-2">
                    Tanggal
                </label>

                <input
                    type="date"
                    name="quotation_date"
                    value="{{ old('quotation_date', now()->format('Y-m-d')) }}"
                    required
                    class="w-full rounded-lg border-gray-300 focus:border-[#027333] focus:ring-[#027333]"
                >

                @error('quotation_date')
                    <p class="mt-1 text-sm text-red-600">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-[#252525] mb-2">
                    Nama Client
                </label>

                <input
                    type="text"
                    name="client_name"
                    value="{{ old('client_name') }}"
                    placeholder="Nama client"
                    required
                    class="w-full rounded-lg border-gray-300 focus:border-[#027333] focus:ring-[#027333]"
                >

                @error('client_name')
                    <p class="mt-1 text-sm text-red-600">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-[#252525] mb-2">
                    Alamat Client
                </label>

                <textarea
                    name="client_address"
                    rows="3"
                    placeholder="Alamat client"
                    required
                    class="w-full rounded-lg border-gray-300 focus:border-[#027333] focus:ring-[#027333]"
                >{{ old('client_address') }}</textarea>

                @error('client_address')
                    <p class="mt-1 text-sm text-red-600">
                        {{ $message }}
                    </p>
                @enderror
            </div>

        </div>

    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">

        <div class="flex items-center justify-between mb-6">

            <div>
                <h2 class="text-lg font-semibold text-[#252525]">
                    Daftar Produk & Harga
                </h2>

                <p class="text-sm text-gray-500 mt-1">
                    Tambahkan produk atau barang yang akan ditawarkan
                </p>
            </div>

            <button
                type="button"
                id="add-item"
                class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-[#027333] text-white text-sm font-medium hover:bg-[#025928] transition"
            >
                <span>+</span>
                <span>Tambah Item</span>
            </button>

        </div>

        <div class="overflow-x-auto">

            <table class="w-full text-sm" id="items-table">

                <thead>
                    <tr class="border-b border-gray-200">

                        <th class="px-3 py-3 text-left font-semibold text-[#252525]">
                            No
                        </th>

                        <th class="px-3 py-3 text-left font-semibold text-[#252525] min-w-[180px]">
                            Item
                        </th>

                        <th class="px-3 py-3 text-left font-semibold text-[#252525] min-w-[220px]">
                            Specification
                        </th>

                        <th class="px-3 py-3 text-left font-semibold text-[#252525] min-w-[130px]">
                            Merk
                        </th>

                        <th class="px-3 py-3 text-left font-semibold text-[#252525] w-[100px]">
                            Qty
                        </th>

                        <th class="px-3 py-3 text-left font-semibold text-[#252525] min-w-[150px]">
                            Harga
                        </th>

                        <th class="px-3 py-3 text-left font-semibold text-[#252525] min-w-[150px]">
                            Total
                        </th>

                        <th class="px-3 py-3 text-left font-semibold text-[#252525] min-w-[180px]">
                            Note
                        </th>

                        <th class="px-3 py-3 text-center font-semibold text-[#252525]">
                            Action
                        </th>

                    </tr>
                </thead>

                <tbody id="items-container">

                </tbody>

                <tfoot>
                    <tr class="border-t border-gray-200">
                        <td
                            colspan="6"
                            class="px-3 py-4 text-right font-semibold text-[#252525]"
                        >
                            Total Penawaran
                        </td>

                        <td
                            class="px-3 py-4 font-semibold text-[#252525]"
                            id="grand-total"
                        >
                            0
                        </td>

                        <td colspan="2"></td>
                    </tr>
                </tfoot>

            </table>

        </div>

        @error('items')
            <p class="mt-3 text-sm text-red-600">
                {{ $message }}
            </p>
        @enderror

        <div class="flex justify-end gap-3 mt-6 pt-6 border-t border-gray-200">

            <a
                href="{{ route('quotations.index') }}"
                class="px-5 py-2.5 rounded-lg border border-gray-300 text-sm font-medium text-[#252525] hover:bg-gray-50 transition"
            >
                Cancel
            </a>

            <button
                type="submit"
                class="px-5 py-2.5 rounded-lg bg-[#027333] text-white text-sm font-medium hover:bg-[#025928] transition"
            >
                Save Quotation
            </button>

        </div>

    </div>

</form>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const container = document.getElementById('items-container');
    const addItemButton = document.getElementById('add-item');
    const grandTotal = document.getElementById('grand-total');

    let itemIndex = 0;

    function formatNumber(value) {
        return new Intl.NumberFormat('id-ID', {
            minimumFractionDigits: 0,
            maximumFractionDigits: 2
        }).format(value);
    }

    function calculateRow(row) {

        const quantityInput = row.querySelector('.quantity-input');
        const priceInput = row.querySelector('.price-input');
        const totalInput = row.querySelector('.total-input');

        const quantity = parseFloat(quantityInput.value) || 0;
        const price = parseFloat(priceInput.value) || 0;

        const total = quantity * price;

        totalInput.value = total.toFixed(2);

        calculateGrandTotal();
    }

    function calculateGrandTotal() {

        let total = 0;

        container.querySelectorAll('.total-input').forEach(function (input) {
            total += parseFloat(input.value) || 0;
        });

        grandTotal.textContent = formatNumber(total);
    }

    function createItemRow() {

        const row = document.createElement('tr');

        row.className = 'border-b border-gray-100';

        row.innerHTML = `
            <td class="px-3 py-3 item-number"></td>

            <td class="px-3 py-3">
                <input
                    type="text"
                    name="items[${itemIndex}][item]"
                    required
                    class="w-full rounded-lg border-gray-300 text-sm focus:border-[#027333] focus:ring-[#027333]"
                >
            </td>

            <td class="px-3 py-3">
                <textarea
                    name="items[${itemIndex}][specification]"
                    rows="2"
                    class="w-full rounded-lg border-gray-300 text-sm focus:border-[#027333] focus:ring-[#027333]"
                ></textarea>
            </td>

            <td class="px-3 py-3">
                <input
                    type="text"
                    name="items[${itemIndex}][brand]"
                    class="w-full rounded-lg border-gray-300 text-sm focus:border-[#027333] focus:ring-[#027333]"
                >
            </td>

            <td class="px-3 py-3">
                <input
                    type="number"
                    name="items[${itemIndex}][quantity]"
                    min="0"
                    step="0.01"
                    value="1"
                    required
                    class="w-full rounded-lg border-gray-300 text-sm focus:border-[#027333] focus:ring-[#027333] quantity-input"
                >
            </td>

            <td class="px-3 py-3">
                <input
                    type="number"
                    name="items[${itemIndex}][price]"
                    min="0"
                    step="0.01"
                    value="0"
                    required
                    class="w-full rounded-lg border-gray-300 text-sm focus:border-[#027333] focus:ring-[#027333] price-input"
                >
            </td>

            <td class="px-3 py-3">
                <input
                    type="number"
                    name="items[${itemIndex}][total]"
                    value="0"
                    readonly
                    class="w-full rounded-lg border-gray-300 bg-gray-50 text-sm total-input"
                >
            </td>

            <td class="px-3 py-3">
                <textarea
                    name="items[${itemIndex}][note]"
                    rows="2"
                    class="w-full rounded-lg border-gray-300 text-sm focus:border-[#027333] focus:ring-[#027333]"
                ></textarea>
            </td>

            <td class="px-3 py-3 text-center">
                <button
                    type="button"
                    class="remove-item inline-flex items-center justify-center w-9 h-9 rounded-lg text-red-600 hover:bg-red-50 transition"
                >
                    ×
                </button>
            </td>
        `;

        container.appendChild(row);

        const quantityInput = row.querySelector('.quantity-input');
        const priceInput = row.querySelector('.price-input');
        const removeButton = row.querySelector('.remove-item');

        quantityInput.addEventListener('input', function () {
            calculateRow(row);
        });

        priceInput.addEventListener('input', function () {
            calculateRow(row);
        });

        removeButton.addEventListener('click', function () {

            if (container.children.length === 1) {
                return;
            }

            row.remove();

            updateNumbers();
            calculateGrandTotal();

        });

        itemIndex++;

        updateNumbers();
        calculateRow(row);
    }

    function updateNumbers() {

        const rows = container.querySelectorAll('tr');

        rows.forEach(function (row, index) {
            row.querySelector('.item-number').textContent = index + 1;
        });
    }

    addItemButton.addEventListener('click', function () {
        createItemRow();
    });

    createItemRow();

});
</script>

@endsection