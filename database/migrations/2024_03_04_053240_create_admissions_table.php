<?php

use App\Domain\Patients\Models\Patient;
use App\Models\User;
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
        Schema::create('admissions', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)
                ->index()
                ->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignIdFor(Patient::class)
                ->index()
                ->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->unsignedBigInteger('request_id')->index()->comment('bemor qaytib kelganda aloxida row buladi, ushanga admissionlarni qoshish uchun kerak');
            $table->json('admissions')->comment('priyom')->nullable();
            $table->uuid()->comment('uuid')->nullable();
            $table->json('status')->comment('1 - navbat, 2 - qayta navbat, [1,2]');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admissions');
    }
};
