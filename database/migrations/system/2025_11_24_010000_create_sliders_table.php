<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	protected $connection = 'system';

	public function up(): void
	{
		$schema = Schema::connection($this->connection);

		if (!$schema->hasTable('sliders')) {
			$schema->create('sliders', function (Blueprint $table) {
				$table->id();
				$table->string('image')->nullable();         // URL or storage path
				$table->string('link_url')->nullable();      // optional link
				$table->integer('position')->default(0);     // ordering
				$table->boolean('active')->default(true);
				$table->json('meta')->nullable();
				$table->timestamps();
				$table->softDeletes();

				$table->index(['active','position']);
			});
		}

		if (!$schema->hasTable('slider_translations')) {
			$schema->create('slider_translations', function (Blueprint $table) {
				$table->id();
				$table->unsignedBigInteger('slider_id')->index();
				$table->string('lang_code', 12)->index();
				$table->string('title')->nullable();
				$table->text('text')->nullable();
				$table->timestamps();

				$table->unique(['slider_id','lang_code']);
			});
		}
	}

	public function down(): void
	{
		Schema::connection($this->connection)->dropIfExists('slider_translations');
		Schema::connection($this->connection)->dropIfExists('sliders');
	}
};


