<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    protected $connection = 'system';

    public function up(): void
    {
        Schema::connection($this->connection)->create('office_subscription_logs', function (Blueprint $t) {
            $t->id();
            $t->unsignedBigInteger('office_subscription_id');
            $t->string('action', 64);
            $t->json('payload')->nullable();
            $t->unsignedBigInteger('user_id')->nullable();
            $t->timestamps();

            $t->index(['office_subscription_id', 'created_at']);
            $t->foreign('office_subscription_id')->references('id')->on('office_subscriptions')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::connection($this->connection)->dropIfExists('office_subscription_logs');
    }
};
