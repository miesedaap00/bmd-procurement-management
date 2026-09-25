<?php

namespace App\Http\Controllers;

use App\Models\PurchaseOrder;
use App\Services\PurchaseOrderExcelService;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PurchaseOrderController extends Controller
{
    private PurchaseOrderExcelService $excelService;

    public function __construct(PurchaseOrderExcelService $excelService)
    {
        $this->excelService = $excelService;
    }

    public function index()
    {
        $purchaseOrders = PurchaseOrder::with('items')
            ->latest()
            ->get();

        return view(
            'purchase-orders.index',
            compact('purchaseOrders')
        );
    }

    public function create()
    {
        return view('purchase-orders.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'po_number' => [
                'required',
                'string',
                'max:255',
                'unique:purchase_orders,po_number',
            ],
            'vendor_name' => [
                'required',
                'string',
                'max:255',
            ],
            'vendor_address' => [
                'required',
                'string',
            ],
            'po_date' => [
                'required',
                'date',
            ],
            'currency' => [
                'required',
                'string',
                'max:10',
            ],
            'discount' => [
                'required',
                'numeric',
                'min:0',
            ],
            'vat' => [
                'required',
                'numeric',
                'min:0',
                'max:100',
            ],
            'freight_cost' => [
                'required',
                'numeric',
                'min:0',
            ],
            'contact_person' => [
                'nullable',
                'string',
                'max:255',
            ],
            'term_of_payment' => [
                'nullable',
                'string',
            ],
            'items' => [
                'required',
                'array',
                'min:1',
            ],
            'items.*.description' => [
                'required',
                'string',
            ],
            'items.*.quantity' => [
                'required',
                'numeric',
                'gt:0',
            ],
            'items.*.unit' => [
                'required',
                'string',
                'max:50',
            ],
            'items.*.price' => [
                'required',
                'numeric',
                'min:0',
            ],
        ]);

        $purchaseOrder = DB::transaction(function () use ($validated) {

            $purchaseOrder = PurchaseOrder::create([
                'po_number' => $validated['po_number'],
                'vendor_name' => $validated['vendor_name'],
                'vendor_address' => $validated['vendor_address'],
                'po_date' => $validated['po_date'],
                'currency' => $validated['currency'],
                'discount' => $validated['discount'],
                'vat' => $validated['vat'],
                'freight_cost' => $validated['freight_cost'],
                'contact_person' => $validated['contact_person'] ?? null,
                'term_of_payment' => $validated['term_of_payment'] ?? null,
                'status' => 'pending',
            ]);

            foreach ($validated['items'] as $item) {

                $total = $item['quantity'] * $item['price'];

                $purchaseOrder->items()->create([
                    'description' => $item['description'],
                    'quantity' => $item['quantity'],
                    'unit' => $item['unit'],
                    'price' => $item['price'],
                    'total' => $total,
                ]);
            }

            return $purchaseOrder;
        });

        $purchaseOrder->load('items');

        $filePath = $this->excelService->generate(
            $purchaseOrder
        );

        $purchaseOrder->update([
            'file_path' => $filePath,
        ]);

        return redirect()
            ->route('purchase-orders.index')
            ->with(
                'success',
                'Purchase Order berhasil dibuat.'
            );
    }

    public function updateStatus(
        Request $request,
        PurchaseOrder $purchaseOrder
    ) {
        $validated = $request->validate([
            'status' => [
                'required',
                'in:pending,approved,completed',
            ],
        ]);

        $purchaseOrder->update([
            'status' => $validated['status'],
        ]);

        return redirect()
            ->route('purchase-orders.index')
            ->with(
                'success',
                'Status Purchase Order berhasil diperbarui.'
            );
    }

    public function download(PurchaseOrder $purchaseOrder)
    {
        if (!$purchaseOrder->file_path) {
            return redirect()
                ->route('purchase-orders.index')
                ->with(
                    'error',
                    'File Purchase Order belum tersedia.'
                );
        }

        $disk = Storage::disk('local');

        if (!$disk->exists($purchaseOrder->file_path)) {
            return redirect()
                ->route('purchase-orders.index')
                ->with(
                    'error',
                    'File Purchase Order tidak ditemukan.'
                );
        }

        $safeFileName = preg_replace(
            '/[^A-Za-z0-9._-]+/',
            '_',
            $purchaseOrder->po_number
        );

        return $disk->download(
            $purchaseOrder->file_path,
            $safeFileName . '.xlsx'
        );
    }
}