<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    protected $connection = 'system';

    public function up(): void
    {
        Schema::connection($this->connection)->table('insurance_companies', function (Blueprint $t) {
            if (!Schema::connection($this->connection)->hasColumn('insurance_companies','insurance_amount')) {
                $t->decimal('insurance_amount', 18, 2)->nullable()->after('logo_path');
            }
            if (!Schema::connection($this->connection)->hasColumn('insurance_companies','currency_code')) {
                $t->string('currency_code', 8)->nullable()->after('insurance_amount');
                $t->index('currency_code');

                // currencies.code هو PK في جدول العملات
                // لو MySQL قديم لا يدعم FK على VARCHAR، سيبها بدون FK
                // $t->foreign('currency_code')->references('code')->on('currencies')->cascadeOnUpdate();
            }
        });
    }

    public function down(): void
    {
        Schema::connection($this->connection)->table('insurance_companies', function (Blueprint $t) {
            if (Schema::connection($this->connection)->hasColumn('insurance_companies','currency_code')) {
                // $t->dropForeign(['currency_code']);
                $t->dropIndex(['currency_code']);
                $t->dropColumn('currency_code');
            }
            if (Schema::connection($this->connection)->hasColumn('insurance_companies','insurance_amount')) {
                $t->dropColumn('insurance_amount');
            }
        });
    }
};
