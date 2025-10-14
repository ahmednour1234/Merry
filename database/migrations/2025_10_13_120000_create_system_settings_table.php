<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    // نخزن على اتصال system
    protected $connection = 'system';

    public function up(): void
    {
        Schema::connection($this->connection)->create('system_settings', function (Blueprint $t) {
            $t->id();
            $t->string('scope', 64);                 // global|tenant:{id}|module:{code}
            $t->string('key', 191);
            $t->json('value')->nullable();
            $t->string('type', 32)->default('json'); // json|string|int|bool
            $t->boolean('active')->default(true);
            $t->timestamps();

            $t->unique(['scope', 'key'], 'uniq_scope_key');
            $t->index(['scope']);
        });
    }

    public function down(): void
    {
        Schema::connection($this->connection)->dropIfExists('system_settings');
    }
};
