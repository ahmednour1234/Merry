<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    protected $connection = 'system';

    public function up(): void
    {
        Schema::connection($this->connection)->create('plans', function (Blueprint $t) {
            $t->string('code', 64)->primary();          // مثل: free, pro, enterprise
            $t->string('name');                          // اسم افتراضي (en) – عندنا ترجمات منفصلة
            $t->text('description')->nullable();
            $t->string('base_currency', 8)->default('USD');
            $t->decimal('base_price', 12, 2)->default(0); // سعر افتراضي بعملة base

            $t->enum('billing_cycle', ['monthly','annual'])->default('monthly');
            $t->boolean('active')->default(true);
            $t->json('meta')->nullable();               // أي بيانات إضافية
            $t->timestamps();
            $t->softDeletes();

            $t->index(['active','billing_cycle']);
        });
    }

    public function down(): void
    {
        Schema::connection($this->connection)->dropIfExists('plans');
    }
};
