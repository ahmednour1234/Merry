<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    protected $connection = 'system';

    public function up(): void
    {
        Schema::connection($this->connection)->create('coupons', function (Blueprint $t) {
            $t->id();
            $t->string('code', 64)->unique();
            $t->enum('type', ['percent','fixed'])->default('percent');
            $t->decimal('amount', 12, 2);            // لو percent = 10 (يعني 10%), لو fixed = 50 (عملة أدناه)
            $t->string('currency_code', 8)->nullable(); // مستخدمة فقط لو type=fixed
            $t->dateTime('starts_at')->nullable();
            $t->dateTime('ends_at')->nullable();
            $t->integer('max_redemptions')->nullable();   // null = بدون حد
            $t->integer('per_office_limit')->nullable();  // null = بدون حد
            $t->boolean('active')->default(true);
            $t->json('meta')->nullable();                 // شروط إضافية (خطط محددة …)
            $t->timestamps();
            $t->softDeletes();
        });

        Schema::connection($this->connection)->create('coupon_redemptions', function (Blueprint $t) {
            $t->id();
            $t->unsignedBigInteger('coupon_id');
            $t->unsignedBigInteger('office_id');
            $t->string('plan_code', 64);
            $t->decimal('discount_value', 12, 2)->default(0);
            $t->string('currency_code', 8)->default('USD');
            $t->timestamps();

            $t->index(['coupon_id','office_id']);
        });
    }

    public function down(): void
    {
        Schema::connection($this->connection)->dropIfExists('coupon_redemptions');
        Schema::connection($this->connection)->dropIfExists('coupons');
    }
};
