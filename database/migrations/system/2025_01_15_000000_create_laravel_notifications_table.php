<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    protected $connection = 'system';

    public function up(): void
    {
        $schema = Schema::connection($this->connection);
        
        if ($schema->hasTable('notifications') && $schema->hasColumn('notifications', 'notifiable_type')) {
            return;
        }

        if ($schema->hasTable('notifications') && !$schema->hasColumn('notifications', 'notifiable_type')) {
            $schema->rename('notifications', 'custom_notifications');
        }

        if (!$schema->hasTable('notifications')) {
            $schema->create('notifications', function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->string('type');
                $table->morphs('notifiable');
                $table->text('data');
                $table->timestamp('read_at')->nullable();
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        $schema = Schema::connection($this->connection);
        $schema->dropIfExists('notifications');
        
        if ($schema->hasTable('custom_notifications')) {
            $schema->rename('custom_notifications', 'notifications');
        }
    }
};
