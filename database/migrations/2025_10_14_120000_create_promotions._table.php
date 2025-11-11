<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    protected $connection = 'system';

    public function up(): void
    {
        Schema::connection($this->connection)->create('promotions', function (Blueprint $t) {
            $t->id();
            $t->string('name');
            $t->string('plan_code', 64)->nullable();  // null = على كل الخطط
            $t->enum('type', ['percent','fixed'])->default('percent');
            $t->decimal('amount', 12, 2);
            $t->string('currency_code', 8)->nullable(); // للـ fixed
            $t->dateTime('starts_at')->nullable();
            $t->dateTime('ends_at')->nullable();
            $t->boolean('auto_apply')->default(true);
            $t->boolean('active')->default(true);
            $t->json('meta')->nullable();           // شروط إضافية
            $t->timestamps();
            $t->softDeletes();

            $t->index(['active','plan_code']);
        });
    }

    public function down(): void
    {
        Schema::connection($this->connection)->dropIfExists('promotions');
    }
};
