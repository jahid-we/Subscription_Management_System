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
        Schema::create('user_subscriptions', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('type', ['Monthly', 'Yearly', 'Custom']);
            $table->decimal('fee', 10, 2);
            $table->date('due_date');
            $table->unsignedBigInteger('user_id');
            $table->enum('status', ['Completed', 'Pending', 'Failed']);
            $table->date('payment_date');

            $table->foreign('user_id')->references('id')->on('users')
            ->cascadeOnUpdate()
            ->cascadeOnDelete();

            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_subscriptions');
    }
};
