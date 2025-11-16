<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    protected $connection = 'identity';

    public function up(): void
    {
        Schema::connection($this->connection)->table('end_users', function (Blueprint $table) {
            if (Schema::connection($this->connection)->hasColumn('end_users', 'email')) {
                $table->dropColumn('email');
            }
            if (Schema::connection($this->connection)->hasColumn('end_users', 'email_verified_at')) {
                $table->dropColumn('email_verified_at');
            }
        });
    }

    public function down(): void
    {
        Schema::connection($this->connection)->table('end_users', function (Blueprint $table) {
            if (!Schema::connection($this->connection)->hasColumn('end_users', 'email')) {
                $table->string('email', 191)->nullable()->unique();
            }
            if (!Schema::connection($this->connection)->hasColumn('end_users', 'email_verified_at')) {
                $table->timestamp('email_verified_at')->nullable();
            }
        });
    }
};



