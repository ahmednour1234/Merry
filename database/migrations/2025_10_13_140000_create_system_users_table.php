<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    protected $connection = 'system';

    public function up(): void
    {
        $schema = Schema::connection($this->connection);

        // 1) افصل العلاقات من جداول pivot لو موجودة
        if ($schema->hasTable('role_user')) {
            $schema->table('role_user', function (Blueprint $t) {
                // اسم القيد قد يختلف؛ dropForeign(['user_id']) بيشيلها بالاسم الصحيح
                if ($this->hasColumn('role_user', 'user_id')) {
                    $t->dropForeign(['user_id']);
                }
            });
        }

        if ($schema->hasTable('permission_user')) {
            $schema->table('permission_user', function (Blueprint $t) {
                if ($this->hasColumn('permission_user', 'user_id')) {
                    $t->dropForeign(['user_id']);
                }
            });
        }

        // 2) لو الجدول موجود بالفعل، احذفه
        if ($schema->hasTable('users')) {
            $schema->drop('users');
        }

        // 3) إعادة إنشاء users
        $schema->create('users', function (Blueprint $t) {
            $t->id();
            $t->string('name');
            $t->string('email')->unique();
            $t->string('phone')->nullable();
            $t->string('password');
            $t->string('guard', 32)->default('api');
            $t->boolean('active')->default(true);
            $t->timestamp('last_login_at')->nullable();
            $t->rememberToken();
            $t->timestamps();
            $t->softDeletes();

            $t->index(['active', 'guard']);
            $t->index(['name']);
            $t->index(['created_at']);
        });

        // 4) إعادة ربط الـ FK في جداول pivot (لو الجداول موجودة)
        if ($schema->hasTable('role_user')) {
            $schema->table('role_user', function (Blueprint $t) {
                if ($this->hasColumn('role_user', 'user_id')) {
                    $t->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
                }
            });
        }

        if ($schema->hasTable('permission_user')) {
            $schema->table('permission_user', function (Blueprint $t) {
                if ($this->hasColumn('permission_user', 'user_id')) {
                    $t->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
                }
            });
        }
    }

    public function down(): void
    {
        $schema = Schema::connection($this->connection);

        // افصل العلاقات الأول
        if ($schema->hasTable('role_user')) {
            $schema->table('role_user', function (Blueprint $t) {
                if ($this->hasColumn('role_user', 'user_id')) {
                    $t->dropForeign(['user_id']);
                }
            });
        }
        if ($schema->hasTable('permission_user')) {
            $schema->table('permission_user', function (Blueprint $t) {
                if ($this->hasColumn('permission_user', 'user_id')) {
                    $t->dropForeign(['user_id']);
                }
            });
        }

        // اسقط users
        if ($schema->hasTable('users')) {
            $schema->drop('users');
        }
    }

    /**
     * Helper: تحقّق من وجود عمود قبل التعامل معه
     */
    private function hasColumn(string $table, string $column): bool
    {
        return Schema::connection($this->connection)->hasColumn($table, $column);
    }
};
