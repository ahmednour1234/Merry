<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    protected $connection = 'system';

    public function up(): void
    {
        Schema::connection($this->connection)->create('categories', function (Blueprint $t) {
            $t->bigIncrements('id');
            $t->unsignedBigInteger('parent_id')->nullable();
            $t->string('slug', 191)->nullable()->unique();
            $t->string('name');                 // اسم افتراضي (مثلاً en)
            $t->boolean('active')->default(true);
            $t->json('meta')->nullable();
            $t->timestamps();
            $t->softDeletes();

            $t->foreign('parent_id')->references('id')->on('categories')->nullOnDelete();

            $t->index(['parent_id']);
            $t->index(['active']);
            $t->index(['name']);
            $t->index(['created_at']);
        });
    }

    public function down(): void
    {
        Schema::connection($this->connection)->dropIfExists('categories');
    }
};
