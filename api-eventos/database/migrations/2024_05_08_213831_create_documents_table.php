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
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->string('number');
            $table->boolean('generated');
            $table->boolean('delivered');
            $table->string('archive');
            $table->dateTime('dateGenerated');
            $table->dateTime('deliveryDate');
            $table->text('encryptedString');
            $table->text('cutEncryptedString');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
