<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    protected $connection = 'system';

    public function up(): void
    {
        Schema::connection($this->connection)->create('office_subscriptions', function (Blueprint $t) {
            $t->id();
            $t->unsignedBigInteger('office_id');
            $t->string('plan_code', 64);

            $t->enum('status', ['active','cancelled','expired','pending'])->default('active');
            $t->boolean('auto_renew')->default(false);

            $t->dateTime('starts_at');
            $t->dateTime('ends_at');

            // snapshot للسعر/العملة وقت الشراء (لو احتجت مرجعية فواتير/تقارير)
            $t->string('currency_code', 8)->default('USD');
            $t->decimal('price', 12, 2)->default(0);

            $t->json('meta')->nullable();     // مثل: payment_method, invoice_id…
            $t->boolean('active')->default(true);
            $t->timestamps();
            $t->softDeletes();

            $t->index(['office_id','status','auto_renew']);
            $t->index(['plan_code']);
        });
    }

    public function down(): void
    {
        Schema::connection($this->connection)->dropIfExists('office_subscriptions');
    }
};
