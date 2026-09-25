@extends('layouts.app')

@section('breadcrumb', 'Purchase Order / Create')

@section('content')

<div class="space-y-6">

    <div>
        <h1 class="text-2xl font-bold text-[#252525]">
            Create Purchase Order
        </h1>

        <p class="mt-1 text-sm text-gray-500">
            Create a new purchase order
        </p>
    </div>

    @if ($errors->any())

        <div class="bg-red-50 border border-red-200 rounded-xl p-4">

            <div class="text-sm font-semibold text-red-700">
                Terdapat kesalahan pada form:
            </div>

            <ul class="mt-2 list-disc list-inside text-sm text-red-600">

                @foreach ($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif

    <form
        action="{{ route('purchase-orders.store') }}"
        method="POST"
    >
        @csrf

        <div class="bg-white rounded-xl border border-gray-200 p-6">

            <h2 class="text-lg font-semibold text-[#252525] mb-6">
                Purchase Order Information
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <div>
                    <label
                        for="po_number"
                        class="block text-sm font-medium text-[#252525] mb-2"
                    >
                        PO Number
                    </label>

                    <input
                        type="text"
                        id="po_number"
                        name="po_number"
                        class="w-full rounded-lg border-gray-300
                               focus:border-[#027333]
                               focus:ring-[#027333]"
                        placeholder="Enter PO number"
                    >
                </div>

                <div>
                    <label
                        for="po_date"
                        class="block text-sm font-medium text-[#252525] mb-2"
                    >
                        Date
                    </label>

                    <input
                        type="date"
                        id="po_date"
                        name="po_date"
                        value="{{ date('Y-m-d') }}"
                        class="w-full rounded-lg border-gray-300
                               focus:border-[#027333]
                               focus:ring-[#027333]"
                    >
                </div>

                <div>
                    <label
                        for="vendor_name"
                        class="block text-sm font-medium text-[#252525] mb-2"
                    >
                        Vendor
                    </label>

                    <input
                        type="text"
                        id="vendor_name"
                        name="vendor_name"
                        class="w-full rounded-lg border-gray-300
                               focus:border-[#027333]
                               focus:ring-[#027333]"
                        placeholder="Enter vendor name"
                    >
                </div>

                <div>
                    <label
                        for="currency"
                        class="block text-sm font-medium text-[#252525] mb-2"
                    >
                        Currency
                    </label>

                    <select
                        id="currency"
                        name="currency"
                        class="w-full rounded-lg border-gray-300
                               focus:border-[#027333]
                               focus:ring-[#027333]"
                    >
                        <option value="IDR">IDR</option>
                        <option value="USD">USD</option>
                    </select>
                </div>

                <div class="md:col-span-2">
                    <label
                        for="vendor_address"
                        class="block text-sm font-medium text-[#252525] mb-2"
                    >
                        Vendor Address
                    </label>

                    <textarea
                        id="vendor_address"
                        name="vendor_address"
                        rows="3"
                        class="w-full rounded-lg border-gray-300
                               focus:border-[#027333]
                               focus:ring-[#027333]"
                        placeholder="Enter vendor address"
                    ></textarea>
                </div>

            </div>

        </div>

        <div class="bg-white rounded-xl border border-gray-200 p-6 mt-6">

            <div class="flex items-center justify-between mb-6">

                <div>
                    <h2 class="text-lg font-semibold text-[#252525]">
                        Goods
                    </h2>

                    <p class="mt-1 text-sm text-gray-500">
                        Add goods or services for this purchase order
                    </p>
                </div>

                <button
                    type="button"
                    id="add-item"
                    class="inline-flex items-center gap-2
                           px-4 py-2
                           rounded-lg
                           bg-[#027333]
                           text-white
                           text-sm font-semibold
                           hover:bg-[#025928]
                           transition"
                >
                    <span class="text-lg">+</span>
                    <span>Add Item</span>
                </button>

            </div>

            <div class="overflow-x-auto">

                <table class="w-full min-w-[900px]">

                    <thead>

                        <tr class="border-b border-gray-200">

                            <th class="px-3 py-3 text-left text-sm font-semibold text-gray-600 w-12">
                                No.
                            </th>

                            <th class="px-3 py-3 text-left text-sm font-semibold text-gray-600">
                                Description of Goods
                            </th>

                            <th class="px-3 py-3 text-left text-sm font-semibold text-gray-600 w-28">
                                Quantity
                            </th>

                            <th class="px-3 py-3 text-left text-sm font-semibold text-gray-600 w-32">
                                Satuan
                            </th>

                            <th class="px-3 py-3 text-left text-sm font-semibold text-gray-600 w-40">
                                Price
                            </th>

                            <th class="px-3 py-3 text-right text-sm font-semibold text-gray-600 w-44">
                                Total
                            </th>

                            <th class="px-3 py-3 w-16">
                            </th>

                        </tr>

                    </thead>

                    <tbody id="items-container">

                        <tr class="item-row border-b border-gray-100">

                            <td class="px-3 py-4 text-sm text-gray-600 item-number">
                                1
                            </td>

                            <td class="px-3 py-4">

                                <input
                                    type="text"
                                    name="items[0][description]"
                                    class="w-full rounded-lg border-gray-300
                                           focus:border-[#027333]
                                           focus:ring-[#027333]"
                                    placeholder="Description"
                                >

                            </td>

                            <td class="px-3 py-4">

                                <input
                                    type="number"
                                    name="items[0][quantity]"
                                    class="quantity w-full rounded-lg border-gray-300
                                           focus:border-[#027333]
                                           focus:ring-[#027333]"
                                    value="1"
                                    min="0"
                                    step="0.01"
                                >

                            </td>

                            <td class="px-3 py-4">

                                <input
                                    type="text"
                                    name="items[0][unit]"
                                    class="w-full rounded-lg border-gray-300
                                           focus:border-[#027333]
                                           focus:ring-[#027333]"
                                    placeholder="Unit"
                                >

                            </td>

                            <td class="px-3 py-4">

                                <input
                                    type="number"
                                    name="items[0][price]"
                                    class="price w-full rounded-lg border-gray-300
                                           focus:border-[#027333]
                                           focus:ring-[#027333]"
                                    value="0"
                                    min="0"
                                    step="0.01"
                                >

                            </td>

                            <td class="px-3 py-4 text-right">

                                <span class="item-total font-medium text-[#252525]">
                                    0
                                </span>

                            </td>

                            <td class="px-3 py-4 text-center">

                                <button
                                    type="button"
                                    class="remove-item text-red-500 hover:text-red-700"
                                >
                                    ×
                                </button>

                            </td>

                        </tr>

                    </tbody>

                </table>

            </div>

        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-6">

            <div class="bg-white rounded-xl border border-gray-200 p-6">

                <h2 class="text-lg font-semibold text-[#252525] mb-6">
                    Additional Information
                </h2>

                <div class="space-y-5">

                    <div>
                        <label
                            for="contact_person"
                            class="block text-sm font-medium text-[#252525] mb-2"
                        >
                            Contact Person
                        </label>

                        <input
                            type="text"
                            id="contact_person"
                            name="contact_person"
                            class="w-full rounded-lg border-gray-300
                                   focus:border-[#027333]
                                   focus:ring-[#027333]"
                            placeholder="Enter contact person"
                        >
                    </div>

                    <div>
                        <label
                            for="term_of_payment"
                            class="block text-sm font-medium text-[#252525] mb-2"
                        >
                            Term of Payment
                        </label>

                        <textarea
                            id="term_of_payment"
                            name="term_of_payment"
                            rows="4"
                            class="w-full rounded-lg border-gray-300
                                   focus:border-[#027333]
                                   focus:ring-[#027333]"
                            placeholder="Enter term of payment"
                        ></textarea>
                    </div>

                </div>

            </div>

            <div class="bg-white rounded-xl border border-gray-200 p-6">

                <h2 class="text-lg font-semibold text-[#252525] mb-6">
                    Summary
                </h2>

                <div class="space-y-4">

                    <div class="flex items-center justify-between">

                        <span class="text-sm text-gray-600">
                            Sub Total
                        </span>

                        <span
                            id="subtotal"
                            class="font-medium text-[#252525]"
                        >
                            0
                        </span>

                    </div>

                    <div class="flex items-center justify-between gap-4">

                        <label
                            for="discount"
                            class="text-sm text-gray-600"
                        >
                            Discount
                        </label>

                        <input
                            type="number"
                            id="discount"
                            name="discount"
                            value="0"
                            min="0"
                            step="0.01"
                            class="w-40 rounded-lg border-gray-300
                                   text-right
                                   focus:border-[#027333]
                                   focus:ring-[#027333]"
                        >

                    </div>

                    <div class="flex items-center justify-between gap-4">

                        <label
                            for="vat"
                            class="text-sm text-gray-600"
                        >
                            VAT (%)
                        </label>

                        <input
                            type="number"
                            id="vat"
                            name="vat"
                            value="11"
                            min="0"
                            step="0.01"
                            class="w-40 rounded-lg border-gray-300
                                   text-right
                                   focus:border-[#027333]
                                   focus:ring-[#027333]"
                        >

                    </div>

                    <div class="flex items-center justify-between">

                        <span class="text-sm text-gray-600">
                            VAT Amount
                        </span>

                        <span
                            id="vat-amount"
                            class="font-medium text-[#252525]"
                        >
                            0
                        </span>

                    </div>

                    <div class="flex items-center justify-between gap-4">

                        <label
                            for="freight_cost"
                            class="text-sm text-gray-600"
                        >
                            Freight Cost
                        </label>

                        <input
                            type="number"
                            id="freight_cost"
                            name="freight_cost"
                            value="0"
                            min="0"
                            step="0.01"
                            class="w-40 rounded-lg border-gray-300
                                   text-right
                                   focus:border-[#027333]
                                   focus:ring-[#027333]"
                        >

                    </div>

                    <div class="border-t border-gray-200 pt-4">

                        <div class="flex items-center justify-between">

                            <span class="text-base font-semibold text-[#252525]">
                                Grand Total
                            </span>

                            <span
                                id="grand-total"
                                class="text-xl font-bold text-[#027333]"
                            >
                                0
                            </span>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <div class="flex items-center justify-end gap-3 mt-6">

            <a
                href="{{ route('purchase-orders.index') }}"
                class="px-5 py-3
                       rounded-lg
                       border border-gray-300
                       bg-white
                       text-sm font-semibold
                       text-gray-700
                       hover:bg-gray-50
                       transition"
            >
                Cancel
            </a>

            <button
                type="submit"
                class="px-5 py-3
                       rounded-lg
                       bg-[#027333]
                       text-white
                       text-sm font-semibold
                       hover:bg-[#025928]
                       transition"
            >
                Create Purchase Order
            </button>

        </div>

    </form>

</div>

<script>

document.addEventListener('DOMContentLoaded', function () {

    const itemsContainer = document.getElementById('items-container');
    const addItemButton = document.getElementById('add-item');

    const discountInput = document.getElementById('discount');
    const vatInput = document.getElementById('vat');
    const freightInput = document.getElementById('freight_cost');

    const subtotalElement = document.getElementById('subtotal');
    const vatAmountElement = document.getElementById('vat-amount');
    const grandTotalElement = document.getElementById('grand-total');

    let itemIndex = 1;

    function formatNumber(value) {
        return new Intl.NumberFormat('id-ID', {
            minimumFractionDigits: 0,
            maximumFractionDigits: 2
        }).format(value);
    }

    function calculateTotals() {

        let subtotal = 0;

        const rows = itemsContainer.querySelectorAll('.item-row');

        rows.forEach(function (row) {

            const quantity = parseFloat(
                row.querySelector('.quantity').value
            ) || 0;

            const price = parseFloat(
                row.querySelector('.price').value
            ) || 0;

            const total = quantity * price;

            row.querySelector('.item-total').textContent =
                formatNumber(total);

            subtotal += total;

        });

        const discount =
            parseFloat(discountInput.value) || 0;

        const vatPercentage =
            parseFloat(vatInput.value) || 0;

        const freightCost =
            parseFloat(freightInput.value) || 0;

        const afterDiscount =
            Math.max(subtotal - discount, 0);

        const vatAmount =
            afterDiscount * (vatPercentage / 100);

        const grandTotal =
            afterDiscount + vatAmount + freightCost;

        subtotalElement.textContent =
            formatNumber(subtotal);

        vatAmountElement.textContent =
            formatNumber(vatAmount);

        grandTotalElement.textContent =
            formatNumber(grandTotal);

    }

    function updateItemNumbers() {

        const rows =
            itemsContainer.querySelectorAll('.item-row');

        rows.forEach(function (row, index) {

            row.querySelector('.item-number').textContent =
                index + 1;

        });

    }

    function createItemRow() {

        const row = document.createElement('tr');

        row.className =
            'item-row border-b border-gray-100';

        row.innerHTML = `
            <td class="px-3 py-4 text-sm text-gray-600 item-number">
                ${itemIndex + 1}
            </td>

            <td class="px-3 py-4">
                <input
                    type="text"
                    name="items[${itemIndex}][description]"
                    class="w-full rounded-lg border-gray-300
                           focus:border-[#027333]
                           focus:ring-[#027333]"
                    placeholder="Description"
                >
            </td>

            <td class="px-3 py-4">
                <input
                    type="number"
                    name="items[${itemIndex}][quantity]"
                    class="quantity w-full rounded-lg border-gray-300
                           focus:border-[#027333]
                           focus:ring-[#027333]"
                    value="1"
                    min="0"
                    step="0.01"
                >
            </td>

            <td class="px-3 py-4">
                <input
                    type="text"
                    name="items[${itemIndex}][unit]"
                    class="w-full rounded-lg border-gray-300
                           focus:border-[#027333]
                           focus:ring-[#027333]"
                    placeholder="Unit"
                >
            </td>

            <td class="px-3 py-4">
                <input
                    type="number"
                    name="items[${itemIndex}][price]"
                    class="price w-full rounded-lg border-gray-300
                           focus:border-[#027333]
                           focus:ring-[#027333]"
                    value="0"
                    min="0"
                    step="0.01"
                >
            </td>

            <td class="px-3 py-4 text-right">
                <span class="item-total font-medium text-[#252525]">
                    0
                </span>
            </td>

            <td class="px-3 py-4 text-center">
                <button
                    type="button"
                    class="remove-item text-red-500 hover:text-red-700"
                >
                    ×
                </button>
            </td>
        `;

        itemsContainer.appendChild(row);

        itemIndex++;

        updateItemNumbers();

        calculateTotals();

    }

    addItemButton.addEventListener('click', function () {
        createItemRow();
    });

    itemsContainer.addEventListener('input', function (event) {

        if (
            event.target.classList.contains('quantity') ||
            event.target.classList.contains('price')
        ) {
            calculateTotals();
        }

    });

    itemsContainer.addEventListener('click', function (event) {

        if (
            event.target.classList.contains('remove-item')
        ) {

            const rows =
                itemsContainer.querySelectorAll('.item-row');

            if (rows.length <= 1) {
                return;
            }

            event.target.closest('.item-row').remove();

            updateItemNumbers();

            calculateTotals();

        }

    });

    discountInput.addEventListener(
        'input',
        calculateTotals
    );

    vatInput.addEventListener(
        'input',
        calculateTotals
    );

    freightInput.addEventListener(
        'input',
        calculateTotals
    );

    calculateTotals();

});

</script>

@endsection