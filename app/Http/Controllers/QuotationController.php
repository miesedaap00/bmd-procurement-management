<?php

namespace App\Http\Controllers;

use App\Models\Quotation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QuotationController extends Controller
{
    public function index()
    {
        $quotations = Quotation::with('items')
            ->latest()
            ->get();

        return view(
            'quotations.index',
            compact('quotations')
        );
    }

    public function create()
    {
        return view('quotations.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'quotation_number' => [
                'required',
                'string',
                'max:255',
                'unique:quotations,quotation_number',
            ],
            'quotation_date' => [
                'required',
                'date',
            ],
            'client_name' => [
                'required',
                'string',
                'max:255',
            ],
            'client_address' => [
                'required',
                'string',
            ],
            'items' => [
                'required',
                'array',
                'min:1',
            ],
            'items.*.item' => [
                'required',
                'string',
                'max:255',
            ],
            'items.*.specification' => [
                'nullable',
                'string',
            ],
            'items.*.brand' => [
                'nullable',
                'string',
                'max:255',
            ],
            'items.*.quantity' => [
                'required',
                'numeric',
                'gt:0',
            ],
            'items.*.price' => [
                'required',
                'numeric',
                'min:0',
            ],
            'items.*.note' => [
                'nullable',
                'string',
            ],
        ]);

        $quotation = DB::transaction(function () use ($validated) {

            $quotation = Quotation::create([
                'quotation_number' => $validated['quotation_number'],
                'client_name' => $validated['client_name'],
                'client_address' => $validated['client_address'],
                'quotation_date' => $validated['quotation_date'],
            ]);

            foreach ($validated['items'] as $item) {

                $quantity = (float) $item['quantity'];
                $price = (float) $item['price'];
                $total = $quantity * $price;

                $quotation->items()->create([
                    'item' => $item['item'],
                    'specification' => $item['specification'] ?? null,
                    'brand' => $item['brand'] ?? null,
                    'quantity' => $quantity,
                    'price' => $price,
                    'total' => $total,
                    'note' => $item['note'] ?? null,
                ]);
            }

            return $quotation;
        });

        return redirect()
            ->route('quotations.index')
            ->with(
                'success',
                'Quotation berhasil dibuat.'
            );
    }
}