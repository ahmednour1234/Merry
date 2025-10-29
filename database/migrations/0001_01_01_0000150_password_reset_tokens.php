<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    protected $connection = 'system';

    public function up(): void
    {
        Schema::connection($this->connection)->table('password_reset_tokens', function (Blueprint $t) {
            if (!Schema::connection($this->connection)->hasColumn('password_reset_tokens', 'code_hash')) {
                $t->string('code_hash', 191)->nullable()->after('token');
            }
            if (!Schema::connection($this->connection)->hasColumn('password_reset_tokens', 'expires_at')) {
                $t->timestamp('expires_at')->nullable()->after('code_hash');
            }
            if (!Schema::connection($this->connection)->hasColumn('password_reset_tokens', 'attempts')) {
                $t->unsignedSmallInteger('attempts')->default(0)->after('expires_at');
            }
            if (!Schema::connection($this->connection)->hasColumn('password_reset_tokens', 'updated_at')) {
                $t->timestamp('updated_at')->nullable()->after('created_at');
            }
        });
    }

    public function down(): void
    {
        Schema::connection($this->connection)->table('password_reset_tokens', function (Blueprint $t) {
            if (Schema::connection($this->connection)->hasColumn('password_reset_tokens', 'code_hash')) {
                $t->dropColumn('code_hash');
            }
            if (Schema::connection($this->connection)->hasColumn('password_reset_tokens', 'expires_at')) {
                $t->dropColumn('expires_at');
            }
            if (Schema::connection($this->connection)->hasColumn('password_reset_tokens', 'attempts')) {
                $t->dropColumn('attempts');
            }
            if (Schema::connection($this->connection)->hasColumn('password_reset_tokens', 'updated_at')) {
                $t->dropColumn('updated_at');
            }
        });
    }
};
