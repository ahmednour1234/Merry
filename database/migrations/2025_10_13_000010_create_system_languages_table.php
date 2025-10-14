<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // نخزّنها على اتصال system
    protected $connection = 'system';

    public function up(): void
    {
        Schema::connection($this->connection)->create('system_languages', function (Blueprint $table) {
            $table->id();
            $table->string('code', 12)->unique();     // en, ar, fr-MA, etc.
            $table->string('name');                   // English, Arabic
            $table->string('native_name');            // English, العربية
            $table->boolean('rtl')->default(false);   // RTL?
            $table->string('status', 20)->default('active'); // active|inactive
            $table->json('meta')->nullable();         // أي بيانات إضافية
            $table->timestamps();

            $table->index(['status']);
        });
    }

    public function down(): void
    {
        Schema::connection($this->connection)->dropIfExists('system_languages');
    }
};
