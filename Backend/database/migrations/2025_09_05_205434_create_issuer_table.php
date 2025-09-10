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
        Schema::create('issuers', function (Blueprint $table) {
            $table->id();
            $table->string('company_name', 120);
            $table->string('cpf', 11)->nullable();
            $table->string('cnpj', 14)->nullable();
            $table->string('uf', 2)->nullable();
            $table->string('municipality')->nullable();
            $table->string('address', 120)->nullable();
            $table->string('number', 120)->nullable();
            $table->string('district', 120)->nullable();
            $table->string('complement', 120)->nullable();
            $table->unsignedBigInteger('user_code')->nullable();
            $table->foreign('user_code')->references('id')->on('users')->onDelete('cascade');
            $table->boolean('active')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Issuer');
    }
};
