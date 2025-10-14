<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    protected $connection = 'system';

    public function up(): void
    {
        if (Schema::connection($this->connection)->hasTable('modules')) {
            Schema::connection($this->connection)->table('modules', function (Blueprint $t) {
                if (!Schema::connection($this->connection)->hasColumn('modules', 'deleted_at')) {
                    $t->softDeletes(); // يضيف deleted_at nullable
                }
            });
        }
    }

    public function down(): void
    {
        if (Schema::connection($this->connection)->hasTable('modules')) {
            Schema::connection($this->connection)->table('modules', function (Blueprint $t) {
                if (Schema::connection($this->connection)->hasColumn('modules', 'deleted_at')) {
                    $t->dropSoftDeletes();
                }
            });
        }
    }
};
