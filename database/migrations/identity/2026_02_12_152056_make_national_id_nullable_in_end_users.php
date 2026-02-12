<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    protected $connection = 'identity';

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Convert any empty strings to NULL before modifying column
        try {
            DB::connection($this->connection)->statement("UPDATE end_users SET national_id = NULL WHERE national_id = ''");
        } catch (\Throwable $e) {
            // ignore if statement fails
        }

        // Ensure national_id is nullable
        Schema::connection($this->connection)->table('end_users', function (Blueprint $table) {
            if (Schema::connection($this->connection)->hasColumn('end_users', 'national_id')) {
                $table->string('national_id', 191)->nullable()->change();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Note: We don't enforce non-nullable in down() to avoid data loss
        // If needed, this can be handled separately
    }
};
