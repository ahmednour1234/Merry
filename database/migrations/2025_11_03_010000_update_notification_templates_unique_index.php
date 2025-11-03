<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    protected $connection = 'system';

    public function up(): void
    {
        Schema::connection($this->connection)->table('notification_templates', function (Blueprint $table) {
            // Drop old unique index on `key`
            $table->dropUnique('notification_templates_key_unique');
        });

        Schema::connection($this->connection)->table('notification_templates', function (Blueprint $table) {
            // Add composite unique on (key, channel)
            $table->unique(['key','channel'], 'notification_templates_key_channel_unique');
        });
    }

    public function down(): void
    {
        Schema::connection($this->connection)->table('notification_templates', function (Blueprint $table) {
            $table->dropUnique('notification_templates_key_channel_unique');
        });

        Schema::connection($this->connection)->table('notification_templates', function (Blueprint $table) {
            $table->unique('key', 'notification_templates_key_unique');
        });
    }
};


