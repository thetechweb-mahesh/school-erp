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
         Schema::create('students', function (Blueprint $table) {
        $table->id();

        $table->string('name');
        $table->string('father_name')->nullable();
        $table->string('mobile')->nullable();

        $table->string('class'); // 11(A), 10(B)
        $table->integer('roll_no')->nullable();

        $table->text('subjects')->nullable(); // JSON ya comma separated

        $table->decimal('total_fee', 10, 2)->default(0);
        $table->decimal('paid_fee', 10, 2)->default(0);
        $table->decimal('balance_fee', 10, 2)->default(0);

        $table->string('photo')->nullable();

        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
