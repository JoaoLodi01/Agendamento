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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->id('service_id');
            $table->string('service', 120);
            $table->decimal('duration', 16,2);
            $table->decimal('price', 16,2);
            $table->unsignedBigInteger('categories_id')->nullable();
            $table->foreign('categories_id')->references('id')->on('categories')->onDelete('cascade');
            $table->string('description')->nullable();
            $table->boolean('home_service')->default(0);
            $table->boolean('check_availability')->default(0);
            $table->unsignedBigInteger('issuer_code')->index();
            $table->boolean('active')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Services');
    }
};
