<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::connection('system')->table('cvs', function (Blueprint $table) {
            if (!Schema::connection('system')->hasColumn('cvs', 'is_muslim')) {
                $table->boolean('is_muslim')->nullable()->after('has_experience');
            }

            // لو محتاج تتأكد برضه من إن category_id و gender nullable (لو ما عملتهاش قبل كده)
            if (Schema::connection('system')->hasColumn('cvs', 'category_id')) {
                $table->unsignedBigInteger('category_id')->nullable()->change();
            }

            if (Schema::connection('system')->hasColumn('cvs', 'gender')) {
                $table->string('gender', 16)->nullable()->change();
            }
        });
    }

    public function down(): void
    {
        Schema::connection('system')->table('cvs', function (Blueprint $table) {
            if (Schema::connection('system')->hasColumn('cvs', 'is_muslim')) {
                $table->dropColumn('is_muslim');
            }

            // لو عايز ترجعهم إجباريين تاني
            // $table->unsignedBigInteger('category_id')->nullable(false)->change();
            // $table->string('gender', 16)->nullable(false)->change();
        });
    }
};
