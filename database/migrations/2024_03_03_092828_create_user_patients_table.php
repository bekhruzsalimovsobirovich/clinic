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
        Schema::create('user_patients', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)
                ->index()
                ->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignIdFor(Patient::class)
                ->index()
                ->nullable()
                ->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_patients');
    }
};
