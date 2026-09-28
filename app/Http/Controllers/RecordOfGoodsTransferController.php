<?php

namespace App\Http\Controllers;

use App\Models\RecordOfGoodsTransfer;
use App\Services\RecordOfGoodsTransferWordService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class RecordOfGoodsTransferController extends Controller
{
    private RecordOfGoodsTransferWordService $wordService;

    public function __construct(
        RecordOfGoodsTransferWordService $wordService
    ) {
        $this->wordService = $wordService;
    }

    public function index()
    {
        $records = RecordOfGoodsTransfer::with('items')
            ->latest()
            ->get();

        return view(
            'record-of-goods-transfers.index',
            compact('records')
        );
    }

    public function create()
    {
        return view(
            'record-of-goods-transfers.create'
        );
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'record_number' => [
                'required',
                'string',
                'max:255',
                'unique:record_of_goods_transfers,record_number',
            ],
            'transfer_date' => [
                'required',
                'date',
            ],
            'recipient_name' => [
                'required',
                'string',
                'max:255',
            ],
            'recipient_position' => [
                'required',
                'string',
                'max:255',
            ],
            'recipient_company' => [
                'required',
                'string',
                'max:255',
            ],
            'items' => [
                'required',
                'array',
                'min:1',
            ],
            'items.*.nama_barang' => [
                'required',
                'string',
                'max:255',
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
            'items.*.satuan' => [
                'required',
                'string',
                'max:50',
            ],
            'items.*.kondisi' => [
                'required',
                'string',
                'max:255',
            ],
        ]);

        $record = DB::transaction(function () use ($validated) {

            $record = RecordOfGoodsTransfer::create([
                'record_number' =>
                    $validated['record_number'],
                'transfer_date' =>
                    $validated['transfer_date'],
                'recipient_name' =>
                    $validated['recipient_name'],
                'recipient_position' =>
                    $validated['recipient_position'],
                'recipient_company' =>
                    $validated['recipient_company'],
            ]);

            foreach ($validated['items'] as $item) {
                $record->items()->create([
                    'nama_barang' =>
                        $item['nama_barang'],
                    'brand' =>
                        $item['brand'] ?? null,
                    'quantity' =>
                        $item['quantity'],
                    'satuan' =>
                        $item['satuan'],
                    'kondisi' =>
                        $item['kondisi'],
                ]);
            }

            return $record;
        });

        $record->load('items');

        $filePath = $this->wordService->generate(
            $record
        );

        $record->update([
            'file_path' => $filePath,
        ]);

        return redirect()
            ->route('record-of-goods-transfers.index')
            ->with(
                'success',
                'Record of Goods Transfer berhasil dibuat.'
            );
    }

    public function download(
        RecordOfGoodsTransfer $recordOfGoodsTransfer
    ) {
        if (!$recordOfGoodsTransfer->file_path) {
            return redirect()
                ->route(
                    'record-of-goods-transfers.index'
                )
                ->with(
                    'error',
                    'File Record of Goods Transfer belum tersedia.'
                );
        }

        $disk = Storage::disk('local');

        if (!$disk->exists(
            $recordOfGoodsTransfer->file_path
        )) {
            return redirect()
                ->route(
                    'record-of-goods-transfers.index'
                )
                ->with(
                    'error',
                    'File Record of Goods Transfer tidak ditemukan.'
                );
        }

        $safeFileName = preg_replace(
            '/[^A-Za-z0-9._-]+/',
            '_',
            $recordOfGoodsTransfer->record_number
        );

        return $disk->download(
            $recordOfGoodsTransfer->file_path,
            $safeFileName . '.docx'
        );
    }
}