<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    protected $connection = 'system';

    public function up(): void
    {
        Schema::connection($this->connection)->create('currencies', function (Blueprint $t) {
            $t->string('code', 8)->primary();
            $t->string('name', 64);
            $t->string('symbol', 16)->nullable();
            $t->tinyInteger('decimal')->default(2);
            $t->boolean('active')->default(true);
            $t->timestamps();
            $t->softDeletes();

            $t->index(['active']);
        });
    }

    public function down(): void
    {
        Schema::connection($this->connection)->dropIfExists('currencies');
    }
};
