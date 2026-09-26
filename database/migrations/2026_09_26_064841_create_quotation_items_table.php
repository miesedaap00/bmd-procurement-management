<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('quotation_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('quotation_id')
                ->constrained('quotations')
                ->cascadeOnDelete();
            $table->string('item');
            $table->text('specification')->nullable();
            $table->string('brand')->nullable();
            $table->decimal('quantity', 15, 2);
            $table->decimal('price', 15, 2);
            $table->decimal('total', 15, 2);
            $table->text('note')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('quotation_items');
    }
};