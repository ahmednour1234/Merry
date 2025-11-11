<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    // خليها على نفس اتصالك
    protected $connection = 'system';

    public function up(): void
    {
        $schema = Schema::connection($this->connection);

        // لو الجدول موجود – اخرج بهدوء
        if ($schema->hasTable('personal_access_tokens')) {
            return;
        }

        $schema->create('personal_access_tokens', function (Blueprint $table) {
            $table->id();
            $table->morphs('tokenable');
            $table->string('name');
            $table->string('token', 64)->unique();
            $table->text('abilities')->nullable();
            $table->timestamp('last_used_at')->nullable();
            $table->timestamp('expires_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::connection($this->connection)->dropIfExists('personal_access_tokens');
    }
};
