<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
Schema::create('contracts', function (Blueprint $table) {
$table->id();
    $table->unsignedBigInteger('accommodation_id');
    $table->decimal('contract_rates', 8, 2);
    $table->date('start_date');
    $table->date('end_date');
    $table->integer('volume_needed');
    $table->timestamps();

    // Foreign keys
    $table->foreign('accommodation_id')->references('id')->on('accommodations')->onDelete('cascade');
});

}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contracts');
    }
};
