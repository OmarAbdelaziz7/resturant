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
        Schema::create('coupons', function (Blueprint $table) {
        $table->id();
        $table->string('code')->unique();      // BURGER20
        $table->enum('type', ['percentage', 'fixed']); // % أو مبلغ ثابت
        $table->decimal('value', 8, 2);        // 20 أو 50 جنيه
        $table->decimal('min_order', 8, 2)->default(0); // أقل مبلغ للطلب
        $table->integer('max_uses')->nullable();  // عدد مرات الاستخدام
        $table->integer('used_count')->default(0);
        $table->boolean('is_active')->default(true);
        $table->date('expires_at')->nullable();
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coupons');
    }
};
