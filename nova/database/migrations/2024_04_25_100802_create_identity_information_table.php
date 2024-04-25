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
        Schema::create('identity_information', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->enum('military_services',['exempt','performer','deferred','fixed_services','money_instead_of_service'])->nullable();
            $table->string('reason_of_exempt')->nullable();
            $table->string('nationality');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('identity_information');
    }
};
