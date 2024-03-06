<?php

use App\Domain\Patients\Models\Patient;
use App\Domain\Services\Models\Service;
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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)
                ->index()
                ->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignIdFor(Patient::class)
                ->index()
                ->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignIdFor(Service::class)
                ->index()
                ->nullable()
                ->constrained()->cascadeOnUpdate()->cascadeOnDelete();

            $table->unsignedDouble('service_price')->nullable();
            $table->unsignedDouble('difference_price')->nullable();
            $table->unsignedDouble('pay_patient')->nullable();
            $table->unsignedDouble('return_patient_pay')->nullable();
            $table->boolean('status')->default(0)->comment('to\'langan bo\'lsa 1, to\'lanmagan bo\'lsa 0');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
