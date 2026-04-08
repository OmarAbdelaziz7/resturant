<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->cascadeOnDelete();
        // $table->foreignId('coupon_id')->nullable()->constrained()->nullOnDelete();
        $table->enum('status', [
            'pending',      // في الانتظار
            'confirmed',    // تم التأكيد
            'preparing',    // قيد التحضير
            'out_for_delivery', // خارج للتوصيل
            'delivered',    // تم التسليم
            'cancelled',    // ملغي
        ])->default('pending');
        $table->enum('payment_method', ['cash', 'card'])->default('cash');
        $table->enum('payment_status', ['pending', 'paid'])->default('pending');
        $table->decimal('subtotal', 8, 2);     // قبل الخصم
        $table->decimal('discount', 8, 2)->default(0); // قيمة الخصم
        $table->decimal('delivery_fee', 8, 2)->default(0);
        $table->decimal('total', 8, 2);         // الإجمالي النهائي
        $table->string('address');
        $table->string('phone');
        $table->text('notes')->nullable();
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
