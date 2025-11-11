<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    protected $connection = 'system';

    public function up(): void
    {
        Schema::connection($this->connection)->create('cities', function (Blueprint $t) {
            $t->id();
            $t->string('slug')->unique();
            $t->string('country_code', 2)->default('SA'); // ISO-2
            $t->boolean('active')->default(true);
            $t->timestamps();
            $t->softDeletes();

            $t->index(['country_code','active']);
            $t->index(['created_at']);
        });

        Schema::connection($this->connection)->create('city_translations', function (Blueprint $t) {
            $t->id();
            $t->unsignedBigInteger('city_id');
            $t->string('lang_code', 12); // مطابق system_languages.code
            $t->string('name', 191);

            $t->timestamps();
            $t->unique(['city_id','lang_code']);
            $t->index(['lang_code']);

            $t->foreign('city_id')->references('id')->on('cities')->onDelete('cascade');
            // لو DB يسمح، ممكن FK على system_languages.code (VARCHAR)؛ نسيبه اختياري
            // $t->foreign('lang_code')->references('code')->on('system_languages')->cascadeOnUpdate();
        });
    }

    public function down(): void
    {
        Schema::connection($this->connection)->dropIfExists('city_translations');
        Schema::connection($this->connection)->dropIfExists('cities');
    }
};
