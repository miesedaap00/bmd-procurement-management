<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('record_of_goods_transfer_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('record_of_goods_transfer_id');
            $table->string('nama_barang');
            $table->string('brand')->nullable();
            $table->decimal('quantity', 15, 2);
            $table->string('satuan', 50);
            $table->string('kondisi');
            $table->timestamps();

            $table->foreign(
                'record_of_goods_transfer_id',
                'rgt_items_rgt_fk'
            )->references('id')
                ->on('record_of_goods_transfers')
                ->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('record_of_goods_transfer_items');
    }
};