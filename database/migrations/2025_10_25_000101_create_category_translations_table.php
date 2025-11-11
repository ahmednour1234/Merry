<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    protected $connection = 'system';

    public function up(): void
    {
        Schema::connection($this->connection)->create('category_translations', function (Blueprint $t) {
            $t->bigIncrements('id');
            $t->unsignedBigInteger('category_id');
            $t->string('lang_code', 12);  // مرتبط بـ system_languages.code
            $t->string('name');
            $t->timestamps();
            $t->softDeletes();

            $t->unique(['category_id','lang_code']);
            $t->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $t->index(['lang_code']);
        });
    }

    public function down(): void
    {
        Schema::connection($this->connection)->dropIfExists('category_translations');
    }
};
