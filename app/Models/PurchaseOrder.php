<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PurchaseOrder extends Model
{
    protected $fillable = [
        'po_number',
        'vendor_name',
        'vendor_address',
        'po_date',
        'currency',
        'discount',
        'vat',
        'freight_cost',
        'contact_person',
        'term_of_payment',
        'status',
        'file_path',
    ];

    protected $casts = [
        'po_date' => 'date',
        'discount' => 'decimal:2',
        'vat' => 'decimal:2',
        'freight_cost' => 'decimal:2',
    ];

    public function items(): HasMany
    {
        return $this->hasMany(PurchaseOrderItem::class);
    }
}