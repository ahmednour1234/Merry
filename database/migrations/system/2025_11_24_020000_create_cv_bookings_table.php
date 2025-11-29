<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	protected $connection = 'system';

	public function up(): void
	{
		$schema = Schema::connection($this->connection);
		if ($schema->hasTable('cv_bookings')) {
			return;
		}

		$schema->create('cv_bookings', function (Blueprint $table) {
			$table->id();
			$table->unsignedBigInteger('cv_id')->index();
			$table->unsignedBigInteger('office_id')->index();    // denormalized from CV for faster queries
			$table->unsignedBigInteger('end_user_id')->index();  // identity DB id (no FK)
			$table->string('status', 20)->index();               // see BookingStatus enum
			$table->text('note')->nullable();
			$table->timestamps();

			$table->index(['cv_id','status']);
			$table->unique(['cv_id','end_user_id']); // prevent duplicate booking for same user+cv
		});
	}

	public function down(): void
	{
		Schema::connection($this->connection)->dropIfExists('cv_bookings');
	}
};


