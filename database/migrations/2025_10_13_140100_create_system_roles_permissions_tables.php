<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    protected $connection = 'system';

    public function up(): void
    {
        Schema::connection($this->connection)->create('roles', function (Blueprint $t) {
            $t->id();
            $t->string('name');
            $t->string('slug')->index();
            $t->string('guard', 32)->default('api');
            $t->boolean('active')->default(true);
            $t->timestamps();
            $t->softDeletes();
            $t->unique(['slug','guard']);
        });

        Schema::connection($this->connection)->create('permissions', function (Blueprint $t) {
            $t->id();
            $t->string('name');
            $t->string('slug')->index();
            $t->string('guard', 32)->default('api');
            $t->boolean('active')->default(true);
            $t->timestamps();
            $t->softDeletes();
            $t->unique(['slug','guard']);
        });

        Schema::connection($this->connection)->create('role_user', function (Blueprint $t) {
            $t->unsignedBigInteger('role_id');
            $t->unsignedBigInteger('user_id');
            $t->primary(['role_id','user_id']);
            $t->foreign('role_id')->references('id')->on('roles')->cascadeOnDelete();
            $t->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
        });

        Schema::connection($this->connection)->create('permission_role', function (Blueprint $t) {
            $t->unsignedBigInteger('permission_id');
            $t->unsignedBigInteger('role_id');
            $t->primary(['permission_id','role_id']);
            $t->foreign('permission_id')->references('id')->on('permissions')->cascadeOnDelete();
            $t->foreign('role_id')->references('id')->on('roles')->cascadeOnDelete();
        });

        Schema::connection($this->connection)->create('permission_user', function (Blueprint $t) {
            $t->unsignedBigInteger('permission_id');
            $t->unsignedBigInteger('user_id');
            $t->primary(['permission_id','user_id']);
            $t->foreign('permission_id')->references('id')->on('permissions')->cascadeOnDelete();
            $t->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::connection($this->connection)->dropIfExists('permission_user');
        Schema::connection($this->connection)->dropIfExists('permission_role');
        Schema::connection($this->connection)->dropIfExists('role_user');
        Schema::connection($this->connection)->dropIfExists('permissions');
        Schema::connection($this->connection)->dropIfExists('roles');
    }
};
