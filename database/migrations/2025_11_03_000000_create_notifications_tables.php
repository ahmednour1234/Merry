<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->string('type')->nullable();
            $table->string('title');
            $table->text('body')->nullable();
            $table->json('data')->nullable();
            $table->string('priority')->default('normal');
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });

        Schema::create('notification_templates', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->string('channel'); // inapp|email
            $table->string('subject')->nullable();
            $table->text('body');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('notification_recipients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('notification_id')->constrained('notifications')->cascadeOnDelete();
            $table->string('recipient_type'); // user|office|role
            $table->unsignedBigInteger('recipient_id')->nullable();
            $table->foreignId('resolved_user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('channel'); // inapp|email
            $table->string('status')->default('queued'); // queued|sent|failed|read
            $table->timestamp('read_at')->nullable();
            $table->timestamp('sent_at')->nullable();
            $table->text('error')->nullable();
            $table->timestamps();

            $table->index(['recipient_type', 'recipient_id']);
            $table->index(['resolved_user_id']);
            $table->index(['channel', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('notification_recipients');
        Schema::dropIfExists('notification_templates');
        Schema::dropIfExists('notifications');
    }
};


