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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('full_name', 120);
            $table->string('cpf', 11)->nullable();
            $table->string('cnpj', 14)->nullable();
            $table->string('phone', 30);
            $table->string('email', 120);
            $table->string('date_birth')->nullable();
            $table->string('sex', 120)->nullable();
            $table->string('cep', 8)->nullable();
            $table->string('uf', 2)->nullable();
            $table->string('municipality')->nullable();
            $table->string('address', 120)->nullable();
            $table->string('number', 120)->nullable();
            $table->string('district', 120)->nullable();
            $table->string('complement', 120)->nullable();
            $table->string('photo', 120)->nullable();
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
        Schema::dropIfExists('Customers');
    }
};
