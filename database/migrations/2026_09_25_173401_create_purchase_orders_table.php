<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('purchase_orders', function (Blueprint $table) {
            $table->id();
            $table->string('po_number')->unique();
            $table->string('vendor_name');
            $table->text('vendor_address');
            $table->date('po_date');
            $table->string('currency', 10);
            $table->decimal('discount', 15, 2)->default(0);
            $table->decimal('vat', 5, 2)->default(0);
            $table->decimal('freight_cost', 15, 2)->default(0);
            $table->string('contact_person')->nullable();
            $table->text('term_of_payment')->nullable();
            $table->enum('status', [
                'pending',
                'approved',
                'completed',
            ])->default('pending');
            $table->string('file_path')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('purchase_orders');
    }
};