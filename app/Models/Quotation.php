<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Quotation extends Model
{
    protected $fillable = [
        'quotation_number',
        'client_name',
        'client_address',
        'quotation_date',
        'file_path',
    ];

    protected $casts = [
        'quotation_date' => 'date',
    ];

    public function items(): HasMany
    {
        return $this->hasMany(QuotationItem::class);
    }
}