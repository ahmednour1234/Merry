<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    protected $connection = 'system';

    public function up(): void
    {
        Schema::connection($this->connection)->create('pages', function (Blueprint $t) {
            $t->bigIncrements('id');
            $t->string('slug', 64)->unique(); // e.g. about, privacy, policy
            $t->boolean('active')->default(true);
            $t->json('meta')->nullable();
            $t->timestamps();
            $t->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::connection($this->connection)->dropIfExists('pages');
    }
};


