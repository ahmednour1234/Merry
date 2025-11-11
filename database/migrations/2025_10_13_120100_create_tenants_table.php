<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    protected $connection = 'system';

    public function up(): void
    {
        Schema::connection($this->connection)->create('tenants', function (Blueprint $t) {
            $t->id();
            $t->string('code', 64)->unique();
            $t->string('name', 191)->nullable();
            $t->string('default_locale', 12)->default('en');
            $t->string('default_currency', 8)->default('USD');
            $t->string('timezone', 64)->default('UTC');
            $t->boolean('active')->default(true);
            $t->json('meta')->nullable();
            $t->timestamps();
        });
    }

    public function down(): void
    {
        Schema::connection($this->connection)->dropIfExists('tenants');
    }
};
