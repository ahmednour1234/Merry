<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    protected $connection = 'system';

    public function up(): void
    {
        Schema::connection($this->connection)->create('office_status_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('office_id');
            $table->unsignedBigInteger('admin_user_id')->nullable();
            $table->string('action', 64); // stopped, reactivated, blocked, unblocked
            $table->text('reason')->nullable();
            $table->text('message')->nullable();
            $table->boolean('old_active')->nullable();
            $table->boolean('old_blocked')->nullable();
            $table->boolean('new_active')->nullable();
            $table->boolean('new_blocked')->nullable();
            $table->boolean('email_sent')->default(false);
            $table->timestamp('created_at')->nullable();
            $table->softDeletes();

            $table->index('office_id');
            $table->index('admin_user_id');
            $table->index('action');
            $table->index('created_at');
        });
    }

    public function down(): void
    {
        Schema::connection($this->connection)->dropIfExists('office_status_logs');
    }
};
