<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::connection('system')->table('cvs', function (Blueprint $table) {
            // لازم doctrine/dbal لو الأعمدة موجودة بالفعل
            if (Schema::connection('system')->hasColumn('cvs', 'category_id')) {
                $table->unsignedBigInteger('category_id')->nullable()->change();
            }

            if (Schema::connection('system')->hasColumn('cvs', 'gender')) {
                // حسب نوع العمود الحالي:
                // لو enum:
                // $table->enum('gender', ['male', 'female'])->nullable()->change();
                // لو string:
                $table->string('gender', 16)->nullable()->change();
            }
        });
    }

    public function down(): void
    {
        Schema::connection('system')->table('cvs', function (Blueprint $table) {
            if (Schema::connection('system')->hasColumn('cvs', 'category_id')) {
                $table->unsignedBigInteger('category_id')->nullable(false)->change();
            }

            if (Schema::connection('system')->hasColumn('cvs', 'gender')) {
                $table->string('gender', 16)->nullable(false)->change();
                // أو enum بدون nullable حسب وضعك السابق
            }
        });
    }
};
