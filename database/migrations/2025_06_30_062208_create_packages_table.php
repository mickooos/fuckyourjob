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
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->string('unit');
            $table->string('pengirim');
            $table->string('penerima');
            $table->string('deskripsi');
            $table->unsignedBigInteger('kategori');
            $table->unsignedBigInteger('posisi');
            $table->unsignedBigInteger('kurir');
            $table->unsignedBigInteger('petugas');
            $table->string('catatan');
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('unit')->references('no_unit')->on('tenants')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('kategori')->references('id')->on('categories')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('posisi')->references('id')->on('positions')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('kurir')->references('id')->on('couriers')->onDelete('cascade')->onUpdate('cascade');  
            $table->foreign('petugas')->references('id')->on('handlers')->onDelete('cascade')->onUpdate('cascade');
   
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('packages');
    }
};