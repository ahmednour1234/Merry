<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    protected $connection = 'identity';

    public function up(): void
    {
        if (Schema::connection($this->connection)->hasTable('password_reset_tokens')) {
            return;
        }

        Schema::connection($this->connection)->create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email', 191)->index();
            $table->string('token', 191)->nullable();
            $table->string('code_hash', 191)->nullable();
            $table->timestamp('expires_at')->nullable();
            $table->unsignedSmallInteger('attempts')->default(0);
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }

    public function down(): void
    {
        Schema::connection($this->connection)->dropIfExists('password_reset_tokens');
    }
};


