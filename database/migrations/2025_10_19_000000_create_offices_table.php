<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    protected $connection = 'system';

    public function up(): void
    {
        Schema::connection($this->connection)->create('offices', function (Blueprint $t) {
            $t->id();
            $t->string('name');
            $t->string('commercial_reg_no', 191)->unique(); // رقم السجل التجاري
            $t->unsignedBigInteger('city_id')->nullable();  // cities.id (system)
            $t->string('address')->nullable();
            $t->string('phone', 32)->nullable();
            $t->string('email', 191)->unique();
            $t->string('password');

            $t->boolean('active')->default(true);
            $t->boolean('blocked')->default(false); // حظر
            $t->timestamp('last_login_at')->nullable();

            $t->rememberToken();
            $t->timestamps();
            $t->softDeletes();

            $t->index(['active','blocked']);
            $t->index(['city_id']);
            $t->index(['created_at']);
        });
    }

    public function down(): void
    {
        Schema::connection($this->connection)->dropIfExists('offices');
    }
};
