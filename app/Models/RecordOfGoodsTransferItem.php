<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RecordOfGoodsTransferItem extends Model
{
    protected $fillable = [
        'record_of_goods_transfer_id',
        'nama_barang',
        'brand',
        'quantity',
        'satuan',
        'kondisi',
    ];

    protected $casts = [
        'quantity' => 'decimal:2',
    ];

    public function recordOfGoodsTransfer(): BelongsTo
    {
        return $this->belongsTo(
            RecordOfGoodsTransfer::class
        );
    }
}