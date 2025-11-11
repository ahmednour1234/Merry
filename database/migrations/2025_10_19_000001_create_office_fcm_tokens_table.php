<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    protected $connection = 'system';

    public function up(): void
    {
        Schema::connection($this->connection)->create('office_fcm_tokens', function (Blueprint $t) {
            $t->id();
            $t->unsignedBigInteger('office_id');
            $t->string('token', 512)->unique();
            $t->string('device', 191)->nullable(); // ios / android / web
            $t->string('platform', 191)->nullable(); // اختياري
            $t->timestamps();

            $t->index(['office_id']);
            // FK اختياري حسب نسختك
            // $t->foreign('office_id')->references('id')->on('offices')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::connection($this->connection)->dropIfExists('office_fcm_tokens');
    }
};
