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
        Schema::create('members', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('husband_name', 500)->default('0');
            $table->string('name');
            $table->string('father_name')->nullable();
            $table->string('gender')->nullable();
            $table->string('kin_name')->nullable();
            $table->integer('user_id')->nullable();
            $table->string('kin');
            $table->string('cellphone')->nullable();
            $table->string('citizenship_number');
            $table->timestamps();
            $table->string('email')->nullable();
            $table->string('address', 500)->nullable();
            $table->string('district', 500)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
