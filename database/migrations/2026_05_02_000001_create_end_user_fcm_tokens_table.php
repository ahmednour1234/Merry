<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    protected $connection = 'identity';

    public function up(): void
    {
        Schema::connection($this->connection)->create('end_user_fcm_tokens', function (Blueprint $t) {
            $t->id();
            $t->unsignedBigInteger('end_user_id');
            $t->string('token', 512)->unique();
            $t->string('device', 191)->nullable();   // ios / android / web
            $t->string('platform', 191)->nullable();
            $t->timestamps();

            $t->index(['end_user_id']);
        });
    }

    public function down(): void
    {
        Schema::connection($this->connection)->dropIfExists('end_user_fcm_tokens');
    }
};
