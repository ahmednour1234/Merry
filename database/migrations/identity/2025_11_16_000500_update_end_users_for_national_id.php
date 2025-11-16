<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    protected $connection = 'identity';

    public function up(): void
    {
        // Add national_id (nullable) if not exists (avoid empty-string duplicates on existing rows)
        Schema::connection($this->connection)->table('end_users', function (Blueprint $table) {
            if (!Schema::connection($this->connection)->hasColumn('end_users', 'national_id')) {
                $table->string('national_id', 191)->nullable()->after('id');
            }
        });

        // Ensure any empty-string values are converted to NULL before adding unique index
        try {
            DB::connection($this->connection)->statement("UPDATE end_users SET national_id = NULL WHERE national_id = ''");
        } catch (\Throwable $e) {
            // ignore if statement fails (e.g., column not present yet)
        }

        // Add unique index on national_id (allows multiple NULLs)
        try {
            Schema::connection($this->connection)->table('end_users', function (Blueprint $table) {
                // Using schema builder to create the unique index
                $table->unique('national_id');
            });
        } catch (\Throwable $e) {
            // ignore if index already exists
        }

        // Make email nullable (keep unique) and adjust phone length + drop unique constraint on phone
        // Use raw statements to avoid requiring doctrine/dbal
        try {
            DB::connection($this->connection)->statement('ALTER TABLE end_users MODIFY email VARCHAR(191) NULL');
        } catch (\Throwable $e) {
            // ignore if already nullable or ALTER not supported in environment
        }

        try {
            // drop unique index on phone if exists (default name convention)
            DB::connection($this->connection)->statement('ALTER TABLE end_users DROP INDEX end_users_phone_unique');
        } catch (\Throwable $e) {
            // ignore if not exists
        }

        try {
            DB::connection($this->connection)->statement('ALTER TABLE end_users MODIFY phone VARCHAR(20) NULL');
        } catch (\Throwable $e) {
            // ignore if cannot modify
        }
    }

    public function down(): void
    {
        // Revert national_id column
        Schema::connection($this->connection)->table('end_users', function (Blueprint $table) {
            if (Schema::connection($this->connection)->hasColumn('end_users', 'national_id')) {
                $table->dropUnique(['national_id']);
                $table->dropColumn('national_id');
            }
        });

        // Best-effort revert for email/phone; do not enforce re-adding unique on phone automatically
    }
};




