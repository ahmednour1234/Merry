<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    protected $connection = 'system';

    public function up(): void
    {
        Schema::connection($this->connection)->table('role_user', function (Blueprint $t) {
            if (!Schema::connection($this->connection)->hasColumn('role_user', 'created_at')) {
                $t->timestamp('created_at')->nullable();
            }
            if (!Schema::connection($this->connection)->hasColumn('role_user', 'updated_at')) {
                $t->timestamp('updated_at')->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::connection($this->connection)->table('role_user', function (Blueprint $t) {
            if (Schema::connection($this->connection)->hasColumn('role_user', 'created_at')) {
                $t->dropColumn('created_at');
            }
            if (Schema::connection($this->connection)->hasColumn('role_user', 'updated_at')) {
                $t->dropColumn('updated_at');
            }
        });
    }
};
