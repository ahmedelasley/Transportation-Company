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
        Schema::create('trips', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->decimal('service_cost', 14, 4)->default(0);
            $table->decimal('wait_cost', 14, 4)->default(0);
            $table->decimal('paid', 14, 4)->default(0);

            $table->timestamp('desrved_date')->nullable();

            // $table->string('direction')->nullable();
            $table->enum('direction', ['One Way', 'Round Trip', 'Wait']);

            $table->unsignedBigInteger('from_area')->nullable();
            $table->foreign('from_area')->references('id')->on('areas')->onUpdate('cascade')->nullOnDelete();

            $table->unsignedBigInteger('to_area')->nullable();
            $table->foreign('to_area')->references('id')->on('areas')->onUpdate('cascade')->nullOnDelete();


            $table->unsignedBigInteger('client_id')->nullable();
            $table->foreign('client_id')->references('id')->on('clients')->onUpdate('cascade')->nullOnDelete();

            $table->unsignedBigInteger('company_id')->nullable();
            $table->foreign('company_id')->references('id')->on('companies')->onUpdate('cascade')->nullOnDelete();

            $table->unsignedBigInteger('vehicle_id')->nullable();
            $table->foreign('vehicle_id')->references('id')->on('vehicles')->onUpdate('cascade')->nullOnDelete();

            $table->unsignedBigInteger('category_id')->nullable();
            $table->foreign('category_id')->references('id')->on('categories')->onUpdate('cascade')->nullOnDelete();

            $table->string('reason_cancel')->nullable();

            $table->string('notes')->nullable();
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
        Schema::dropIfExists('trips');
    }
};
