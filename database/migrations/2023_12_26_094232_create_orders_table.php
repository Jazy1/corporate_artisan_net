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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('number', 8);
            $table->unsignedBigInteger('freelancer_id');
            $table->unsignedBigInteger('company_id');
            $table->unsignedBigInteger('gig_id');
            $table->decimal('amount', 10);
            $table->text("description");
            $table->integer('time');
            $table->enum('status', ['completed', 'pending', 'cancelled']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
