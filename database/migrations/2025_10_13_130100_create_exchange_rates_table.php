<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    protected $connection = 'system';

    public function up(): void
    {
        Schema::connection($this->connection)->create('exchange_rates', function (Blueprint $t) {
            $t->id();
            $t->string('base', 8);
            $t->string('quote', 8);
            $t->decimal('rate', 18, 8);
            $t->dateTime('fetched_at')->nullable();
            $t->boolean('active')->default(true);
            $t->timestamps();
            $t->softDeletes();

            $t->unique(['base','quote'], 'uniq_pair');
            $t->index(['active']);
        });
    }

    public function down(): void
    {
        Schema::connection($this->connection)->dropIfExists('exchange_rates');
    }
};
