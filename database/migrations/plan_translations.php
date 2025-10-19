<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    protected $connection = 'system';

    public function up(): void
    {
        Schema::connection($this->connection)->create('plan_translations', function (Blueprint $t) {
            $t->id();
            $t->string('plan_code', 64);
            $t->string('lang_code', 12);        // من system_languages
            $t->string('name');
            $t->text('description')->nullable();
            $t->timestamps();

            $t->unique(['plan_code','lang_code']);
            $t->index(['lang_code']);
        });
    }

    public function down(): void
    {
        Schema::connection($this->connection)->dropIfExists('plan_translations');
    }
};
