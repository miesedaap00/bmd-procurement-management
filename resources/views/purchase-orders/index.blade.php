@extends('layouts.app')

@section('breadcrumb', 'Purchase Order')

@section('content')

<div class="space-y-6">

    <div class="flex items-center justify-between">

        <div>
            <h1 class="text-2xl font-bold text-[#252525]">
                Purchase Order
            </h1>

            <p class="mt-1 text-sm text-gray-500">
                Manage purchase orders
            </p>
        </div>

        <a
            href="{{ route('purchase-orders.create') }}"
            class="inline-flex items-center gap-2
                   px-5 py-3
                   rounded-lg
                   bg-[#027333]
                   text-white
                   text-sm font-semibold
                   hover:bg-[#025928]
                   transition"
        >
            <span class="text-lg">+</span>
            <span>Create Purchase Order</span>
        </a>

    </div>

    @if (session('success'))

        <div class="bg-green-50 border border-green-200 rounded-xl p-4">

            <p class="text-sm font-medium text-green-700">
                {{ session('success') }}
            </p>

        </div>

    @endif

    @if (session('error'))
        <div class="mb-6 rounded-lg bg-red-50 border border-red-200 px-4 py-3 text-sm text-red-700">
            {{ session('error') }}
        </div>
    @endif

    <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">

        <div class="overflow-x-auto">

            <table class="w-full">

                <thead class="bg-[#F2F2F2]">

                    <tr>

                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase">
                            No.
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase">
                            Nomor PO
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase">
                            Nama Vendor
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase">
                            Tanggal PO
                        </th>

                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase">
                            Status
                        </th>

                        <th class="px-6 py-4 text-center text-xs font-semibold text-gray-600 uppercase">
                            Action
                        </th>

                    </tr>

                </thead>

                <tbody class="divide-y divide-gray-100">

                    @forelse ($purchaseOrders as $purchaseOrder)

                        <tr class="hover:bg-gray-50 transition">

                            <td class="px-6 py-4 text-sm text-gray-600">
                                {{ $loop->iteration }}
                            </td>

                            <td class="px-6 py-4">

                                <span class="text-sm font-semibold text-[#252525]">
                                    {{ $purchaseOrder->po_number }}
                                </span>

                            </td>

                            <td class="px-6 py-4 text-sm text-gray-700">
                                {{ $purchaseOrder->vendor_name }}
                            </td>

                            <td class="px-6 py-4 text-sm text-gray-700">
                                {{ $purchaseOrder->po_date->format('d/m/Y') }}
                            </td>

                            <td class="px-6 py-4">

                                <form
                                    action="{{ route('purchase-orders.update-status', $purchaseOrder) }}"
                                    method="POST"
                                >
                                    @csrf
                                    @method('PATCH')

                                    <select
                                        name="status"
                                        onchange="this.form.submit()"
                                        class="rounded-lg
                                               border-gray-300
                                               text-sm
                                               font-medium
                                               focus:border-[#027333]
                                               focus:ring-[#027333]
                                               {{ $purchaseOrder->status === 'pending'
                                                    ? 'text-yellow-700 bg-yellow-50'
                                                    : ($purchaseOrder->status === 'approved'
                                                        ? 'text-blue-700 bg-blue-50'
                                                        : 'text-green-700 bg-green-50') }}"
                                    >

                                        <option
                                            value="pending"
                                            {{ $purchaseOrder->status === 'pending' ? 'selected' : '' }}
                                        >
                                            Pending
                                        </option>

                                        <option
                                            value="approved"
                                            {{ $purchaseOrder->status === 'approved' ? 'selected' : '' }}
                                        >
                                            Approved
                                        </option>

                                        <option
                                            value="completed"
                                            {{ $purchaseOrder->status === 'completed' ? 'selected' : '' }}
                                        >
                                            Completed
                                        </option>

                                    </select>

                                </form>

                            </td>

                            <td class="px-6 py-4 text-center">

                            @if ($purchaseOrder->file_path)
                                <a
                                    href="{{ route('purchase-orders.download', $purchaseOrder) }}"
                                    class="inline-flex items-center gap-2 px-3 py-2 rounded-lg bg-[#027333] text-white text-sm font-medium hover:bg-[#025928] transition"
                                >
                                    <span>↓</span>
                                    <span>Download</span>
                                </a>
                            @else
                                <span class="text-sm text-gray-400">
                                    File belum tersedia
                                </span>
                            @endif

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="6"
                                class="px-6 py-16 text-center"
                            >

                                <div class="text-gray-400">

                                    <div class="text-4xl mb-3">
                                        📄
                                    </div>

                                    <p class="text-sm font-medium text-gray-500">
                                        Belum ada Purchase Order
                                    </p>

                                    <p class="text-xs text-gray-400 mt-1">
                                        Create a new purchase order to get started
                                    </p>

                                </div>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection