<?php

declare(strict_types=1);

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
        Schema::create('props', function (Blueprint $table): void {
            $table->id();
            $table->unsignedBigInteger('giver_id');
            $table->unsignedBigInteger('receiver_id');
            $table->boolean('display')->default(false);
            $table->integer('position')->nullable();
            $table->string('message');
            $table->timestamps();

            $table->foreign('giver_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('receiver_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('props');
    }
};
