<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    protected $connection = 'system';

    public function up(): void
    {
        Schema::connection($this->connection)->table('nationalities', function (Blueprint $table) {
            if (!Schema::connection($this->connection)->hasColumn('nationalities', 'code')) {
                $table->string('code', 8)->nullable()->after('name');
            } else {
                DB::connection($this->connection)->statement('ALTER TABLE nationalities MODIFY code VARCHAR(8) NULL');
            }
        });
    }

    public function down(): void
    {
        Schema::connection($this->connection)->table('nationalities', function (Blueprint $table) {
            $table->dropColumn('code');
        });
    }
};

