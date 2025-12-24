<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            // HAPUS kolom lama
            $table->dropForeign(['product_id']);
            $table->dropColumn(['product_id','qty','price']);

            // total & status sudah ada → BIARKAN
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->foreignId('product_id')->constrained();
            $table->integer('qty');
            $table->decimal('price',12,2);
        });
    }
};
