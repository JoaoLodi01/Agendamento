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
        Schema::create('agenda', function (Blueprint $table) {
            $table->id();
            $table->string('description');
            $table->unsignedBigInteger('client_id');
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');

            $table->unsignedBigInteger('attendant_id');
            $table->foreign('attendant_id')->references('id')->on('users')->onDelete('cascade');

            $table->unsignedBigInteger('service_id');
            $table->foreign('service_id')->references('id')->on('services')->onDelete('cascade');

            $table->dateTime('start_at');
            $table->dateTime('end_at');
            $table->decimal('price', 10, 2)->nullable();
            $table->enum('status', ['free' ,'scheduled','completed','canceled'])->default('free');
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
        Schema::dropIfExists('Agenda');
    }
};
