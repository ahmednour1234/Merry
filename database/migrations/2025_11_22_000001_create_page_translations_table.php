<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    protected $connection = 'system';

    public function up(): void
    {
        Schema::connection($this->connection)->create('page_translations', function (Blueprint $t) {
            $t->bigIncrements('id');
            $t->unsignedBigInteger('page_id');
            $t->string('lang_code', 12); // from system_languages
            $t->string('title');
            $t->longText('content')->nullable();
            $t->timestamps();
            $t->softDeletes();

            $t->unique(['page_id', 'lang_code']);
            $t->foreign('page_id')->references('id')->on('pages')->onDelete('cascade');
            $t->index(['lang_code']);
        });
    }

    public function down(): void
    {
        Schema::connection($this->connection)->dropIfExists('page_translations');
    }
};


