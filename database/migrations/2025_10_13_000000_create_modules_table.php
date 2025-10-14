// database/migrations/2025_10_13_000000_create_modules_table.php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    protected $connection = 'system';

    public function up(): void
    {
        Schema::connection($this->connection)->create('modules', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('namespace')->nullable();
            $table->string('provider')->nullable();
            $table->string('path')->nullable();
            $table->boolean('enabled')->default(true);
            $table->json('meta')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::connection($this->connection)->dropIfExists('modules');
    }
};
