<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    protected $connection = 'system';

    public function up(): void
    {
        Schema::connection($this->connection)->create('insurance_companies', function (Blueprint $t) {
            $t->id();
            $t->string('name');
            $t->string('website')->nullable();
            $t->string('logo_path')->nullable(); // storage path (public disk)
            $t->boolean('active')->default(true);
            $t->timestamps();
            $t->softDeletes();

            $t->index(['active']);
            $t->index(['created_at']);
            $t->index(['name']);
        });
    }

    public function down(): void
    {
        Schema::connection($this->connection)->dropIfExists('insurance_companies');
    }
};
