<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    protected $connection = 'system';

    public function up(): void
    {
        Schema::connection($this->connection)->create('nationality_translations', function (Blueprint $t) {
            $t->bigIncrements('id');
            $t->unsignedBigInteger('nationality_id');
            $t->string('lang_code', 12);        // مطابق system_languages.code
            $t->string('name');

            $t->timestamps();
            $t->softDeletes();

            $t->unique(['nationality_id','lang_code']);
            $t->foreign('nationality_id')->references('id')->on('nationalities')->onDelete('cascade');
            $t->index(['lang_code']);
        });
    }

    public function down(): void
    {
        Schema::connection($this->connection)->dropIfExists('nationality_translations');
    }
};
