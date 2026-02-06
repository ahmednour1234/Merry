<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    protected $connection = 'system';

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $schema = Schema::connection($this->connection);
        
        // Check if table already exists
        if ($schema->hasTable('page_translations')) {
            return;
        }

        $schema->create('page_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('page_id');
            $table->string('lang_code', 12); // Matches system_languages.code
            $table->string('title');
            $table->text('content')->nullable();
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['page_id', 'lang_code']);
            $table->foreign('page_id')->references('id')->on('pages')->onDelete('cascade');
            $table->index(['lang_code']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection($this->connection)->dropIfExists('page_translations');
    }
};
