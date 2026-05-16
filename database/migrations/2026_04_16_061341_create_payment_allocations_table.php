<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
{
    Schema::create('payment_allocations', function (Blueprint $table) {
        $table->id();

        $table->foreignId('fee_payment_id')->constrained()->onDelete('cascade');
        $table->foreignId('monthly_fee_id')->constrained()->onDelete('cascade');

        $table->decimal('amount', 10, 2);

        $table->timestamps();
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_allocations');
    }
};
