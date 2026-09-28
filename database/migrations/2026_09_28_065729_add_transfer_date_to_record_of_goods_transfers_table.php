<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('record_of_goods_transfers', function (Blueprint $table) {
            $table->date('transfer_date')
                ->nullable()
                ->after('record_number');
        });
    }

    public function down(): void
    {
        Schema::table('record_of_goods_transfers', function (Blueprint $table) {
            $table->dropColumn('transfer_date');
        });
    }
};