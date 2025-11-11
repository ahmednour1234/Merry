<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    protected $connection = 'system';

    public function up(): void
    {
        Schema::connection($this->connection)->create('plan_features', function (Blueprint $t) {
            $t->id();
            $t->string('plan_code', 64);
            $t->string('feature_key', 64);     // مثال: cv.limit, orders.limit, upload.allowed
            $t->integer('limit')->nullable();  // null = unlimited أو غير عددي
            $t->json('value')->nullable();     // بديل/إضافي لقيم غير رقمية (boolean/strings/array)
            $t->boolean('active')->default(true);
            $t->timestamps();

            $t->unique(['plan_code','feature_key']);
            $t->index(['active']);
        });
    }

    public function down(): void
    {
        Schema::connection($this->connection)->dropIfExists('plan_features');
    }
};
