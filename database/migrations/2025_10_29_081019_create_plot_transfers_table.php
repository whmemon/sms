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
        Schema::create('plot_transfers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('plot_transferor_id');
            $table->integer('plot_transferee_id');
            $table->string('comments', 2000)->default('');
            $table->integer('user_id');
            $table->integer('plot_id');
            $table->timestamps();
            $table->integer('parent_id')->nullable();
            $table->string('reference_number', 500)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plot_transfers');
    }
};
