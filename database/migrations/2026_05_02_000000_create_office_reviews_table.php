<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    protected $connection = 'system';

    public function up(): void
    {
        Schema::connection($this->connection)->create('office_reviews', function (Blueprint $t) {
            $t->id();
            $t->unsignedBigInteger('office_id');
            $t->unsignedBigInteger('end_user_id');
            $t->tinyInteger('rating')->unsigned()->comment('1 to 5');
            $t->text('comment')->nullable();
            $t->boolean('is_active')->default(true)->comment('Admin can deactivate');
            $t->timestamps();

            $t->index(['office_id', 'is_active']);
            $t->index(['end_user_id']);
            $t->index(['created_at']);

            // One review per user per office
            $t->unique(['office_id', 'end_user_id']);
        });
    }

    public function down(): void
    {
        Schema::connection($this->connection)->dropIfExists('office_reviews');
    }
};
