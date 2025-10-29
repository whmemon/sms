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
        Schema::create('plots', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('plot_number');
            $table->string('plot_type');
            $table->integer('user_id');
            $table->string('folio_number')->nullable();
            $table->string('ledger_number')->nullable();
            $table->unsignedInteger('current_member_id')->nullable();
            $table->timestamps();
            $table->integer('status')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plots');
    }
};
