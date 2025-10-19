<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    protected $connection = 'system';

    public function up(): void
    {
        Schema::connection($this->connection)->create('usage_counters', function (Blueprint $t) {
            $t->id();
            $t->unsignedBigInteger('office_id');
            $t->string('feature_key', 64);   // cv.limit / orders.limit
            $t->string('period_key', 16);    // YYYYMM
            $t->integer('used')->default(0);
            $t->timestamps();

            $t->unique(['office_id','feature_key','period_key']);
            $t->index(['feature_key','period_key']);
        });
    }

    public function down(): void
    {
        Schema::connection($this->connection)->dropIfExists('usage_counters');
    }
};
