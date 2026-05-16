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
    Schema::create('monthly_fees', function (Blueprint $table) {
        $table->id();

        $table->foreignId('student_id')->constrained()->onDelete('cascade');

        $table->string('month'); // April 2026
        $table->decimal('amount', 10, 2);

        $table->decimal('paid', 10, 2)->default(0);
        $table->decimal('balance', 10, 2)->default(0);

        $table->timestamps();
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('monthly_fees');
    }
};
