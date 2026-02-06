<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	protected $connection = 'identity';

	public function up(): void
	{
		$schema = Schema::connection($this->connection);

		if ($schema->hasTable('favourites_cv')) {
			return;
		}

		$schema->create('favourites_cv', function (Blueprint $table) {
			$table->id();
			$table->unsignedBigInteger('end_user_id')->index();
			$table->unsignedBigInteger('cv_id')->index(); // points to system.cvs.id
			$table->timestamps();

			$table->unique(['end_user_id','cv_id']);
		});
	}

	public function down(): void
	{
		Schema::connection($this->connection)->dropIfExists('favourites_cv');
	}
};


