<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RecordOfGoodsTransfer extends Model
{
    protected $fillable = [
        'record_number',
        'transfer_date',
        'recipient_name',
        'recipient_position',
        'recipient_company',
        'file_path',
    ];

    protected $casts = [
        'transfer_date' => 'date',
    ];

    public function items(): HasMany
    {
        return $this->hasMany(
            RecordOfGoodsTransferItem::class
        );
    }
}