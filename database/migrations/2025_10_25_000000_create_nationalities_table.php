<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    protected $connection = 'system';

    public function up(): void
    {
        Schema::connection($this->connection)->create('nationalities', function (Blueprint $t) {
            $t->bigIncrements('id');
            $t->string('code', 8)->unique(); // ISO مثل: SA, EG
            $t->string('name');               // اسم افتراضي (مثلاً en)
            $t->boolean('active')->default(true);
            $t->json('meta')->nullable();
            $t->timestamps();
            $t->softDeletes();

            $t->index(['active']);
            $t->index(['name']);
            $t->index(['created_at']);
        });
    }

    public function down(): void
    {
        Schema::connection($this->connection)->dropIfExists('nationalities');
    }
};
