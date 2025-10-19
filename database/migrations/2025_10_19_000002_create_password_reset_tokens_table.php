<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    protected $connection = 'system';

    public function up(): void
    {
        if (!Schema::connection($this->connection)->hasTable('password_reset_tokens')) {
            Schema::connection($this->connection)->create('password_reset_tokens', function (Blueprint $t) {
                $t->string('email')->index();
                $t->string('token');
                $t->timestamp('created_at')->nullable();
            });
        }
    }

    public function down(): void
    {
        Schema::connection($this->connection)->dropIfExists('password_reset_tokens');
    }
};
