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
        Schema::create('ticket', function (Blueprint $table) {
            $table->id();
            $table->String('kode', 4)->unique;
            $table->unsignedInteger('event_id');
            $table->string('type');
            $table->integer('harga', 10, 2);
            $table->timestamps();

            $table->foreign('event_id')->references('id')->on('event')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ticket');
    }
};
