<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    protected $connection = 'system';

    public function up(): void
    {
        Schema::connection($this->connection)->create('audit_logs', function (Blueprint $t) {
            $t->id();
            $t->unsignedBigInteger('tenant_id')->nullable();
            $t->unsignedBigInteger('user_id')->nullable();
            $t->string('action', 64)->nullable();
            $t->string('model', 191)->nullable();
            $t->unsignedBigInteger('model_id')->nullable();
            $t->json('request')->nullable();
            $t->json('changes')->nullable();
            $t->string('ip', 64)->nullable();
            $t->string('ua', 255)->nullable();
            $t->boolean('active')->default(true);
            $t->timestamp('created_at')->nullable();
            $t->softDeletes();

            $t->index(['tenant_id']);
            $t->index(['user_id']);
            $t->index(['model', 'model_id']);
            $t->index(['action']);
            $t->index(['active']);
        });
    }

    public function down(): void
    {
        Schema::connection($this->connection)->dropIfExists('audit_logs');
    }
};
