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
        Schema::create('reply_forms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('form_id')->constrained('forms')->onDelete('cascade'); // Link to the form
            $table->text('message'); // Store the reply message
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reply_forms');
    }
};
