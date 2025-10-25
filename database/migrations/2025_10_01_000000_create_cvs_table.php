<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    protected $connection = 'system';

    public function up(): void
    {
        Schema::connection($this->connection)->create('cvs', function (Blueprint $t) {
            $t->id();
            $t->unsignedBigInteger('office_id')->nullable()->index();        // مالك الـCV (مكتب)
            $t->unsignedBigInteger('category_id')->nullable()->index();      // تصنيف (اختياري)
            $t->string('nationality_code', 8)->index();                      // كود الجنسية (مثلاً ISO-2)
            $t->enum('gender', ['male','female'])->index();
            $t->boolean('has_experience')->default(false)->index();

            // ملف الـCV
            $t->string('file_path');
            $t->string('file_mime', 64)->nullable();
            $t->unsignedBigInteger('file_size')->nullable();
            $t->string('file_original_name')->nullable();

            // حالة الاعتماد
            $t->enum('status', ['pending','approved','rejected','frozen','deactivated_by_office'])->default('pending')->index();

            // اعتماد/رفض/تجميد ومتى ومن
            $t->unsignedBigInteger('approved_by')->nullable();
            $t->timestamp('approved_at')->nullable();

            $t->unsignedBigInteger('rejected_by')->nullable();
            $t->timestamp('rejected_at')->nullable();
            $t->text('rejected_reason')->nullable();

            $t->unsignedBigInteger('frozen_by')->nullable();
            $t->timestamp('frozen_at')->nullable();

            $t->timestamp('deactivated_by_office_at')->nullable();

            $t->json('meta')->nullable();

            $t->timestamps();
            $t->softDeletes();

            // فهارس مفيدة:
            $t->index(['office_id','status']);
            $t->index(['nationality_code','gender']);
        });
    }

    public function down(): void
    {
        Schema::connection($this->connection)->dropIfExists('cvs');
    }
};
