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

            $table->string('name');
            $table->string('phone_number')->unique();
            $table->string('email')->unique();
            $table->string('address');
            $table->unsignedBigInteger('area_id')->nullable();
            $table->foreign('area_id')->references('id')->on('areas')->onUpdate('cascade')->nullOnDelete();
            $table->unsignedBigInteger('social_id')->nullable();
            $table->foreign('social_id')->references('id')->on('socials')->onUpdate('cascade')->nullOnDelete();

            $table->unsignedBigInteger('category_id')->nullable();
            $table->foreign('category_id')->references('id')->on('categories')->onUpdate('cascade')->nullOnDelete();

            $table->string('notes');
            $table->timestamp('date')->nullable();

            $table->unsignedBigInteger('status_id')->nullable();
            $table->foreign('status_id')->references('id')->on('statuses')->onUpdate('cascade')->nullOnDelete();

            $table->unsignedBigInteger('created_id')->nullable();
            $table->foreign('created_id')->references('id')->on('users')->onUpdate('cascade')->nullOnDelete();

            $table->unsignedBigInteger('updated_id')->nullable();
            $table->foreign('updated_id')->references('id')->on('users')->onUpdate('cascade')->nullOnDelete();

            $table->unsignedBigInteger('deleted_id')->nullable();
            $table->foreign('deleted_id')->references('id')->on('users')->onUpdate('cascade')->nullOnDelete();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
