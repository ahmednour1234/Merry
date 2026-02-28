<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    protected $connection = 'identity';

    public function up(): void
    {
        $schema = Schema::connection($this->connection);
        if ($schema->hasColumn('end_users', 'blocked')) {
            return;
        }

        $schema->table('end_users', function (Blueprint $table) {
            $table->boolean('blocked')->default(false)->after('active');
        });
    }

    public function down(): void
    {
        $schema = Schema::connection($this->connection);
        if ($schema->hasColumn('end_users', 'blocked')) {
            $schema->table('end_users', function (Blueprint $table) {
                $table->dropColumn('blocked');
            });
        }
    }
};
