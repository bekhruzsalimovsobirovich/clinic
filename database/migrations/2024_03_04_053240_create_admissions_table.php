<?php

use App\Domain\Patients\Models\Patient;
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
            $table->foreignIdFor(Patient::class)
                ->index()
                ->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->json('admissions')->comment('priyom');
            $table->uuid('uuid')->comment('uuid');
            $table->integer('status')->comment('1 - navbat, 2 - qayta navbat');
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
